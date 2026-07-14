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

/* ── CONTACT AJAX ── */
add_action('wp_ajax_ss_contact',        'ss_contact_handler');
add_action('wp_ajax_nopriv_ss_contact', 'ss_contact_handler');
function ss_contact_handler() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'ss_nonce')) {
        wp_send_json_error(array('msg' => 'Security check failed. Please refresh the page.'));
    }
    $name    = sanitize_text_field(isset($_POST['name'])    ? $_POST['name']    : '');
    $phone   = sanitize_text_field(isset($_POST['phone'])   ? $_POST['phone']   : '');
    $email   = sanitize_email(isset($_POST['email'])        ? $_POST['email']   : '');
    $subject = sanitize_text_field(isset($_POST['subject']) ? $_POST['subject'] : 'General Enquiry');
    $message = sanitize_textarea_field(isset($_POST['message']) ? $_POST['message'] : '');

    if (empty($name) || empty($phone) || empty($message)) {
        wp_send_json_error(array('msg' => 'Please fill all required fields.'));
    }
    $clean_phone = preg_replace('/\s+/', '', $phone);
    if (!preg_match('/^[6-9][0-9]{9}$/', $clean_phone)) {
        wp_send_json_error(array('msg' => 'Enter a valid 10-digit Indian mobile number.'));
    }

    $body  = "=== New Contact Form Message ===\n\n";
    $body .= 'Name: ' . $name . "\n" . 'Phone: ' . $phone . "\n";
    if (!empty($email)) { $body .= 'Email: ' . $email . "\n"; }
    $body .= 'Subject: ' . $subject . "\n\nMessage:\n" . $message . "\n\nReceived: " . current_time('mysql');

    $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: Sure Shift Website <info@sureshift.in>');
    if (!empty($email)) { $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>'; }

    wp_mail('info@sureshift.in', 'Contact Form: ' . $subject . ' — ' . $name, $body, $headers);

    wp_send_json_success(array('msg' => 'Thank you ' . $name . '! We\'ll get back to you shortly.'));
}

