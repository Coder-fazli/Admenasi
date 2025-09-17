<?php
/**
 * Theme Debug Tool - Check what's happening with templates and styles
 */

require_once('wp-config.php');
require_once('wp-load.php');

echo "<h1>Theme Debug Information</h1>";

// Check current theme
echo "<h2>Theme Status</h2>";
echo "<p><strong>Active Theme:</strong> " . get_option('stylesheet') . "</p>";
echo "<p><strong>Template Directory:</strong> " . get_template_directory() . "</p>";
echo "<p><strong>Stylesheet Directory:</strong> " . get_stylesheet_directory() . "</p>";

// Check if files exist
$theme_files = array(
    'style.css' => get_stylesheet_directory() . '/style.css',
    'index.php' => get_template_directory() . '/index.php',
    'front-page.php' => get_template_directory() . '/front-page.php',
    'single.php' => get_template_directory() . '/single.php',
    'functions.php' => get_template_directory() . '/functions.php'
);

echo "<h2>Theme Files</h2>";
foreach ($theme_files as $name => $path) {
    $exists = file_exists($path) ? '✅' : '❌';
    $size = file_exists($path) ? filesize($path) . ' bytes' : 'Missing';
    echo "<p>$exists <strong>$name:</strong> $size</p>";
}

// Check WordPress settings
echo "<h2>WordPress Settings</h2>";
echo "<p><strong>Show on front:</strong> " . get_option('show_on_front') . "</p>";
echo "<p><strong>Front page ID:</strong> " . get_option('page_on_front') . "</p>";
echo "<p><strong>Posts page ID:</strong> " . get_option('page_for_posts') . "</p>";
echo "<p><strong>Home URL:</strong> " . home_url() . "</p>";
echo "<p><strong>Site URL:</strong> " . site_url() . "</p>";

// Check template hierarchy
echo "<h2>Template Detection</h2>";
if (is_front_page()) {
    echo "<p>✅ This is the front page</p>";
} else {
    echo "<p>❌ This is NOT the front page</p>";
}

// Test CSS loading
$style_url = get_stylesheet_uri();
echo "<h2>CSS Information</h2>";
echo "<p><strong>Stylesheet URL:</strong> <a href='$style_url' target='_blank'>$style_url</a></p>";

// Check for PHP errors
echo "<h2>PHP Syntax Check</h2>";
foreach (['front-page.php', 'single.php', 'index.php', 'functions.php'] as $file) {
    $filepath = get_template_directory() . '/' . $file;
    if (file_exists($filepath)) {
        $output = array();
        $return_var = 0;
        exec("php -l \"$filepath\" 2>&1", $output, $return_var);
        if ($return_var === 0) {
            echo "<p>✅ $file: No syntax errors</p>";
        } else {
            echo "<p>❌ $file: " . implode(' ', $output) . "</p>";
        }
    }
}

echo "<h2>Quick Actions</h2>";
echo "<p><a href='/setup-homepage.php' target='_blank'>🔧 Run Homepage Setup</a></p>";
echo "<p><a href='/' target='_blank'>🏠 View Home Page</a></p>";
echo "<p><a href='$style_url' target='_blank'>🎨 View CSS File</a></p>";
?>