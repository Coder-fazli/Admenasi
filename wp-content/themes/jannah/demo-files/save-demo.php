<?php
/**
 * Demo File Saver Script
 * Run this after each successful demo import to save the files
 */

// Find the most recent demo import files
$uploads_dir = wp_upload_dir()['basedir'];
$current_month = date('Y/m');
$search_dir = $uploads_dir . '/' . $current_month;

echo "Searching for demo files in: " . $search_dir . "\n";

// Look for demo import files
$xml_files = glob($search_dir . '/demo-content-import-file_*.xml');
$json_files = glob($search_dir . '/demo-settings-import-file_*.json');

if (!empty($xml_files) && !empty($json_files)) {
    // Get the most recent files
    $latest_xml = end($xml_files);
    $latest_json = end($json_files);

    echo "Found XML: " . basename($latest_xml) . "\n";
    echo "Found JSON: " . basename($latest_json) . "\n";

    // Ask which demo this is
    echo "\nWhich demo is this? (demo, tech, sport, auto, creative, foods, times, photography, hotels, health, house, videos, videos-2, pets, travel, traveling, science, blog, minimal-blog, city, school, games, geo, cryptocurrency, salad-dash, fitness, seo): ";
    $demo_name = trim(fgets(STDIN));

    if (!empty($demo_name)) {
        // Create demo directory
        $demo_dir = __DIR__ . '/' . $demo_name;
        if (!file_exists($demo_dir)) {
            mkdir($demo_dir, 0755, true);
        }

        // Copy files
        $xml_dest = $demo_dir . '/demo.xml';
        $json_dest = $demo_dir . '/settings.json';

        if (copy($latest_xml, $xml_dest) && copy($latest_json, $json_dest)) {
            echo "✅ Successfully saved {$demo_name} demo files!\n";
            echo "   XML: {$xml_dest}\n";
            echo "   JSON: {$json_dest}\n";
        } else {
            echo "❌ Failed to copy files!\n";
        }
    }
} else {
    echo "❌ No demo import files found. Make sure the demo import was successful.\n";
}
?>