#!/usr/bin/env php
<?php

/**
 * Storage Directory Setup Script
 * 
 * Creates all required storage directories for Laravel.
 * Run this script after cloning the repository or if storage directories are missing.
 * 
 * Usage: php setup-storage.php
 */

$directories = [
    'storage/app',
    'storage/app/public',
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache',
];

echo "Setting up storage directories...\n\n";

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        if (mkdir($directory, 0755, true)) {
            echo "✓ Created: $directory\n";
        } else {
            echo "✗ Failed to create: $directory\n";
        }
    } else {
        echo "• Already exists: $directory\n";
    }
}

echo "\n✓ Storage setup complete!\n";
