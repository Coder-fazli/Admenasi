<?php
/**
 * Quick WordPress theme checker
 * Visit this file directly to see current theme status
 */

// Include WordPress config
require_once('wp-config.php');
require_once('wp-load.php');

echo "<h1>WordPress Theme Status</h1>";
echo "<p><strong>Current Active Theme:</strong> " . get_option('stylesheet') . "</p>";
echo "<p><strong>Current Template:</strong> " . get_option('template') . "</p>";
echo "<p><strong>Site URL:</strong> " . home_url() . "</p>";
echo "<p><strong>Theme Directory:</strong> " . get_template_directory() . "</p>";

// Check if sozluk theme exists
$themes = wp_get_themes();
echo "<h2>Available Themes:</h2><ul>";
foreach($themes as $theme_slug => $theme_obj) {
    $active = ($theme_slug == get_option('stylesheet')) ? ' (ACTIVE)' : '';
    echo "<li><strong>" . $theme_obj->get('Name') . "</strong> - " . $theme_slug . $active . "</li>";
}
echo "</ul>";

echo "<h2>Quick Fix:</h2>";
echo "<p>To activate Sözlük theme, add this to wp-config.php temporarily:</p>";
echo "<code>update_option('stylesheet', 'sozluk');<br>update_option('template', 'sozluk');</code>";
?>