<?php
require_once __DIR__ . '/../includes/config.php';

$html = file_get_contents('http://127.0.0.1:8085/services/seo-in-hyderabad');
file_put_contents(__DIR__ . '/../scratch_rendered.html', $html);

// Remove scripts and styles
$clean = preg_replace('/<(script|style)\b[^>]*>(.*?)<\/\1>/is', '', $html);
$text = strip_tags($clean);
$text = html_entity_decode($text);
file_put_contents(__DIR__ . '/../scratch_rendered.txt', $text);

$words = str_word_count($text);
echo "HTML length: " . strlen($html) . " bytes\n";
echo "Text length: " . strlen($text) . " characters\n";
echo "Total words: " . $words . "\n";
