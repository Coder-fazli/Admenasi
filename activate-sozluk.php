<?php
/**
 * Advanced theme activator - Multiple methods to activate Sözlük theme
 */

// Include WordPress config
require_once('wp-config.php');
require_once('wp-load.php');

echo "<h1>Advanced Theme Activation</h1>";

// Method 1: Direct database update
global $wpdb;
$table_name = $wpdb->prefix . 'options';

$stylesheet_query = $wpdb->update(
    $table_name,
    array('option_value' => 'sozluk'),
    array('option_name' => 'stylesheet'),
    array('%s'),
    array('%s')
);

$template_query = $wpdb->update(
    $table_name,
    array('option_value' => 'sozluk'),
    array('option_name' => 'template'),
    array('%s'),
    array('%s')
);

echo "<h2>Method 1: Direct Database Update</h2>";
echo "<p>Stylesheet update: " . ($stylesheet_query !== false ? 'SUCCESS' : 'FAILED') . "</p>";
echo "<p>Template update: " . ($template_query !== false ? 'SUCCESS' : 'FAILED') . "</p>";

// Method 2: WordPress functions
$wp_result1 = update_option('stylesheet', 'sozluk');
$wp_result2 = update_option('template', 'sozluk');

echo "<h2>Method 2: WordPress Functions</h2>";
echo "<p>Stylesheet update: " . ($wp_result1 ? 'SUCCESS' : 'FAILED') . "</p>";
echo "<p>Template update: " . ($wp_result2 ? 'SUCCESS' : 'FAILED') . "</p>";

// Method 3: Switch theme function
if (function_exists('switch_theme')) {
    switch_theme('sozluk');
    echo "<h2>Method 3: Switch Theme Function</h2>";
    echo "<p>✅ Used switch_theme() function</p>";
}

// Verify current theme
echo "<h2>Current Status</h2>";
echo "<p><strong>Current Active Theme:</strong> " . get_option('stylesheet') . "</p>";
echo "<p><strong>Current Template:</strong> " . get_option('template') . "</p>";

// Clear all caches
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}
if (function_exists('wp_cache_delete')) {
    wp_cache_delete('alloptions', 'options');
}

echo "<p>✅ All caches cleared!</p>";
echo "<p><strong><a href='" . home_url() . "' target='_blank'>🔗 View Site Now</a></strong></p>";
echo "<p><a href='" . admin_url('themes.php') . "' target='_blank'>WordPress Admin Themes</a></p>";
?>