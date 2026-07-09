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
            'streetAddress'   => 'P Block, Plot No. 131, Gopal Nagar Extension, Najafgarh',
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
        $reply .= "Phone: 09073291732\n";
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

/* ══════════════════════════════════════════════
   LOCATION LANDING PAGES (virtual, dynamic)
   Powers /packers-and-movers-in-{city}/ and /locations/
   Fixes footer "Our Presence" links → 404.
   No need to create 664+ individual WP Pages —
   one template renders all of them from data below.
══════════════════════════════════════════════ */

define('SS_LOCATION_RULES_VERSION', '1.1.0');

/**
 * Known city data. Add more cities here any time — each one just
 * needs a slug key matching the footer URL, e.g. 'packers-and-movers-in-KEY'.
 * Any slug NOT listed here still renders a working page (see fallback
 * in ss_get_city_data), so this scales to all 664+ locations safely.
 */
function ss_get_all_cities() {
    return array(
        'delhi' => array('name'=>'Delhi','state'=>'Delhi','tag'=>'National Capital',
            'localities'=>array('Dwarka','Rohini','Najafgarh','Karol Bagh','Lajpat Nagar','Vasant Kunj','Saket','Pitampura','Janakpuri','Mayur Vihar')),
        'gurugram' => array('name'=>'Gurugram','state'=>'Haryana','tag'=>'Millennium City',
            'localities'=>array('DLF Phase 1-5','Sohna Road','MG Road','Golf Course Road','Udyog Vihar','Sushant Lok','Palam Vihar','Sector 14')),
        'noida' => array('name'=>'Noida','state'=>'Uttar Pradesh','tag'=>'Planned Industrial City',
            'localities'=>array('Sector 18','Sector 62','Sector 137','Sector 50','Sector 76','Noida Extension')),
        'greater-noida' => array('name'=>'Greater Noida','state'=>'Uttar Pradesh','tag'=>'NCR Township',
            'localities'=>array('Pari Chowk','Alpha 1 & 2','Beta 1 & 2','Gamma','Knowledge Park','Jaypee Greens')),
        'faridabad' => array('name'=>'Faridabad','state'=>'Haryana','tag'=>'Industrial Hub',
            'localities'=>array('Sector 15','Sector 21','NIT','Old Faridabad','Ballabgarh','Greenfield Colony')),
        'ghaziabad' => array('name'=>'Ghaziabad','state'=>'Uttar Pradesh','tag'=>'NCR Gateway',
            'localities'=>array('Indirapuram','Vaishali','Raj Nagar Extension','Kaushambi','Vasundhara','Crossings Republik')),
        'sonipat' => array('name'=>'Sonipat','state'=>'Haryana','tag'=>'NCR Industrial Town',
            'localities'=>array('Sector 14','Model Town','Kundli','Rai Industrial Area')),
        'bahadurgarh' => array('name'=>'Bahadurgarh','state'=>'Haryana','tag'=>'NCR Industrial Town',
            'localities'=>array('City Park','Sector 6','Sector 9','Industrial Area')),
        'gwalior' => array('name'=>'Gwalior','state'=>'Madhya Pradesh','tag'=>'Heritage City',
            'localities'=>array('Lashkar','Morar','City Centre','Thatipur','Gole Ka Mandir')),
        'mumbai' => array('name'=>'Mumbai','state'=>'Maharashtra','tag'=>'Financial Capital',
            'localities'=>array('Andheri','Bandra','Powai','Thane','Navi Mumbai','Borivali','Malad','Chembur')),
        'bengaluru' => array('name'=>'Bengaluru','state'=>'Karnataka','tag'=>"India's IT Capital",
            'localities'=>array('Whitefield','Koramangala','Indiranagar','Electronic City','HSR Layout','Marathahalli','Hebbal')),
        'pune' => array('name'=>'Pune','state'=>'Maharashtra','tag'=>'Oxford of the East',
            'localities'=>array('Hinjewadi','Kothrud','Viman Nagar','Wakad','Baner','Hadapsar','Kharadi')),
        'hyderabad' => array('name'=>'Hyderabad','state'=>'Telangana','tag'=>'Cyberabad',
            'localities'=>array('Gachibowli','Hitech City','Kondapur','Madhapur','Banjara Hills','Kukatpally')),
        'chennai' => array('name'=>'Chennai','state'=>'Tamil Nadu','tag'=>'Gateway of South India',
            'localities'=>array('OMR','Adyar','Anna Nagar','Velachery','T Nagar','Porur','Tambaram')),
        'kolkata' => array('name'=>'Kolkata','state'=>'West Bengal','tag'=>'City of Joy',
            'localities'=>array('Salt Lake','New Town','Behala','Howrah','Rajarhat','Park Street')),
        'ahmedabad' => array('name'=>'Ahmedabad','state'=>'Gujarat','tag'=>'Manchester of India',
            'localities'=>array('Satellite','Bopal','Vastrapur','SG Highway','Maninagar','Naranpura')),
        'jaipur' => array('name'=>'Jaipur','state'=>'Rajasthan','tag'=>'Pink City',
            'localities'=>array('Malviya Nagar','Vaishali Nagar','C-Scheme','Mansarovar','Jagatpura')),
        'lucknow' => array('name'=>'Lucknow','state'=>'Uttar Pradesh','tag'=>'City of Nawabs',
            'localities'=>array('Gomti Nagar','Hazratganj','Indira Nagar','Aliganj','Alambagh')),
        'chandigarh' => array('name'=>'Chandigarh','state'=>'Punjab & Haryana','tag'=>'The City Beautiful',
            'localities'=>array('Sector 17','Sector 22','Sector 35','Mohali','Panchkula','Zirakpur')),
    );
}

