<?php
/**
 * Create storage link for Hostinger
 * Upload this file to public_html and run it once
 */

$target = "../storage/app/public";
$link = "storage";

if (is_link($link)) {
    unlink($link);
    echo "Removed existing storage link.<br>";
}

if (symlink($target, $link)) {
    echo "✅ Storage link created successfully!<br>";
    echo "You can now delete this file.";
} else {
    echo "❌ Failed to create storage link.<br>";
    echo "Please create it manually or contact support.";
}
?>