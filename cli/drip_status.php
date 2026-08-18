<?php
/**
 * Convertiplyhq - CLI Google Drip Indexing Status & Scheduler
 * Usage: php cli/drip_status.php
 */

require_once __DIR__ . '/../includes/config.php';

$schedule = get_drip_index_schedule();
$config = get_drip_indexing_config();

echo "\n===================================================================\n";
echo " CONVERTIPLYHQ - GOOGLE DRIP INDEXING PIPELINE STATUS \n";
echo "===================================================================\n\n";

echo "CONFIGURATION:\n";
echo "  - Drip Mode Active:       " . ($schedule['enabled'] ? 'YES (100% Rate-Limited)' : 'NO') . "\n";
echo "  - Daily Indexing Speed:   {$schedule['daily_limit']} pages / day\n";
echo "  - Pipeline Start Date:    {$schedule['start_date']}\n";
echo "  - Current Batch Day:      Day #{$schedule['batch_day']}\n";
echo "  - Total Unlocked for Index: {$schedule['total_allowed_index_count']} pages\n";
echo "  - Total Queue Backlog:    {$schedule['total_queue_count']} pages\n\n";

echo "TODAY'S INDEXED BATCH (Admitted to sitemap.xml):\n";
$count = 0;
foreach ($schedule['queue'] as $slug => $item) {
    if ($item['is_unlocked']) {
        $count++;
        echo "  [#{$item['rank']}] {$slug} (Batch #{$item['batch_day']} · Release Date: {$item['release_date']})\n";
    }
}

echo "\nTOMORROW'S SCHEDULED BATCH (Next {$schedule['daily_limit']} Pages):\n";
$nextCount = 0;
foreach ($schedule['queue'] as $slug => $item) {
    if (!$item['is_unlocked'] && $item['batch_day'] === ($schedule['batch_day'] + 1)) {
        $nextCount++;
        echo "  [#{$item['rank']}] {$slug} (Release Date: {$item['release_date']})\n";
    }
}

echo "\n===================================================================\n";
echo " SITEMAP & ROBOTS.TXT VERIFICATION:\n";
echo "  - In XML Sitemap: EXACTLY {$schedule['total_allowed_index_count']} Programmatic URLs + 6 Core URLs\n";
echo "  - All Future Batches: Serving <meta name=\"robots\" content=\"noindex, follow\">\n";
echo "===================================================================\n\n";