/**
 * Returns display data for any city slug. Falls back to a humanised
 * version of the slug itself if the city isn't in the curated list above,
 * so /packers-and-movers-in-{anything}/ never 404s again.
 */
function ss_get_city_data($slug) {
    $slug = sanitize_title($slug);
    $all  = ss_get_all_cities();
    if (isset($all[$slug])) {
        $city = $all[$slug];
    } else {
        $city = array(
            'name'       => ucwords(str_replace('-', ' ', $slug)),
            'state'      => 'India',
            'tag'        => 'Service Location',
            'localities' => array(),
        );
    }
    $city['slug'] = $slug;
    return $city;
}

/**
 * Turns a locality slug (e.g. "dlf-phase-1-5") back into a display name
 * (e.g. "Dlf Phase 1 5"), or matches it against the curated list for a
 * city so we can show the properly-cased original (e.g. "DLF Phase 1-5").
 */
function ss_get_locality_name($city, $locality_slug) {
    $locality_slug = sanitize_title($locality_slug);
    if (!empty($city['localities'])) {
        foreach ($city['localities'] as $loc) {
            if (sanitize_title($loc) === $locality_slug) {
                return $loc;
            }
        }
    }
    return ucwords(str_replace('-', ' ', $locality_slug));
}

/* Rewrite rules: /packers-and-movers-in-{city}/{locality}/ and /locations/ */
add_action('init', function () {
    add_rewrite_rule('^packers-and-movers-in-([a-z0-9-]+)/?$', 'index.php?ss_city=$matches[1]', 'top');
    add_rewrite_rule('^locations/?$', 'index.php?ss_locations=1', 'top');
    // Nested locality/area page — must be registered AFTER the city rule so it sits above it ('top' prepends).
    add_rewrite_rule('^packers-and-movers-in-([a-z0-9-]+)/([a-z0-9-]+)/?$', 'index.php?ss_city=$matches[1]&ss_locality=$matches[2]', 'top');

    // Auto-flush once whenever the rule version changes — no manual
    // "Settings → Permalinks → Save" step required after deploying.
    if (get_option('ss_location_rules_flushed') !== SS_LOCATION_RULES_VERSION) {
        flush_rewrite_rules();
        update_option('ss_location_rules_flushed', SS_LOCATION_RULES_VERSION);
    }
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'ss_city';
    $vars[] = 'ss_locality';
    $vars[] = 'ss_locations';
    return $vars;
});

/* Correct <title> for the virtual pages (theme already supports title-tag) */
add_filter('pre_get_document_title', function ($title) {
    $city = get_query_var('ss_city');
    if (!empty($city)) {
        $c        = ss_get_city_data($city);
        $locality = get_query_var('ss_locality');
        $place    = !empty($locality) ? ss_get_locality_name($c, $locality) . ', ' . $c['name'] : $c['name'];
        return 'Packers & Movers in ' . $place . ' | Free Quote — Sure Shift';
    }
    if (get_query_var('ss_locations')) {
        return 'Our Locations — Packers & Movers Across India | Sure Shift';
    }
    return $title;
});

/* Serve the templates directly and force a real 200 (not 404) response */
add_action('template_redirect', function () {
    global $wp_query;

    $city = get_query_var('ss_city');
    if (!empty($city)) {
        $wp_query->is_404 = false;
        status_header(200);
        $tpl = locate_template('template-location.php');
        if ($tpl) { include $tpl; exit; }
    }

    if (get_query_var('ss_locations')) {
        $wp_query->is_404 = false;
        status_header(200);
        $tpl = locate_template('template-locations-index.php');
        if ($tpl) { include $tpl; exit; }
    }
});

/* ── MISC ── */
add_filter('document_title_separator', function () { return '&#8212;'; });
add_filter('excerpt_length', function () { return 20; });
add_action('send_headers', function () {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
});
