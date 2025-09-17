<?php
/**
 * Sözlük Theme Functions
 */

// Theme Setup
function sozluk_theme_setup() {
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'sozluk_theme_setup');

// Enqueue styles and scripts
function sozluk_enqueue_assets() {
    // Normalize CSS first
    wp_enqueue_style('normalize-css', get_template_directory_uri() . '/css/normalize.css', array(), '1.0.0');

    // Fontello icons
    wp_enqueue_style('fontello-css', get_template_directory_uri() . '/css/fontello/css/fontello.css', array(), '1.0.0');

    // Local fonts
    wp_enqueue_style('fonts-local-css', get_template_directory_uri() . '/css/fonts-local.css', array(), '1.0.0');

    // Main theme stylesheet (depends on the above)
    wp_enqueue_style('sozluk-style', get_stylesheet_uri(), array('normalize-css', 'fontello-css', 'fonts-local-css'), filemtime(get_stylesheet_directory() . '/style.css'));

    // Add theme support for Ruki design and critical CSS
    wp_add_inline_style('sozluk-style', '
    /* Critical CSS for immediate loading */
    :root {
        --body-font: "Mulish", Arial, Helvetica, sans-serif;
        --link-color: #6c5b7b;
        --link-hover-color: #f67280;
        --body-background: #fff7f3;
        --post-background: #ffffff;
        --very-dark-grey: #2e2f33;
        --medium-grey: #94979e;
    }

    body {
        font-family: var(--body-font) !important;
        background-color: var(--body-background) !important;
        color: #45464b !important;
        line-height: 1.6 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .site-header {
        background: #ffffff !important;
        border-bottom: 1px solid #f1f1f1 !important;
        position: relative !important;
        z-index: 999 !important;
    }

    .container {
        max-width: 1280px !important;
        margin: 0 auto !important;
        padding: 0 15px !important;
    }

    .logo-text {
        font-size: 2rem !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    .logo-s { color: #e74c3c !important; }
    .logo-o1 { color: #f39c12 !important; }
    .logo-z { color: #2ecc71 !important; }
    .logo-l { color: #3498db !important; }
    .logo-u { color: #9b59b6 !important; }
    .logo-k { color: #e67e22 !important; }
    ');
    
    // Ruki theme JavaScript
    if (file_exists(get_template_directory() . '/js/ruki-theme.js')) {
        wp_enqueue_script('ruki-theme-js', get_template_directory_uri() . '/js/ruki-theme.js', array('jquery'), filemtime(get_template_directory() . '/js/ruki-theme.js'), true);

        // Localize script for AJAX
        wp_localize_script('ruki-theme-js', 'sozluk_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sozluk_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'sozluk_enqueue_assets');

// Database connection function for custom dictionary functionality
function get_sozluk_connection() {
    global $wpdb;
    
    // Get WordPress database connection details
    $host = DB_HOST;
    $dbname = DB_NAME;
    $username = DB_USER;
    $password = DB_PASSWORD;
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}

// Search words function
function search_sozluk_words($query, $letter = '') {
    $pdo = get_sozluk_connection();
    if (!$pdo) return [];
    
    $sql = "
        SELECT w.*, c.name as category_name 
        FROM words w 
        LEFT JOIN categories c ON w.category_id = c.id 
        WHERE w.deleted_at IS NULL
    ";
    
    $params = [];
    
    if (!empty($query)) {
        $sql .= " AND (w.word LIKE :query OR w.meaning LIKE :query)";
        $params[':query'] = '%' . $query . '%';
    }
    
    if (!empty($letter)) {
        $sql .= " AND w.word LIKE :letter";
        $params[':letter'] = $letter . '%';
    }
    
    $sql .= " ORDER BY w.word ASC LIMIT 50";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

// Get categories
function get_sozluk_categories() {
    $pdo = get_sozluk_connection();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

// Get statistics
function get_sozluk_stats() {
    $pdo = get_sozluk_connection();
    if (!$pdo) return ['categories' => 0, 'words' => 0, 'deleted' => 0];
    
    try {
        $stats = [];
        $stats['categories'] = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
        $stats['words'] = $pdo->query("SELECT COUNT(*) FROM words WHERE deleted_at IS NULL")->fetchColumn();
        $stats['deleted'] = $pdo->query("SELECT COUNT(*) FROM words WHERE deleted_at IS NOT NULL")->fetchColumn();
        return $stats;
    } catch (PDOException $e) {
        return ['categories' => 0, 'words' => 0, 'deleted' => 0];
    }
}

// AJAX handler for search
add_action('wp_ajax_sozluk_search', 'handle_sozluk_search');
add_action('wp_ajax_nopriv_sozluk_search', 'handle_sozluk_search');

function handle_sozluk_search() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'sozluk_nonce')) {
        wp_die('Security check failed');
    }
    
    $query = sanitize_text_field($_POST['query'] ?? '');
    $letter = sanitize_text_field($_POST['letter'] ?? '');
    
    $results = search_sozluk_words($query, $letter);
    
    wp_send_json_success($results);
}

// Custom search functionality
function sozluk_search_filter($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        // Get search parameters
        $search_query = get_search_query();
        $letter = get_query_var('letter');
        
        // Get results from custom database
        $results = search_sozluk_words($search_query, $letter);
        
        // Store results for template use
        set_query_var('sozluk_results', $results);
    }
}
add_action('pre_get_posts', 'sozluk_search_filter');

// Add custom query vars
function sozluk_query_vars($vars) {
    $vars[] = 'letter';
    return $vars;
}
add_filter('query_vars', 'sozluk_query_vars');

// Shortcode for displaying word count
function sozluk_word_count_shortcode($atts) {
    $stats = get_sozluk_stats();
    return number_format($stats['words']);
}
add_shortcode('word_count', 'sozluk_word_count_shortcode');

// Shortcode for displaying category count
function sozluk_category_count_shortcode($atts) {
    $stats = get_sozluk_stats();
    return number_format($stats['categories']);
}
add_shortcode('category_count', 'sozluk_category_count_shortcode');

// Add custom body classes
function sozluk_body_classes($classes) {
    if (is_search()) {
        $classes[] = 'search-results-page';
    }
    if (get_query_var('letter')) {
        $classes[] = 'letter-filter-active';
    }
    return $classes;
}
add_filter('body_class', 'sozluk_body_classes');

// Customize search form
function sozluk_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="' . home_url('/') . '">
        <input type="text" class="search-input" placeholder="Söz, termin, ad axtar" value="' . get_search_query() . '" name="s">
        <button type="submit" class="search-button">Axtar</button>
    </form>';
    
    return $form;
}
add_filter('get_search_form', 'sozluk_search_form');

// Admin customization
function sozluk_admin_init() {
    // Add custom dashboard widget
    add_action('wp_dashboard_setup', 'sozluk_dashboard_widget');
}
add_action('admin_init', 'sozluk_admin_init');

function sozluk_dashboard_widget() {
    wp_add_dashboard_widget(
        'sozluk_stats_widget',
        'Sözlük Statistikaları',
        'sozluk_dashboard_widget_content'
    );
}

function sozluk_dashboard_widget_content() {
    $stats = get_sozluk_stats();
    echo '<div style="display: flex; justify-content: space-between;">';
    echo '<div><strong>' . number_format($stats['words']) . '</strong><br>Aktiv Sözlər</div>';
    echo '<div><strong>' . number_format($stats['categories']) . '</strong><br>Kateqoriyalar</div>';
    echo '<div><strong>' . number_format($stats['deleted']) . '</strong><br>Silinmiş Sözlər</div>';
    echo '</div>';
}
?>