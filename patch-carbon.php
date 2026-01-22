<?php

/**
 * PHP 8.5 Compatibility Patch for Carbon
 * 
 * This script patches nesbot/carbon to work with PHP 8.5 by fixing the
 * CarbonPeriod::getIterator() return type compatibility issue.
 * 
 * Run after composer install/update: php patch-carbon.php
 */

$carbonPeriodFile = __DIR__ . '/vendor/nesbot/carbon/src/Carbon/CarbonPeriod.php';

if (!file_exists($carbonPeriodFile)) {
    echo "Carbon not installed yet, skipping patch.\n";
    exit(0);
}

$content = file_get_contents($carbonPeriodFile);

// Check if already patched
if (str_contains($content, 'public function getIterator(): \\Iterator')) {
    echo "Carbon already patched for PHP 8.5 compatibility.\n";
    exit(0);
}

// Use regex to find and replace the getIterator method (handles whitespace variations)
$pattern = '/public function getIterator\(\): Generator\s*\{\s*\$this->rewind\(\);\s*while \(\$this->valid\(\)\) \{\s*\$key = \$this->key\(\);\s*\$value = \$this->current\(\);\s*yield \$key => \$value;\s*\$this->next\(\);\s*\}\s*\}/s';

$newMethod = 'public function getIterator(): \\Iterator
    {
        $this->rewind();

        return new \\ArrayIterator(iterator_to_array((function (): \\Generator {
            while ($this->valid()) {
                $key = $this->key();
                $value = $this->current();

                yield $key => $value;

                $this->next();
            }
        })()));
    }';

if (preg_match($pattern, $content)) {
    $content = preg_replace($pattern, $newMethod, $content);
    file_put_contents($carbonPeriodFile, $content);
    echo "✓ Carbon patched for PHP 8.5 compatibility.\n";
} else {
    echo "Warning: Could not find expected code pattern in CarbonPeriod.php\n";
    echo "The Carbon version may have changed. Manual patching may be required.\n";
    exit(1);
}
