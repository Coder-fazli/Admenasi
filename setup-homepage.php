<?php
/**
 * WordPress Homepage Setup - Configure theme and home page settings
 */

require_once('wp-config.php');
require_once('wp-load.php');

echo "<h1>WordPress Homepage Setup</h1>";

// Step 1: Ensure Sözlük theme is active
switch_theme('sozluk');
echo "<p>✅ Activated Sözlük theme</p>";

// Step 2: Set front page to show static page (not posts)
update_option('show_on_front', 'page');
echo "<p>✅ Set front page to static page mode</p>";

// Step 3: Create or find home page
$home_page = get_page_by_title('Ana Səhifə');
if (!$home_page) {
    // Create home page
    $home_page_id = wp_insert_post(array(
        'post_title' => 'Ana Səhifə',
        'post_content' => 'Bu səhifə avtomatik yaradılıb. Zəhmət olmasa silməyin.',
        'post_status' => 'publish',
        'post_type' => 'page'
    ));
} else {
    $home_page_id = $home_page->ID;
}

// Step 4: Set this page as front page
update_option('page_on_front', $home_page_id);
echo "<p>✅ Set Ana Səhifə as front page (ID: $home_page_id)</p>";

// Step 5: Create blog page
$blog_page = get_page_by_title('Bloqlar');
if (!$blog_page) {
    $blog_page_id = wp_insert_post(array(
        'post_title' => 'Bloqlar',
        'post_content' => 'Bu blog səhifəsidir.',
        'post_status' => 'publish',
        'post_type' => 'page'
    ));
} else {
    $blog_page_id = $blog_page->ID;
}

// Step 6: Set blog page for posts
update_option('page_for_posts', $blog_page_id);
echo "<p>✅ Set Bloqlar as blog page (ID: $blog_page_id)</p>";

// Step 7: Flush rewrite rules
flush_rewrite_rules();
echo "<p>✅ Flushed rewrite rules</p>";

// Step 8: Clear cache
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
    echo "<p>✅ Cleared cache</p>";
}

echo "<h2>Current Status:</h2>";
echo "<p><strong>Active Theme:</strong> " . get_option('stylesheet') . "</p>";
echo "<p><strong>Show on front:</strong> " . get_option('show_on_front') . "</p>";
echo "<p><strong>Front page ID:</strong> " . get_option('page_on_front') . "</p>";
echo "<p><strong>Posts page ID:</strong> " . get_option('page_for_posts') . "</p>";

echo "<h2>✅ Setup Complete!</h2>";
echo "<p><strong><a href='" . home_url() . "' target='_blank'>🔗 View Home Page</a></strong></p>";
echo "<p><strong><a href='" . get_permalink(get_option('page_for_posts')) . "' target='_blank'>🔗 View Blog Page</a></strong></p>";
?>