/* ── PARTNER APPLICATION AJAX ── */
add_action('wp_ajax_ss_partner',        'ss_partner_handler');
add_action('wp_ajax_nopriv_ss_partner', 'ss_partner_handler');
function ss_partner_handler() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'ss_nonce')) {
        wp_send_json_error(array('msg' => 'Security check failed. Please refresh the page.'));
    }
    $name    = sanitize_text_field(isset($_POST['name'])    ? $_POST['name']    : '');
    $phone   = sanitize_text_field(isset($_POST['phone'])   ? $_POST['phone']   : '');
    $email   = sanitize_email(isset($_POST['email'])        ? $_POST['email']   : '');
    $city    = sanitize_text_field(isset($_POST['city'])    ? $_POST['city']    : '');
    $message = sanitize_textarea_field(isset($_POST['message']) ? $_POST['message'] : '');

    if (empty($name) || empty($phone) || empty($city)) {
        wp_send_json_error(array('msg' => 'Please fill all required fields.'));
    }
    $clean_phone = preg_replace('/\s+/', '', $phone);
    if (!preg_match('/^[6-9][0-9]{9}$/', $clean_phone)) {
        wp_send_json_error(array('msg' => 'Enter a valid 10-digit Indian mobile number.'));
    }

    $body  = "=== New Partner Application ===\n\n";
    $body .= 'Name: ' . $name . "\n" . 'Phone: ' . $phone . "\n";
    if (!empty($email)) { $body .= 'Email: ' . $email . "\n"; }
    $body .= 'City: ' . $city . "\n\nMessage:\n" . $message . "\n\nReceived: " . current_time('mysql');

    $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: Sure Shift Website <info@sureshift.in>');
    if (!empty($email)) { $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>'; }

    wp_mail('info@sureshift.in', 'Partner Application — ' . $name . ' (' . $city . ')', $body, $headers);

    wp_send_json_success(array('msg' => 'Thank you ' . $name . '! Our partnerships team will contact you within 2 business days.'));
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

/* ══════════════════════════════════════════════
   LEGAL & POLICY PAGES (virtual, dynamic)
   Powers /privacy-policy/, /terms-and-conditions/, /refund-policy/,
   /payment-policy/, /cancellation-policy/, /disclaimer/,
   /damage-claim-policy/ and /sitemap/ — no WP Pages required.
══════════════════════════════════════════════ */

function ss_get_legal_pages() {
    return array(
        'privacy-policy' => array(
            'title'   => 'Privacy Policy',
            'updated' => 'January 2026',
            'intro'   => 'Sure Shift Relocation Services ("Sure Shift", "we", "us") respects your privacy. This policy explains what information we collect when you use our website or services, how we use it, and the choices you have.',
            'sections' => array(
                array('h' => 'Information We Collect', 'p' => array(
                    'Information you provide directly: name, phone number, email address, pickup and delivery addresses, and details of the items being moved when you request a quote, book a service, or contact us.',
                    'Information collected automatically: IP address, browser type, device information, pages visited, and referral source, via cookies and similar technologies.',
                )),
                array('h' => 'How We Use Your Information', 'list' => array(
                    'To generate quotes, schedule surveys, and coordinate your move',
                    'To communicate booking confirmations, updates, and support responses',
                    'To improve our website, services, and customer experience',
                    'To meet legal, regulatory, and insurance requirements',
                    'To send offers or updates, where you have opted in — you can unsubscribe at any time',
                )),
                array('h' => 'Sharing of Information', 'p' => array(
                    'We share information only where necessary to deliver our services: with our verified moving crews, transport and courier partners, insurance providers, and destination-agent partners for international moves.',
                    'We do not sell your personal information to third parties. Information may be disclosed if required by law, court order, or government authority.',
                )),
                array('h' => 'Cookies', 'p' => array(
                    'Our website uses cookies to keep the quote form working correctly, remember your preferences, and understand how visitors use our site. You can disable cookies in your browser settings, though some features may not work as intended.',
                )),
                array('h' => 'Data Security', 'p' => array(
                    'We use reasonable administrative and technical safeguards to protect your information against unauthorised access, alteration, or disclosure. No method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.',
                )),
                array('h' => 'Data Retention', 'p' => array(
                    'We retain your information for as long as needed to provide our services, comply with legal obligations, resolve disputes, and enforce our agreements.',
                )),
                array('h' => 'Your Rights', 'p' => array(
                    'You may request access to, correction of, or deletion of your personal information by writing to us at the contact details below, subject to applicable law.',
                )),
                array('h' => 'Grievance Officer', 'p' => array(
                    'In accordance with the Information Technology Act, 2000 and rules made thereunder, the contact details of the Grievance Officer are provided below for any complaints or concerns regarding this policy.',
                )),
            ),
        ),

        'terms-and-conditions' => array(
            'title'   => 'Terms &amp; Conditions',
            'updated' => 'January 2026',
            'intro'   => 'These Terms &amp; Conditions govern your use of the Sure Shift website and your booking of any relocation, transportation, or storage service with Sure Shift Relocation Services. By booking a service, you agree to these terms.',
            'sections' => array(
                array('h' => 'Services Offered', 'p' => array(
                    'Sure Shift provides household and office relocation, vehicle transport, international relocation coordination, secure storage, and related logistics services across India and to select international destinations, as described on this website.',
                )),
                array('h' => 'Booking &amp; Confirmation', 'p' => array(
                    'A booking is confirmed only after Sure Shift acknowledges it in writing (via SMS, email, or WhatsApp) following a survey or quote acceptance. Verbal enquiries or form submissions alone do not constitute a confirmed booking.',
                )),
                array('h' => 'Pricing &amp; Estimates', 'p' => array(
                    'Quotes provided over phone or through the website are estimates based on the information shared by the customer. The final price is confirmed after a physical or virtual survey and may vary based on actual volume, distance, floor/access conditions, and additional services requested.',
                )),
                array('h' => 'Customer Responsibilities', 'list' => array(
                    'Provide accurate details of items, addresses, and access conditions (stairs, lift availability, parking distance)',
                    'Ensure valuables, cash, jewellery, and important documents are carried personally and not handed over for transport',
                    'Be present or nominate a representative at the time of pickup and delivery',
                    'Settle outstanding payments as per the agreed schedule',
                )),
                array('h' => 'Restricted &amp; Prohibited Items', 'p' => array(
                    'Sure Shift does not transport hazardous, flammable, illegal, perishable, or prohibited items including but not limited to gas cylinders, explosives, firearms, narcotics, and live plants/pets unless specifically agreed in writing.',
                )),
                array('h' => 'Liability &amp; Insurance', 'p' => array(
                    'All shipments are handled with a zero-damage commitment; however, liability for loss or damage is limited to the declared value of goods and any applicable transit insurance, as detailed in the Damage Claim Policy. Sure Shift is not liable for items not disclosed at the time of booking.',
                )),
                array('h' => 'Delays &amp; Force Majeure', 'p' => array(
                    'Sure Shift is not liable for delays caused by circumstances beyond reasonable control, including natural disasters, strikes, road closures, government restrictions, or extreme weather conditions.',
                )),
                array('h' => 'Cancellation', 'p' => array(
                    'Bookings may be cancelled or rescheduled as per the Cancellation Policy. Sure Shift reserves the right to decline or cancel a booking where information provided is inaccurate or items are prohibited.',
                )),
                array('h' => 'Governing Law', 'p' => array(
                    'These terms are governed by the laws of India, and any disputes shall be subject to the exclusive jurisdiction of the courts at New Delhi.',
                )),
            ),
        ),

        'refund-policy' => array(
            'title'   => 'Refund Policy',
            'updated' => 'January 2026',
            'intro'   => 'This policy explains when and how refunds are processed for payments made towards Sure Shift services.',
            'sections' => array(
                array('h' => 'Eligibility for Refund', 'list' => array(
                    'Booking cancelled within the free-cancellation window (see Cancellation Policy)',
                    'Service not rendered due to a failure on Sure Shift\'s part',
                    'Duplicate or excess payment made in error',
                )),
                array('h' => 'Refund Timeline', 'p' => array(
                    'Eligible refunds are processed within 7–10 business days from the date of approval, subject to your bank or payment provider\'s own processing timelines.',
                )),
                array('h' => 'Mode of Refund', 'p' => array(
                    'Refunds are credited to the original payment method used at the time of booking. For cash payments, refunds are issued via bank transfer to an account nominated by the customer.',
                )),
                array('h' => 'Non-Refundable Charges', 'p' => array(
                    'Survey charges, packing material already consumed, and services already rendered (e.g. partial packing completed) are non-refundable once the work has commenced.',
                )),
                array('h' => 'Disputed Transactions', 'p' => array(
                    'If you believe a charge was made in error, please contact us within 30 days of the transaction with your booking reference for investigation.',
                )),
            ),
        ),

        'payment-policy' => array(
            'title'   => 'Payment Policy',
            'updated' => 'January 2026',
            'intro'   => 'This policy outlines the accepted payment methods and payment structure for bookings made with Sure Shift Relocation Services.',
            'sections' => array(
                array('h' => 'Accepted Payment Methods', 'list' => array(
                    'UPI (Google Pay, PhonePe, Paytm and other UPI apps)',
                    'Credit and debit cards',
                    'Net banking',
                    'Bank transfer / NEFT / RTGS',
                    'Cash, for locally coordinated moves where agreed in advance',
                )),
                array('h' => 'Payment Structure', 'p' => array(
                    'Bookings typically require a nominal advance/token amount to confirm the schedule, with the balance payable on completion of packing or before unloading at the destination, as agreed at the time of booking. The exact split will be confirmed in your booking summary.',
                )),
                array('h' => 'Invoicing &amp; GST', 'p' => array(
                    'A GST-compliant invoice is issued for every service. GST is charged at the applicable rate as per prevailing government regulations and is included in your final invoice.',
                )),
                array('h' => 'Payment Security', 'p' => array(
                    'All online payments are processed through PCI-DSS compliant, secure payment gateways. Sure Shift does not store your card details on its servers.',
                )),
                array('h' => 'Outstanding Payments', 'p' => array(
                    'Delivery of goods may be withheld until outstanding balances are cleared, as per the terms agreed at booking. Delayed payments may attract applicable late fees as communicated in advance.',
                )),
            ),
        ),

        'cancellation-policy' => array(
            'title'   => 'Cancellation Policy',
            'updated' => 'January 2026',
            'intro'   => 'We understand plans can change. This policy explains how to cancel or reschedule a booking and any applicable charges.',
            'sections' => array(
                array('h' => 'How to Cancel or Reschedule', 'p' => array(
                    'Cancellations or rescheduling requests can be made by calling 09073291732 or emailing info@sureshift.in with your booking reference, as early as possible before the scheduled move date.',
                )),
                array('h' => 'Cancellation Charges', 'list' => array(
                    'More than 72 hours before the scheduled move — no cancellation charge',
                    '24–72 hours before the scheduled move — nominal charge to cover survey and scheduling costs',
                    'Less than 24 hours before the scheduled move, or on-site cancellation — charges applicable towards crew, vehicle, and material allocation',
                    'No-show at the scheduled time without prior notice — full applicable charges as per booking terms',
                )),
                array('h' => 'Rescheduling', 'p' => array(
                    'One free rescheduling is offered when requested at least 48 hours in advance, subject to crew and vehicle availability on the new date.',
                )),
                array('h' => 'Cancellation by Sure Shift', 'p' => array(
                    'In the rare event Sure Shift needs to cancel a confirmed booking due to unforeseen operational reasons, customers will be notified promptly and offered a full refund of any advance paid, or a priority-rescheduled slot.',
                )),
            ),
        ),

        'disclaimer' => array(
            'title'   => 'Disclaimer',
            'updated' => 'January 2026',
            'intro'   => 'The information on this website is provided by Sure Shift Relocation Services for general informational purposes only.',
            'sections' => array(
                array('h' => 'Accuracy of Information', 'p' => array(
                    'While we strive to keep information on this website accurate and up to date, we make no warranty of any kind regarding the completeness, accuracy, or reliability of the content. Prices, service areas, and timelines mentioned are indicative and subject to confirmation at the time of booking.',
                )),
                array('h' => 'Estimates, Not Guarantees', 'p' => array(
                    'Any quote, cost estimate, or delivery timeline shared through this website, over phone, or via chat is approximate and based on information provided by the customer. Final figures are confirmed only after a survey and formal booking.',
                )),
                array('h' => 'Third-Party Links', 'p' => array(
                    'This website may contain links to third-party websites (such as social media or payment gateways) that are not owned or controlled by Sure Shift. We are not responsible for the content, privacy policies, or practices of any third-party sites.',
                )),
                array('h' => 'Limitation of Liability', 'p' => array(
                    'In no event shall Sure Shift be liable for any indirect, incidental, or consequential loss arising from the use of this website. Liability for actual moving services is governed separately by our Terms &amp; Conditions and Damage Claim Policy.',
                )),
            ),
        ),

        'damage-claim-policy' => array(
            'title'   => 'Damage Claim Policy',
            'updated' => 'January 2026',
            'intro'   => 'Every move at Sure Shift is backed by our Zero Damage Guarantee. In the unlikely event of loss or damage, this policy explains how to file and resolve a claim.',
            'sections' => array(
                array('h' => 'Reporting Window', 'p' => array(
                    'Any damage or shortage must be reported within 48 hours of delivery, either by noting it on the delivery receipt at the time of unloading or by contacting our support team in writing.',
                )),
                array('h' => 'How to File a Claim', 'list' => array(
                    'Share your booking reference / consignment number',
                    'Provide clear photographs of the damaged item and its packaging',
                    'Attach the signed delivery receipt or proof-of-delivery document',
                    'Submit an inventory list highlighting the affected item(s)',
                )),
                array('h' => 'Claim Assessment', 'p' => array(
                    'Our claims team reviews the submitted evidence, along with the pre-move survey and packing records, and communicates an assessment outcome within 7–10 business days of receiving complete documentation.',
                )),
                array('h' => 'Exclusions', 'list' => array(
                    'Items not packed by Sure Shift\'s own crew (self-packed cartons), unless damage is to the exterior of the carton',
                    'Pre-existing damage noted and signed off at the time of pickup',
                    'Natural wear and tear, or damage to fragile items not declared and specially packed',
                    'Cash, jewellery, and valuables not disclosed at the time of booking',
                    'Claims reported after the 48-hour window',
                )),
                array('h' => 'Settlement', 'p' => array(
                    'Approved claims are settled either via repair, replacement, or compensation up to the declared value / applicable insurance cover, within 15 business days of approval.',
                )),
            ),
        ),
    );
}

add_action('init', function () {
    add_rewrite_rule('^(privacy-policy|terms-and-conditions|refund-policy|payment-policy|cancellation-policy|disclaimer|damage-claim-policy)/?$', 'index.php?ss_legal=$matches[1]', 'top');
    add_rewrite_rule('^sitemap/?$', 'index.php?ss_sitemap=1', 'top');

    if (get_option('ss_legal_rules_flushed') !== SS_LOCATION_RULES_VERSION) {
        flush_rewrite_rules();
        update_option('ss_legal_rules_flushed', SS_LOCATION_RULES_VERSION);
    }
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'ss_legal';
    $vars[] = 'ss_sitemap';
    return $vars;
});

add_filter('pre_get_document_title', function ($title) {
    $legal = get_query_var('ss_legal');
    if (!empty($legal)) {
        $pages = ss_get_legal_pages();
        if (isset($pages[$legal])) {
            return $pages[$legal]['title'] . ' | Sure Shift Relocation Services';
        }
    }
    if (get_query_var('ss_sitemap')) {
        return 'Sitemap | Sure Shift Relocation Services';
    }
    return $title;
});

add_action('template_redirect', function () {
    global $wp_query;

    $legal = get_query_var('ss_legal');
    if (!empty($legal)) {
        $pages = ss_get_legal_pages();
        if (isset($pages[$legal])) {
            $wp_query->is_404 = false;
            status_header(200);
            $tpl = locate_template('template-legal.php');
            if ($tpl) { include $tpl; exit; }
        }
    }

    if (get_query_var('ss_sitemap')) {
        $wp_query->is_404 = false;
        status_header(200);
        $tpl = locate_template('template-sitemap.php');
        if ($tpl) { include $tpl; exit; }
    }
});

/* ══════════════════════════════════════════════
   SERVICE PAGES (virtual, dynamic)
   Powers /services/{slug}/ — no WP Pages required.
══════════════════════════════════════════════ */

function ss_get_all_services() {
    return array(
        'household-moving' => array(
            'name' => 'Household Moving', 'tag' => 'Most Popular',
            'icon' => 'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z M9 22V12h6v10 M12 7v.01',
            'intro' => "Complete home relocation, from a single room to a full villa — professionally packed, GPS-tracked, and backed by our zero-damage guarantee.",
            'features' => array(
                'Free pre-move survey to plan packing material and vehicle size',
                'Room-wise labelled packing with quality-grade cartons and bubble wrap',
                'Dismantling &amp; reassembly of furniture and modular units',
                'GPS-tracked, containerised transport with live updates',
                'Unpacking and placement assistance at your new home',
            ),
            'faqs' => array(
                array('q' => 'How far in advance should I book a household move?', 'a' => 'We recommend booking at least 5-7 days in advance for a smooth survey and packing schedule, though we do accommodate urgent moves where possible.'),
                array('q' => 'Do you provide packing material?', 'a' => 'Yes — all cartons, bubble wrap, stretch film, and protective covers are included as part of your quote.'),
                array('q' => 'Is my furniture insured during the move?', 'a' => 'Yes, transit coverage is included and can be enhanced with additional declared-value insurance for high-value items.'),
            ),
        ),
        'office-moving' => array(
            'name' => 'Office Shifting', 'tag' => 'Zero Downtime',
            'icon' => 'M2 20h20M6 20V4h12v16M10 9h4M10 13h4M10 17h4',
            'intro' => "Corporate and office relocation planned around your business hours — IT equipment, workstations, and records handled with minimal disruption.",
            'features' => array(
                'Weekend/after-hours moving to avoid business downtime',
                'Specialised handling for IT equipment, servers, and electronics',
                'Systematic labelling for fast reassembly at the new office',
                'Dedicated move manager coordinating with your facilities team',
                'Secure handling of confidential files and documents',
            ),
            'faqs' => array(
                array('q' => 'Can you move us over a weekend?', 'a' => 'Yes, weekend and after-hours moves are common for offices and can be scheduled at no extra planning cost.'),
                array('q' => 'Do you handle server and IT equipment?', 'a' => 'Yes, our crews are trained in anti-static packing and safe handling of servers, monitors, and networking equipment.'),
                array('q' => 'Can you help set up the new office layout?', 'a' => 'Yes, our team can place furniture and workstations per a floor plan you provide.'),
            ),
        ),
        'international-moving' => array(
            'name' => 'International Moving', 'tag' => '88+ Countries',
            'icon' => 'M12 2a10 10 0 100 20A10 10 0 0012 2z M2 12h20 M12 2a15.3 15.3 0 000 20M12 2a15.3 15.3 0 010 20',
            'intro' => "End-to-end international relocation — export packing, customs documentation, and destination-agent coordination to 88+ countries.",
            'features' => array(
                'Export-grade wooden crating for sea and air freight',
                'Customs documentation and clearance support',
                'Door-to-door coordination via verified destination agents',
                'Sea (FCL/LCL) and air freight options based on timeline and budget',
                'Marine transit insurance available for full peace of mind',
            ),
            'faqs' => array(
                array('q' => 'How long does an international move take?', 'a' => 'Sea freight typically takes 4-8 weeks depending on the destination; air freight is faster but more expensive. We\'ll confirm exact timelines during your survey.'),
                array('q' => 'Do you handle customs paperwork?', 'a' => 'Yes, we assist with export documentation and coordinate with destination agents for import clearance.'),
                array('q' => 'Is insurance included?', 'a' => 'Basic transit liability is included; comprehensive marine insurance can be added based on declared value.'),
            ),
        ),
        'car-transport' => array(
            'name' => 'Car Transport', 'tag' => 'Enclosed Carriers',
            'icon' => 'M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2 M9 21a2 2 0 100-4 2 2 0 000 4z M15 21a2 2 0 100-4 2 2 0 000 4z',
            'intro' => "Safe, insured car transport across India on open or enclosed carriers — ideal for relocations, dealership transfers, or online purchases.",
            'features' => array(
                'Open and enclosed carrier options based on budget and vehicle value',
                'Door-to-door pickup and delivery',
                'Pre-transport condition report with photos',
                'GPS-tracked transport with live status updates',
                'Transit insurance included on every consignment',
            ),
            'faqs' => array(
                array('q' => 'What is the difference between open and enclosed carriers?', 'a' => 'Open carriers are more economical and suit most vehicles; enclosed carriers fully shield the car from weather and road debris, recommended for premium or vintage cars.'),
                array('q' => 'How long does car transport take?', 'a' => 'Typically 3-7 days depending on distance, subject to route and carrier schedule.'),
                array('q' => 'Is my car insured during transport?', 'a' => 'Yes, all vehicles are covered under transit insurance for the declared value.'),
            ),
        ),
        'bike-transport' => array(
            'name' => 'Bike Transport', 'tag' => 'Crated &amp; Secure',
            'icon' => 'M12 12m-3 0a3 3 0 106 0 3 3 0 10-6 0 M6 12m-3 0a3 3 0 106 0 3 3 0 10-6 0 M6 12h-2 M9 9.5L12 3l1.5 3h3l-1.5 2.5 M15 9l3 3',
            'intro' => "Two-wheeler transport with wooden crating or padded packaging, insured and tracked door-to-door across India.",
            'features' => array(
                'Wooden crate or padded-cover packing based on bike value',
                'Fuel-drain and battery-disconnect handled per safety norms',
                'Door-to-door pickup and delivery',
                'Real-time GPS tracking of your consignment',
                'Insurance coverage included',
            ),
            'faqs' => array(
                array('q' => 'Do I need to prepare my bike before pickup?', 'a' => 'Our crew handles fuel-draining and battery disconnection on-site; you just need to hand over the bike with its documents.'),
                array('q' => 'How is the bike packed?', 'a' => 'Bikes are wrapped in protective covers and secured in a wooden crate or padded cover, depending on the transport mode chosen.'),
                array('q' => 'Can I track my bike during transport?', 'a' => 'Yes, GPS tracking is provided with live status updates.'),
            ),
        ),
        'secure-storage' => array(
            'name' => 'Secure Storage', 'tag' => 'Short &amp; Long Term',
            'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4 M12 12v4',
            'intro' => "Clean, secure warehousing for household or business goods — from a few weeks to several months, with full inventory tracking.",
            'features' => array(
                'CCTV-monitored, access-controlled warehouses',
                'Pest-controlled and weatherproof storage units',
                'Itemised inventory list with photo documentation',
                'Flexible short-term and long-term plans',
                'Easy scheduling for withdrawal or redelivery',
            ),
            'faqs' => array(
                array('q' => 'What is the minimum storage duration?', 'a' => 'We offer flexible plans starting from a few weeks, with discounted rates for longer durations.'),
                array('q' => 'Are my goods insured in storage?', 'a' => 'Yes, storage insurance is available based on the declared value of goods.'),
                array('q' => 'Can I access my items during storage?', 'a' => 'Yes, withdrawals can be scheduled with advance notice.'),
            ),
        ),
        'fine-arts' => array(
            'name' => 'Fine Arts Moving', 'tag' => 'Museum-Grade Packing',
            'icon' => 'M4 4h16v16H4z M4 4l7 7 M20 4l-7 7 M4 20l7-7 M20 20l-7-7',
            'intro' => "Specialised handling for paintings, sculptures, antiques, and pianos — custom crating and climate-aware transport for irreplaceable items.",
            'features' => array(
                'Custom-built crates sized to each piece',
                'Acid-free wrapping for paintings and delicate surfaces',
                'Specialised equipment and trained crew for pianos and sculptures',
                'Climate-conscious loading and transport planning',
                'Enhanced declared-value insurance available',
            ),
            'faqs' => array(
                array('q' => 'Can you move a piano?', 'a' => 'Yes, our crew is trained in upright and grand piano handling, including specialised dollies and ramps.'),
                array('q' => 'How are paintings and artwork protected?', 'a' => 'Each piece is wrapped in acid-free materials and cushioned in custom crates or corner-protected packaging.'),
                array('q' => 'Do you insure high-value art?', 'a' => 'Yes, we offer enhanced insurance based on the appraised or declared value of the item.'),
            ),
        ),
        'commercial-moving' => array(
            'name' => 'Commercial Moving', 'tag' => 'Warehouses &amp; Retail',
            'icon' => 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z',
            'intro' => "Relocation for warehouses, factories, and retail chains — machinery, racking, and bulk inventory moved with minimal business disruption.",
            'features' => array(
                'Planning around production or business schedules',
                'Machinery dismantling, rigging, and reinstallation support',
                'Bulk inventory and racking relocation',
                'Fleet of containerised and open trucks for large volumes',
                'Dedicated project manager for multi-day relocations',
            ),
            'faqs' => array(
                array('q' => 'Can you move heavy machinery?', 'a' => 'Yes, we coordinate rigging and specialised equipment for machinery dismantling, loading, and reinstallation.'),
                array('q' => 'Do you handle multi-location or multi-day moves?', 'a' => 'Yes, larger commercial relocations are assigned a dedicated project manager who coordinates the full timeline.'),
                array('q' => 'Can you move during non-business hours?', 'a' => 'Yes, we regularly schedule commercial moves overnight or on weekends to avoid downtime.'),
            ),
        ),
        'courier' => array(
            'name' => 'Courier Services', 'tag' => 'Express Delivery',
            'icon' => 'M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z M22 6l-10 7L2 6',
            'intro' => "Document and parcel courier across India with live tracking — reliable for both personal and business shipments.",
            'features' => array(
                'Pan-India pickup and delivery network',
                'Live consignment tracking',
                'Secure handling for documents and small parcels',
                'Standard and express delivery options',
                'Proof of delivery on request',
            ),
            'faqs' => array(
                array('q' => 'How can I track my courier?', 'a' => 'Use the Track Shipment tool on our homepage with your consignment number for live status.'),
                array('q' => 'What is the typical delivery time?', 'a' => 'Standard delivery is 2-5 business days depending on distance; express options are available for urgent shipments.'),
                array('q' => 'Can I get proof of delivery?', 'a' => 'Yes, signed proof of delivery is available on request.'),
            ),
        ),
        'truck-rental' => array(
            'name' => 'Truck Rental', 'tag' => 'With or Without Driver',
            'icon' => 'M1 3h15v13H1z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z',
            'intro' => "Rent a truck for your own move or business haulage, with or without a driver, across a range of vehicle sizes.",
            'features' => array(
                'Range of vehicle sizes from mini trucks to full containers',
                'Options with or without an experienced driver',
                'Flexible hourly, one-way, or multi-day rentals',
                'Well-maintained, GPS-fitted fleet',
                'Transparent, distance-based pricing',
            ),
            'faqs' => array(
                array('q' => 'Can I rent a truck without a driver?', 'a' => 'Yes, self-drive rentals are available subject to a valid commercial/light-vehicle licence and verification.'),
                array('q' => 'What truck sizes are available?', 'a' => 'We offer a range from mini trucks (Tata Ace-type) up to large containerised trucks depending on your load.'),
                array('q' => 'Is one-way rental available?', 'a' => 'Yes, one-way rentals between cities are available with route-based pricing.'),
            ),
        ),
        'last-mile' => array(
            'name' => 'Last Mile Delivery', 'tag' => 'For Businesses',
            'icon' => 'M3 3h13v13H3z M16 8h4l3 3v5h-7V8z M5.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M18.5 21a2.5 2.5 0 100-5 2.5 2.5 0 000 5z',
            'intro' => "Final-mile logistics for e-commerce and business shipments — reliable delivery to the customer's doorstep with live tracking.",
            'features' => array(
                'Doorstep delivery network across serviced cities',
                'Real-time tracking for you and your customers',
                'Cash-on-delivery collection support',
                'Bulk and scheduled delivery runs for businesses',
                'Proof of delivery with e-signature/photo capture',
            ),
            'faqs' => array(
                array('q' => 'Do you support COD (cash on delivery)?', 'a' => 'Yes, COD collection and reconciliation is available for business clients.'),
                array('q' => 'Can this integrate with our e-commerce operations?', 'a' => 'Yes, we support bulk manifest uploads and scheduled delivery runs — contact us to discuss integration.'),
                array('q' => 'What cities are covered?', 'a' => 'Last-mile delivery is available across our 664+ serviced locations — check our Locations page or contact us to confirm your city.'),
            ),
        ),
        'odc' => array(
            'name' => 'ODC Consignment', 'tag' => 'Over-Dimensional Cargo',
            'icon' => 'M1 3h20l-2 10H3z M3 13v6h16v-6 M7 19v2 M17 19v2',
            'intro' => "Specialised transport for over-dimensional and heavy cargo, with route surveys, permits, and escort coordination.",
            'features' => array(
                'Route survey and feasibility assessment for oversized loads',
                'State/inter-state permit and escort coordination',
                'Hydraulic axle trailers and specialised low-bed trucks',
                'Load securing engineered for irregular dimensions',
                'End-to-end project management for industrial cargo',
            ),
            'faqs' => array(
                array('q' => 'What counts as over-dimensional cargo?', 'a' => 'Any consignment exceeding standard truck dimensions or weight limits — such as industrial machinery, transformers, or wind turbine components.'),
                array('q' => 'Do you handle permits?', 'a' => 'Yes, we coordinate the required state and inter-state permits and police escorts where mandated.'),
                array('q' => 'How is pricing determined?', 'a' => 'Pricing depends on route survey findings, permit costs, and specialised equipment required — shared as a detailed quote after assessment.'),
            ),
        ),
    );
}

add_action('init', function () {
    add_rewrite_rule('^services/([a-z0-9-]+)/?$', 'index.php?ss_service=$matches[1]', 'top');

    if (get_option('ss_service_rules_flushed') !== SS_LOCATION_RULES_VERSION) {
        flush_rewrite_rules();
        update_option('ss_service_rules_flushed', SS_LOCATION_RULES_VERSION);
    }
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'ss_service';
    return $vars;
});

add_filter('pre_get_document_title', function ($title) {
    $slug = get_query_var('ss_service');
    if (!empty($slug)) {
        $services = ss_get_all_services();
        if (isset($services[$slug])) {
            return $services[$slug]['name'] . ' | Free Quote — Sure Shift';
        }
    }
    return $title;
});

add_action('template_redirect', function () {
    global $wp_query;

    $slug = get_query_var('ss_service');
    if (!empty($slug)) {
        $services = ss_get_all_services();
        if (isset($services[$slug])) {
            $wp_query->is_404 = false;
            status_header(200);
            $tpl = locate_template('template-service.php');
            if ($tpl) { include $tpl; exit; }
        }
    }
});

/* ══════════════════════════════════════════════
   COMPANY PAGES (virtual, dynamic)
   Powers /blog/, /careers/, /contact-us/, /pay-online/
   and /become-our-partner/ — no WP Pages required.
══════════════════════════════════════════════ */

add_action('init', function () {
    add_rewrite_rule('^(blog|careers|contact-us|pay-online|become-our-partner)/?$', 'index.php?ss_company=$matches[1]', 'top');

    if (get_option('ss_company_rules_flushed') !== SS_LOCATION_RULES_VERSION) {
        flush_rewrite_rules();
        update_option('ss_company_rules_flushed', SS_LOCATION_RULES_VERSION);
    }
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'ss_company';
    return $vars;
});

add_filter('pre_get_document_title', function ($title) {
    $page = get_query_var('ss_company');
    $titles = array(
        'blog'                => 'Blog &amp; News',
        'careers'             => 'Careers',
        'contact-us'          => 'Contact Us',
        'pay-online'          => 'Pay Online',
        'become-our-partner'  => 'Become Our Partner',
    );
    if (!empty($page) && isset($titles[$page])) {
        return wp_strip_all_tags($titles[$page]) . ' | Sure Shift Relocation Services';
    }
    return $title;
});

add_action('template_redirect', function () {
    global $wp_query;

    $page = get_query_var('ss_company');
    if (!empty($page)) {
        $wp_query->is_404 = false;
        status_header(200);
        $tpl = locate_template('template-' . $page . '.php');
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
