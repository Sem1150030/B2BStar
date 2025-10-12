<?php

require __DIR__ . '/vendor/autoload.php';

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// Create a test image (simulating a 1.4MB JPEG)
$manager = new ImageManager(new Driver());

// Create a high-resolution test image
$width = 2000;
$height = 2000;

echo "Creating test image ($width x $height)...\n";

// Create image with random pattern to simulate a real photo
$img = $manager->create($width, $height);

// Fill with a gradient-like pattern
for ($y = 0; $y < $height; $y += 10) {
    for ($x = 0; $x < $width; $x += 10) {
        $color = sprintf('rgb(%d, %d, %d)',
            rand(0, 255),
            rand(0, 255),
            rand(0, 255)
        );
        $img->drawPixel($x, $y, $color);
    }
}

// Save as JPEG
$jpegData = $img->toJpeg(90);
file_put_contents('test_original.jpg', (string) $jpegData);
$jpegSize = strlen($jpegData);

echo "Original JPEG size: " . number_format($jpegSize / 1024, 2) . " KB\n";

// Convert to WebP with quality 80
$webpData = $img->toWebp(80);
file_put_contents('test_compressed.webp', (string) $webpData);
$webpSize = strlen($webpData);

echo "WebP (quality 80) size: " . number_format($webpSize / 1024, 2) . " KB\n";

// Calculate savings
$savings = (($jpegSize - $webpSize) / $jpegSize) * 100;
echo "Size reduction: " . number_format($savings, 2) . "%\n";

// If original was 1.4MB, what would WebP be?
$originalMB = 1.4;
$estimatedWebpMB = $originalMB * ($webpSize / $jpegSize);
echo "\n✅ Estimate: A 1.4 MB JPEG would become approximately " . number_format($estimatedWebpMB, 2) . " MB as WebP\n";
echo "   That's a savings of " . number_format(1.4 - $estimatedWebpMB, 2) . " MB per image!\n";

// Try different quality settings
echo "\n--- Different Quality Settings for 1.4 MB JPEG ---\n";
foreach ([60, 70, 80, 90, 95] as $quality) {
    $webp = $img->toWebp($quality);
    $size = strlen($webp);
    $estimated = $originalMB * ($size / $jpegSize);
    $saved = $originalMB - $estimated;
    echo "Quality $quality: ~" . number_format($estimated, 2) . " MB (saves " . number_format($saved, 2) . " MB)\n";
}

// Clean up
unlink('test_original.jpg');
unlink('test_compressed.webp');

echo "\nTest complete!\n";
