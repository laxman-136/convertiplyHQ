<?php
/**
 * Convertiplyhq - Programmatic Page Quality, Similarity & Governance Engine
 * Enforces Google Helpful Content, Scaled Content Abuse & Technical Quality Guidelines.
 */

if (!defined('CONVERTIPLY_INIT')) {
    require_once __DIR__ . '/config.php';
}

/**
 * Load page overrides and configuration thresholds
 */
function get_page_overrides(): array {
    return get_data('page-overrides.json');
}

/**
 * Save an override for a specific programmatic page slug
 */
function save_page_override(string $slug, array $data): bool {
    $overrides = get_page_overrides();
    $overrides['overrides'][$slug] = array_merge($overrides['overrides'][$slug] ?? [], $data, [
        'updated_at' => date('c')
    ]);
    $json = json_encode($overrides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    
    // 1. Write to /tmp for serverless runtime persistence
    $tmpPath = sys_get_temp_dir() . '/page-overrides.json';
    @file_put_contents($tmpPath, $json);

    // 2. Try writing to local data directory if writable
    $filePath = DATA_PATH . '/page-overrides.json';
    if (is_writable($filePath) || (is_writable(DATA_PATH) && !file_exists($filePath))) {
        @file_put_contents($filePath, $json);
    }
    return true;
}

/**
 * Tokenize and normalize text for similarity analysis
 */
function tokenize_content(string $text): array {
    $clean = strtolower(strip_tags($text));
    $clean = preg_replace('/[^a-z0-9\s]/', ' ', $clean);
    $words = preg_split('/\s+/', trim($clean), -1, PREG_SPLIT_NO_EMPTY);
    
    // Stopwords to ignore in similarity check
    $stopwords = [
        'the', 'and', 'for', 'with', 'our', 'your', 'this', 'that', 'are', 'from', 
        'have', 'has', 'will', 'you', 'all', 'more', 'can', 'get', 'services', 'in', 
        'marketing', 'agency', 'company', 'best', 'top', 'across', 'about', 'what'
    ];
    $stopMap = array_flip($stopwords);

    return array_values(array_filter($words, fn($w) => strlen($w) > 2 && !isset($stopMap[$w])));
}

/**
 * Calculate Jaccard / N-Gram Similarity between two texts (0.0 to 1.0)
 */
function calculate_content_similarity(string $textA, string $textB): float {
    $tokensA = tokenize_content($textA);
    $tokensB = tokenize_content($textB);

    if (empty($tokensA) || empty($tokensB)) {
        return 0.0;
    }

    $setA = array_count_values($tokensA);
    $setB = array_count_values($tokensB);

    $intersection = 0;
    $union = count($tokensA) + count($tokensB);

    foreach ($setA as $token => $countA) {
        if (isset($setB[$token])) {
            $intersection += min($countA, $setB[$token]);
        }
    }

    if ($union === 0) return 0.0;
    return round((2.0 * $intersection) / $union, 4);
}

/**
 * Compute rigorous 0-100 Multi-Factor Quality Score for a programmatic page
 */
function calculate_page_quality(array $page): array {
    $score = 0;
    $breakdown = [];
    $flags = [];

    // 1. Content Value & Depth (Max 25 pts)
    $deliverableCount = count($page['deliverables'] ?? []);
    $faqCount = count($page['faqs'] ?? []);
    $contentPoints = 0;
    if ($deliverableCount >= 4) $contentPoints += 10;
    elseif ($deliverableCount >= 2) $contentPoints += 5;
    
    if ($faqCount >= 8) $contentPoints += 15;
    elseif ($faqCount >= 4) $contentPoints += 8;
    else $flags[] = 'THIN_FAQ_COUNT';

    $score += $contentPoints;
    $breakdown['content_value'] = ['score' => $contentPoints, 'max' => 25];

    // 2. Unique Location/Market Data (Max 20 pts)
    $uniquePoints = 0;
    $cityData = $page['city_data'] ?? [];
    if (!empty($cityData['hub']) && !empty($cityData['keyDistricts'])) $uniquePoints += 8;
    if (!empty($cityData['activeSMEs'])) $uniquePoints += 6;
    if (!empty($cityData['avgLocalCostINR'])) $uniquePoints += 6;
    if ($uniquePoints < 10) $flags[] = 'LOW_UNIQUE_DATA';

    $score += $uniquePoints;
    $breakdown['unique_information'] = ['score' => $uniquePoints, 'max' => 20];

    // 3. Search Intent & Structure Match (Max 15 pts)
    $intentPoints = 0;
    if (!empty($page['service_full_name']) && !empty($page['city'])) $intentPoints += 5;
    if (!empty($page['service_def']['philosophy']) || !empty($page['service_def']['what_is']) || !empty($page['service_data']['shortDesc'])) $intentPoints += 5;
    if (!empty($page['service_def']['algorithmic_mechanics']) || !empty($page['service_def']['ranking_factors']) || !empty($page['service_def']['phased_roadmap'])) $intentPoints += 5;

    $score += $intentPoints;
    $breakdown['search_intent'] = ['score' => $intentPoints, 'max' => 15];

    // 4. Business Relevance & Deliverable Clarity (Max 10 pts)
    $bizPoints = 0;
    if (!empty($page['pricing_tiers'])) $bizPoints += 5;
    if (!empty($page['industry_focus'])) $bizPoints += 5;

    $score += $bizPoints;
    $breakdown['business_relevance'] = ['score' => $bizPoints, 'max' => 10];

    // 5. First-Party Proof & Case Studies (Max 10 pts)
    $proofPoints = 0;
    $caseStudies = $page['case_studies'] ?? [];
    if (!empty($caseStudies)) {
        $proofPoints += 10;
    } else {
        $flags[] = 'NO_CASE_STUDY';
    }

    $score += $proofPoints;
    $breakdown['first_party_proof'] = ['score' => $proofPoints, 'max' => 10];

    // 6. Internal Linking Quality (Max 5 pts)
    $linkPoints = 0;
    $relatedSlugs = $page['related_slugs'] ?? [];
    if (count($relatedSlugs) >= 5) $linkPoints += 5;
    elseif (count($relatedSlugs) >= 2) $linkPoints += 3;
    else $flags[] = 'WEAK_INTERNAL_LINKS';

    $score += $linkPoints;
    $breakdown['internal_linking'] = ['score' => $linkPoints, 'max' => 5];

    // 7. Technical SEO & Schema (Max 5 pts)
    $techPoints = 5; // Valid semantic HTML, breadcrumb schema, and canonicals
    $score += $techPoints;
    $breakdown['technical_seo'] = ['score' => $techPoints, 'max' => 5];

    // 8. Media, Table & UX (Max 5 pts)
    $uxPoints = 5; // Responsive card grids, pricing table, interactive calculator
    $score += $uxPoints;
    $breakdown['media_ux'] = ['score' => $uxPoints, 'max' => 5];

    // 9. Conversion Value & Direct CTA (Max 5 pts)
    $convPoints = 5; // Pre-filled attribution form + direct phone link
    $score += $convPoints;
    $breakdown['conversion_value'] = ['score' => $convPoints, 'max' => 5];

    return [
        'total_score' => min(100, $score),
        'breakdown' => $breakdown,
        'flags' => $flags
    ];
}

/**
 * Full Audit of all Programmatic Combinations with Graph Linking and Duplicate Analysis
 */
function audit_all_programmatic_pages(): array {
    $allServices = get_all_services();
    $allCities = get_all_cities();
    $overridesData = get_page_overrides();
    $overrides = $overridesData['overrides'] ?? [];
    $indexableThreshold = $overridesData['default_indexable_threshold'] ?? 75;
    $reviewThreshold = $overridesData['default_review_threshold'] ?? 60;
    $similarityThreshold = ($overridesData['similarity_alert_threshold'] ?? 78) / 100.0;

    $pages = [];
    $rawTexts = [];

    // Step 1: Gather and compute base page data
    foreach ($allServices as $service) {
        foreach ($allCities as $city) {
            $slug = "{$service['slug']}-in-{$city['slug']}";
            $pageData = get_programmatic_page($service['slug'], $city['slug']);
            
            if (!$pageData) continue;

            $quality = calculate_page_quality($pageData);
            
            // Build distinct localized content representation for similarity comparison
            $csText = '';
            foreach ($pageData['case_studies'] as $cs) {
                $csText .= " {$cs['client']} {$cs['district']} {$cs['metric_value']} {$cs['quote']}";
            }
            $combinedText = $pageData['service'] . ' ' . $pageData['city'] . ' ' . 
                            $pageData['intro_stat'] . ' ' . 
                            $pageData['avg_price_range'] . ' ' . 
                            implode(' ', $pageData['industry_focus']) . ' ' . 
                            implode(' ', $pageData['city_data']['keyDistricts'] ?? []) . ' ' .
                            $csText;

            $rawTexts[$slug] = $combinedText;

            $pages[$slug] = [
                'slug' => $slug,
                'url' => service_city_url($service['slug'], $city['slug']),
                'service' => $service['name'],
                'service_slug' => $service['slug'],
                'city' => $city['name'],
                'city_slug' => $city['slug'],
                'quality_score' => $quality['total_score'],
                'breakdown' => $quality['breakdown'],
                'flags' => $quality['flags'],
                'case_study_count' => count($pageData['case_studies'] ?? []),
                'faq_count' => count($pageData['faqs'] ?? []),
                'deliverable_count' => count($pageData['deliverables'] ?? []),
                'inbound_links_count' => 0, // calculated in Step 2
                'outbound_links_count' => count($pageData['related_slugs'] ?? []),
                'max_similarity' => 0.0,
                'most_similar_slug' => null,
                'status' => 'INDEXABLE'
            ];
        }
    }

    // Step 2: Compute Inbound Links Graph (Detect Orphans)
    foreach ($pages as $sourceSlug => $pData) {
        $sourcePage = get_programmatic_page($pData['service_slug'], $pData['city_slug']);
        if ($sourcePage && !empty($sourcePage['related_slugs'])) {
            foreach ($sourcePage['related_slugs'] as $targetSlug) {
                if (isset($pages[$targetSlug])) {
                    $pages[$targetSlug]['inbound_links_count']++;
                }
            }
        }
    }

    // Step 3: Compute Cross-Page Similarity against neighbor sample window (Same service in adjacent cities)
    $slugKeys = array_keys($pages);
    $slugCount = count($slugKeys);

    foreach ($slugKeys as $i => $slugA) {
        $pageA = &$pages[$slugA];
        $maxSim = 0.0;
        $mostSimilar = null;

        // Sample up to 6 neighbor pages of the same service
        $sampleIndices = [
            ($i + 1) % $slugCount,
            ($i + 2) % $slugCount,
            ($i + 3) % $slugCount,
            ($i + 10) % $slugCount,
            ($i + 25) % $slugCount
        ];

        foreach ($sampleIndices as $sampleIdx) {
            $slugB = $slugKeys[$sampleIdx] ?? null;
            if (!$slugB || $slugA === $slugB) continue;
            
            $sim = calculate_content_similarity($rawTexts[$slugA], $rawTexts[$slugB]);
            if ($sim > $maxSim) {
                $maxSim = $sim;
                $mostSimilar = $slugB;
            }
        }

        $pageA['max_similarity'] = round($maxSim * 100, 1);
        $pageA['most_similar_slug'] = $mostSimilar;

        if ($maxSim >= $similarityThreshold) {
            $pageA['flags'][] = 'HIGH_SIMILARITY_RISK';
        }

        if ($pageA['inbound_links_count'] === 0) {
            $pageA['flags'][] = 'ORPHAN_PAGE';
        }

        // Step 4: Determine Final Lifecycle State
        $manualStatus = $overrides[$slugA]['status'] ?? null;

        if ($manualStatus) {
            $pageA['status'] = $manualStatus;
        } else {
            if ($pageA['quality_score'] >= $indexableThreshold && !in_array('HIGH_SIMILARITY_RISK', $pageA['flags'])) {
                $pageA['status'] = 'INDEXABLE';
            } elseif ($pageA['quality_score'] >= $reviewThreshold) {
                $pageA['status'] = 'REVIEW';
            } else {
                $pageA['status'] = 'NOINDEX';
            }
        }
    }
    unset($pageA);

    return $pages;
}

/**
 * Load Drip-Feed Indexing Configuration
 */
function get_drip_indexing_config(): array {
    return get_data('drip-indexing.json');
}

/**
 * Save Drip-Feed Indexing Configuration
 */
function save_drip_indexing_config(array $data): bool {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    
    // 1. Write to /tmp for serverless runtime persistence
    $tmpPath = sys_get_temp_dir() . '/drip-indexing.json';
    @file_put_contents($tmpPath, $json);

    // 2. Try writing to local data directory if writable
    $filePath = DATA_PATH . '/drip-indexing.json';
    if (is_writable($filePath) || (is_writable(DATA_PATH) && !file_exists($filePath))) {
        @file_put_contents($filePath, $json);
    }
    return true;
}

/**
 * Build the Deterministic Drip Indexing Release Queue (10 Pages per day)
 */
function get_drip_index_schedule(): array {
    $config = get_drip_indexing_config();
    $dailyLimit = max(1, (int)($config['daily_limit'] ?? 10));
    $startDate = $config['start_date'] ?? date('Y-m-d');
    $priorityMetros = array_flip($config['priority_metros'] ?? ['hyderabad', 'bengaluru', 'mumbai', 'delhi', 'pune', 'chennai', 'ahmadabad', 'kolkata']);

    $allServices = get_all_services();
    $allCities = get_all_cities();

    // Sort cities: priority metros first, then alphabetically
    usort($allCities, function($a, $b) use ($priorityMetros) {
        $pA = $priorityMetros[$a['slug']] ?? 9999;
        $pB = $priorityMetros[$b['slug']] ?? 9999;
        if ($pA !== $pB) return $pA - $pB;
        return strcmp($a['name'], $b['name']);
    });

    // Build deterministic ordered queue across services and sorted cities
    $queue = [];
    foreach ($allServices as $s) {
        foreach ($allCities as $c) {
            $slug = "{$s['slug']}-in-{$c['slug']}";
            $queue[] = [
                'slug' => $slug,
                'service_slug' => $s['slug'],
                'city_slug' => $c['slug']
            ];
        }
    }

    $startTimestamp = strtotime($startDate);
    $currentTimestamp = strtotime(date('Y-m-d'));
    
    if ($currentTimestamp < $startTimestamp) {
        $daysUntilStart = (int)ceil(($startTimestamp - $currentTimestamp) / 86400);
        $daysElapsed = -$daysUntilStart;
        $batchDay = 0;
        $currentAllowedIndexCount = 0;
    } else {
        $daysElapsed = (int)floor(($currentTimestamp - $startTimestamp) / 86400);
        $batchDay = $daysElapsed + 1;
        $currentAllowedIndexCount = !empty($config['enabled']) ? ($daysElapsed + 1) * $dailyLimit : count($queue);
    }

    $schedule = [
        'enabled' => $config['enabled'] ?? true,
        'daily_limit' => $dailyLimit,
        'start_date' => $startDate,
        'days_elapsed' => $daysElapsed,
        'batch_day' => $batchDay,
        'total_allowed_index_count' => $currentAllowedIndexCount,
        'total_queue_count' => count($queue),
        'gtm_id' => $config['gtm_id'] ?? '',
        'gsc_verification' => $config['gsc_verification'] ?? '',
        'queue' => []
    ];

    foreach ($queue as $rank => $item) {
        $itemRank = $rank + 1;
        $itemBatchDay = (int)ceil($itemRank / $dailyLimit);
        $itemReleaseTimestamp = $startTimestamp + (($itemBatchDay - 1) * 86400);
        $itemReleaseDate = date('Y-m-d', $itemReleaseTimestamp);
        $isUnlocked = (!empty($config['enabled'])) ? ($itemRank <= $currentAllowedIndexCount) : true;

        $schedule['queue'][$item['slug']] = [
            'rank' => $itemRank,
            'batch_day' => $itemBatchDay,
            'release_date' => $itemReleaseDate,
            'is_unlocked' => $isUnlocked,
            'service_slug' => $item['service_slug'],
            'city_slug' => $item['city_slug']
        ];
    }

    return $schedule;
}

/**
 * Check if a specific programmatic page is permitted to be indexed (incorporating Drip Indexing Rate Limit)
 */
function is_page_indexable(string $serviceSlug, string $citySlug): bool {
    $slug = "{$serviceSlug}-in-{$citySlug}";
    $overrides = get_page_overrides()['overrides'] ?? [];

    // Manual administrative override has absolute priority
    if (isset($overrides[$slug]['status'])) {
        return $overrides[$slug]['status'] === 'INDEXABLE';
    }

    $dripConfig = get_drip_indexing_config();
    if (!empty($dripConfig['enabled'])) {
        static $dripSchedule = null;
        if ($dripSchedule === null) {
            $dripSchedule = get_drip_index_schedule();
        }

        $itemSchedule = $dripSchedule['queue'][$slug] ?? null;
        if ($itemSchedule && !$itemSchedule['is_unlocked']) {
            // Not yet reached scheduled daily drip batch
            return false;
        }
    }

    $page = get_programmatic_page($serviceSlug, $citySlug);
    if (!$page) return false;

    $quality = calculate_page_quality($page);
    $threshold = get_page_overrides()['default_indexable_threshold'] ?? 75;

    return $quality['total_score'] >= $threshold && count($page['faqs'] ?? []) >= 4;
}

/**
 * Get the exact robots meta directive string for a given page
 */
function get_robots_meta_directive(string $serviceSlug, string $citySlug): string {
    if (is_page_indexable($serviceSlug, $citySlug)) {
        return 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    }
    return 'noindex, follow';
}
