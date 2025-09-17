<?php
/**
 * Direct database theme activation (last resort method)
 */

// Get database credentials from wp-config
require_once('wp-config.php');

echo "<h1>Direct Database Theme Activation</h1>";

try {
    // Connect to MySQL directly
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo "<p>✅ Database connection successful</p>";
    
    // Get table prefix
    $table_prefix = isset($table_prefix) ? $table_prefix : 'wp_';
    $options_table = $table_prefix . 'options';
    
    // Update stylesheet option
    $sql1 = "UPDATE `$options_table` SET `option_value` = 'sozluk' WHERE `option_name` = 'stylesheet'";
    $result1 = $conn->query($sql1);
    
    // Update template option  
    $sql2 = "UPDATE `$options_table` SET `option_value` = 'sozluk' WHERE `option_name` = 'template'";
    $result2 = $conn->query($sql2);
    
    echo "<h2>Direct Database Updates</h2>";
    echo "<p>Stylesheet update: " . ($result1 ? 'SUCCESS' : 'FAILED') . "</p>";
    echo "<p>Template update: " . ($result2 ? 'SUCCESS' : 'FAILED') . "</p>";
    
    // Verify the changes
    $verify = $conn->query("SELECT option_name, option_value FROM `$options_table` WHERE option_name IN ('stylesheet', 'template')");
    
    echo "<h2>Verification</h2>";
    while($row = $verify->fetch_assoc()) {
        echo "<p><strong>" . $row['option_name'] . ":</strong> " . $row['option_value'] . "</p>";
    }
    
    $conn->close();
    echo "<p>✅ <strong>Sozluk theme should now be active!</strong></p>";
    echo "<p><strong><a href='/' target='_blank'>🔗 View Site Now</a></strong></p>";
    
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}
?>