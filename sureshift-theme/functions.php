<?php
defined('ABSPATH') || exit;

/* ── SETUP ── */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','script','style'));
    add_theme_support('custom-logo', array('height'=>50,'width'=>200,'flex-height'=>true,'flex-width'=>true));
    register_nav_menus(array('primary'=>'Primary Nav','footer'=>'Footer Nav'));
    add_image_size('ss-hero', 1400, 800, true);
    add_image_size('ss-card', 600, 400, true);
});

/* ── ENQUEUE ── */
add_action('wp_enqueue_scripts', function () {
    $v  = '5.0.0';
    $tu = get_template_directory_uri();
    wp_enqueue_style('ss-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap',
        array(), null
    );
    wp_enqueue_style('ss-main', $tu . '/assets/css/main.css', array('ss-fonts'), $v);
    wp_enqueue_script('ss-app', $tu . '/assets/js/app.js', array(), $v, true);
    wp_localize_script('ss-app', 'SS', array(
        'ajax'  => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ss_nonce'),
        'home'  => home_url('/'),
    ));
});

/* ── PRECONNECT ── */
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1);

/* ── BLOAT REMOVAL ── */
add_action('init', function () {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
});
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}, 100);

/* ── SCHEMA ── */
add_action('wp_head', function () {
    if (!is_front_page()) return;
    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'MovingCompany',
        'name'        => 'Sure Shift Relocation Services',
        'url'         => 'https://www.sureshift.in',
        'description' => "India's most trusted packers and movers since 1987.",
        'telephone'   => '+919073291732',
        'email'       => 'info@sureshift.in',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'P Block, Plot 131, Gopal Nagar Ext, Najafgarh',
            'addressLocality' => 'New Delhi',
            'addressRegion'   => 'Delhi',
            'postalCode'      => '110043',
            'addressCountry'  => 'IN',
        ),
        'openingHours' => 'Mo-Su 00:00-23:59',
        'areaServed'   => 'India',
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
});

/* ── QUOTE AJAX ── */
add_action('wp_ajax_ss_quote',        'ss_quote_handler');
add_action('wp_ajax_nopriv_ss_quote', 'ss_quote_handler');
function ss_quote_handler() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'ss_nonce')) {
        wp_send_json_error(array('msg' => 'Security check failed. Please refresh the page.'));
    }
    $name    = sanitize_text_field(isset($_POST['name'])    ? $_POST['name']    : '');
    $phone   = sanitize_text_field(isset($_POST['phone'])   ? $_POST['phone']   : '');
    $email   = sanitize_email(isset($_POST['email'])        ? $_POST['email']   : '');
    $from    = sanitize_text_field(isset($_POST['from'])    ? $_POST['from']    : '');
    $to      = sanitize_text_field(isset($_POST['to'])      ? $_POST['to']      : '');
    $service = sanitize_text_field(isset($_POST['service']) ? $_POST['service'] : 'General');

    if (empty($name) || empty($phone) || empty($from) || empty($to)) {
        wp_send_json_error(array('msg' => 'Please fill all required fields.'));
    }
    $clean_phone = preg_replace('/\s+/', '', $phone);
    if (!preg_match('/^[6-9][0-9]{9}$/', $clean_phone)) {
        wp_send_json_error(array('msg' => 'Enter a valid 10-digit Indian mobile number.'));
    }

    // Build detailed email body from all fields
    $skip = array('action','nonce','_wpnonce');
    $body = "=== New Quote Request: " . $service . " ===\n\n";
    foreach ($_POST as $k => $v) {
        if (in_array($k, $skip, true)) continue;
        $body .= ucwords(str_replace('_', ' ', sanitize_text_field($k))) . ': ' . sanitize_text_field($v) . "\n";
    }
    $body .= "\nReceived: " . current_time('mysql');

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: Sure Shift Website <info@sureshift.in>',
    );
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    $subject = 'Quote Request — ' . $service . ' | ' . $name;
    wp_mail('sureshiftmail@gmail.com',   $subject, $body, $headers);
    wp_mail('info@sureshift.in',         $subject, $body, $headers);

    if (!empty($email)) {
        $reply  = "Dear " . $name . ",\n\n";
        $reply .= "Thank you for choosing Sure Shift!\n\n";
        $reply .= "We have received your " . $service . " quote request from " . $from . " to " . $to . ".\n";
        $reply .= "Our team will call you on " . $phone . " within 30 minutes.\n\n";
        $reply .= "Sure Shift Relocation Services\n";
        $reply .= "Phone: 90 732 91 732\n";
        $reply .= "Email: info@sureshift.in\n";
        $reply .= "Web: https://www.sureshift.in";
        $reply_headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: Sure Shift <info@sureshift.in>',
        );
        wp_mail($email, 'Your Sure Shift Quote Request', $reply, $reply_headers);
    }

    wp_send_json_success(array('msg' => 'Thank you ' . $name . '! We\'ll call you within 30 minutes.'));
}

/* ── TRACK AJAX ── */
add_action('wp_ajax_ss_track',        'ss_track_handler');
add_action('wp_ajax_nopriv_ss_track', 'ss_track_handler');
function ss_track_handler() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'ss_nonce')) {
        wp_send_json_error(array('msg' => 'Security check failed.'));
    }
    $id = sanitize_text_field(isset($_POST['consignment']) ? $_POST['consignment'] : '');
    if (strlen($id) < 4) {
        wp_send_json_error(array('msg' => 'Enter a valid consignment number.'));
    }
    wp_send_json_success(array('redirect' => 'https://www.sureshift.in/tracking/?id=' . urlencode($id)));
}

/* ── MISC ── */
add_filter('document_title_separator', function () { return '&#8212;'; });
add_filter('excerpt_length', function () { return 20; });
add_action('send_headers', function () {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
});
