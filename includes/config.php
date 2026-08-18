<?php
/**
 * Convertiplyhq - Global Configuration & Helper Functions
 * Lightweight, zero-dependency PHP 8+ engine
 */

if (!defined('CONVERTIPLY_INIT')) {
    define('DATA_PATH', __DIR__ . '/../data');
    define('CONVERTIPLY_INIT', true);

    require_once __DIR__ . '/quality-engine.php';
}

// Site Constants
define('SITE_NAME', 'Convertiplyhq');
define('SITE_TAGLINE', 'Data-Driven Digital Marketing & Growth Engineering');
define('SITE_PHONE', '+91 98765 43210');
define('SITE_EMAIL', 'growth@convertiplyhq.com');
define('SITE_ADDRESS', 'Level 4, Cyber Towers, HITEC City, Hyderabad, Telangana 500081');

// Determine Base URL dynamically with full HTTPS and Reverse Proxy support (Vercel, Cloudflare, Render)
function get_base_url(): string {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
        || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && str_contains(strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']), 'https'))
        || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')
        || (!empty($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'vercel.app'));

    $protocol = $isHttps ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8085';
    
    return rtrim($protocol . $host, '/');
}

function get_data(string $filename): array {
    static $cache = [];
    if (isset($cache[$filename])) {
        return $cache[$filename];
    }

    // 1. Check /tmp first for dynamic serverless runtime updates (e.g. Vercel)
    $tmpPath = sys_get_temp_dir() . '/' . $filename;
    if (file_exists($tmpPath)) {
        $json = @file_get_contents($tmpPath);
        if ($json !== false) {
            $decoded = json_decode($json, true);
            if (is_array($decoded)) {
                $cache[$filename] = $decoded;
                return $decoded;
            }
        }
    }

    // 2. Check bundled application data directory
    $path = __DIR__ . '/../data/' . $filename;
    if (file_exists($path)) {
        $json = file_get_contents($path);
        $decoded = json_decode($json, true);
        if (is_array($decoded)) {
            $cache[$filename] = $decoded;
            return $decoded;
        }
    }
    return [];
}

function get_service_categories(): array {
    $data = get_data('pages.json');
    return $data['categories'] ?? [
        'strategy' => 'Strategy & Enterprise Growth',
        'seo' => 'Search Engine Optimization (SEO)',
        'sem' => 'Paid Advertising & SEM',
        'ecommerce' => 'eCommerce & Shopify Marketing'
    ];
}

function get_all_services(): array {
    $data = get_data('pages.json');
    return $data['services'] ?? [];
}

function get_all_cities(): array {
    $data = get_data('pages.json');
    return $data['cities'] ?? [];
}

function get_service_by_slug(string $slug): ?array {
    $aliases = [
        'seo' => 'local-seo',
        'ppc' => 'google-ads-management',
        'google-ads' => 'google-ads-management',
        'google-ads-ppc' => 'google-ads-management',
        'sem' => 'search-engine-marketing-sem',
        'ecommerce' => 'ecommerce-seo',
        'shopify' => 'shopify-seo',
        'web-design' => 'ecommerce-web-design',
        'cro' => 'cro-audits'
    ];
    $resolvedSlug = $aliases[$slug] ?? $slug;

    $services = get_all_services();
    foreach ($services as $service) {
        if ($service['slug'] === $resolvedSlug) {
            return $service;
        }
    }
    return null;
}

function get_city_by_slug(string $slug): ?array {
    $cities = get_all_cities();
    foreach ($cities as $city) {
        if ($city['slug'] === $slug) {
            return $city;
        }
    }
    return null;
}

/**
 * Fetch all testimonials filtered by city and/or service
 */
function get_testimonials(?string $serviceSlug = null, ?string $citySlug = null, int $limit = 3): array {
    $all = get_data('testimonials.json');
    if (empty($all)) {
        return [];
    }

    $matched = [];
    // First priority: matching both service and city
    foreach ($all as $t) {
        if ($serviceSlug && $citySlug && ($t['service'] ?? '') === $serviceSlug && ($t['city'] ?? '') === $citySlug) {
            $matched[] = $t;
        }
    }

    // Second priority: matching either city or service
    if (count($matched) < $limit) {
        foreach ($all as $t) {
            if (!in_array($t, $matched, true)) {
                if (($citySlug && ($t['city'] ?? '') === $citySlug) || ($serviceSlug && ($t['service'] ?? '') === $serviceSlug)) {
                    $matched[] = $t;
                    if (count($matched) >= $limit) break;
                }
            }
        }
    }

    // Fallback: fill up to limit from global list
    if (count($matched) < $limit) {
        foreach ($all as $t) {
            if (!in_array($t, $matched, true)) {
                $matched[] = $t;
                if (count($matched) >= $limit) break;
            }
        }
    }

    return array_slice($matched, 0, $limit);
}

/**
 * Fetch FAQs customized for specific service and city
 */
function get_custom_faqs(string $serviceSlug, string $citySlug): array {
    $faqData = get_data('faqs.json');
    $service = get_service_by_slug($serviceSlug);
    $city = get_city_by_slug($citySlug);

    $serviceName = $service['shortName'] ?? $service['name'] ?? 'Digital Marketing';
    $cityName = $city['name'] ?? 'Your City';
    $primaryDistrict = (!empty($city['keyDistricts'])) ? $city['keyDistricts'][0] : $cityName;

    $results = [];
    $serviceList = $faqData['serviceFaqs'][$serviceSlug] ?? ($faqData['serviceFaqs']['seo'] ?? []);

    foreach ($serviceList as $item) {
        $q = str_replace(['{Service}', '{City}', '{District}'], [$serviceName, $cityName, $primaryDistrict], $item['q']);
        $a = str_replace(['{Service}', '{City}', '{District}'], [$serviceName, $cityName, $primaryDistrict], $item['a']);
        $results[] = ['q' => $q, 'a' => $a];
    }

    // Append 1-2 general agency FAQs
    if (!empty($faqData['generalFaqs'])) {
        foreach (array_slice($faqData['generalFaqs'], 0, 2) as $item) {
            $results[] = [
                'q' => str_replace(['{Service}', '{City}'], [$serviceName, $cityName], $item['q']),
                'a' => str_replace(['{Service}', '{City}'], [$serviceName, $cityName], $item['a']),
            ];
        }
    }

    return $results;
}

/**
 * URL Generator helpers for clean internal linking
 */
function site_url(string $path = ''): string {
    $base = get_base_url();
    $path = ltrim($path, '/');
    return $path ? "$base/$path" : $base;
}

function service_url(string $serviceSlug): string {
    return site_url("services/{$serviceSlug}");
}

function service_city_url(string $serviceSlug, string $citySlug): string {
    return site_url("services/{$serviceSlug}-in-{$citySlug}");
}

function service_hub_url(string $serviceSlug = ''): string {
    return $serviceSlug ? site_url("services#{$serviceSlug}") : site_url("services");
}

function blog_url(string $slug = ''): string {
    return $slug ? site_url("blog/{$slug}") : site_url("blog");
}

function get_service_definition(string $serviceSlug): array {
    $defs = get_data('service-definitions.json');
    if (isset($defs[$serviceSlug])) {
        return $defs[$serviceSlug];
    }
    if (str_contains($serviceSlug, 'ecommerce') || str_contains($serviceSlug, 'shopify') || str_contains($serviceSlug, 'web-design')) {
        return $defs['ecommerce'] ?? ($defs['seo'] ?? []);
    }
    if (str_contains($serviceSlug, 'ppc') || str_contains($serviceSlug, 'ads') || str_contains($serviceSlug, 'sem')) {
        return $defs['google-ads-ppc'] ?? ($defs['seo'] ?? []);
    }
    return $defs['seo'] ?? [];
}

/**
 * Get structured programmatic data for a given service and city
 */
function get_programmatic_page(string $serviceSlug, string $citySlug): ?array {
    $service = get_service_by_slug($serviceSlug);
    $city = get_city_by_slug($citySlug);

    if (!$service || !$city) {
        return null;
    }

    $serviceName = $service['shortName'] ?? $service['name'];
    $cityName = $city['name'];
    $slug = "{$service['slug']}-in-{$city['slug']}";

    // Industry focus list
    $industryFocus = $city['keyIndustries'] ?? ["B2B SaaS & Tech", "Manufacturing & B2B", "Healthcare & Pharma", "Real Estate", "eCommerce & Retail"];

    // Intro stat
    $introStat = "{$cityName} has over " . ($city['activeSMEs'] ?? '10,000+') . " active businesses competing for commercial visibility across {$city['hub']}.";

    // Price range
    $avgPriceRange = $city['avgLocalCostINR'] ?? "₹30,000–₹95,000/month";

    // Case studies
    $caseStudies = [];
    if (!empty($city['caseStudy'])) {
        $cs = $city['caseStudy'];
        $caseStudies[] = [
            'client' => $cs['client'] ?? "{$cityName} Enterprise Client",
            'industry' => $cs['industry'] ?? 'High-Growth Business',
            'district' => $cs['district'] ?? $city['hub'],
            'metric_label' => 'Verified Pipeline Growth',
            'metric_value' => $cs['metric'] ?? '+320%',
            'quote' => $cs['summary'] ?? "Generated remarkable qualified inbound pipeline through technical growth execution."
        ];
    }

    // Deliverables
    $deliverables = [];
    if (!empty($service['deliverables'])) {
        foreach ($service['deliverables'] as $del) {
            $deliverables[] = [
                'title' => $del['title'],
                'description' => $del['desc']
            ];
        }
    }

    // FAQs (8-12 customized Q&As)
    $serviceDef = get_service_definition($service['slug']);
    $faqBank = $serviceDef['faq_bank'] ?? [];
    $faqs = [];

    foreach ($faqBank as $item) {
        $q = str_replace(['{service}', '{Service}', '{city}', '{City}'], [$serviceName, $serviceName, $cityName, $cityName], $item['question']);
        $a = str_replace(['{service}', '{Service}', '{city}', '{City}'], [$serviceName, $serviceName, $cityName, $cityName], $item['answer']);
        $faqs[] = ['question' => $q, 'answer' => $a];
    }

    // Append custom localized FAQs if available
    $customFaqs = get_custom_faqs($service['slug'], $city['slug']);
    foreach ($customFaqs as $cf) {
        if (count($faqs) >= 10) break;
        $faqs[] = ['question' => $cf['q'], 'answer' => $cf['a']];
    }

    // Related slugs (All sister cities for this service + related category services in this city)
    $relatedSlugs = [];
    $allCities = get_all_cities();
    foreach ($allCities as $oc) {
        if ($oc['slug'] !== $city['slug']) {
            $relatedSlugs[] = "{$service['slug']}-in-{$oc['slug']}";
        }
    }
    $allServices = get_all_services();
    foreach ($allServices as $os) {
        if ($os['slug'] !== $service['slug']) {
            $relatedSlugs[] = "{$os['slug']}-in-{$city['slug']}";
            if (count($relatedSlugs) >= 10) break;
        }
    }

    return [
        'slug' => $slug,
        'service' => $serviceName,
        'service_full_name' => $service['name'],
        'service_slug' => $service['slug'],
        'service_category' => $service['category'] ?? 'Digital Marketing',
        'city' => $cityName,
        'city_slug' => $city['slug'],
        'state' => $city['state'] ?? 'India',
        'industry_focus' => $industryFocus,
        'intro_stat' => $introStat,
        'avg_price_range' => $avgPriceRange,
        'case_studies' => $caseStudies,
        'deliverables' => $deliverables,
        'pricing_tiers' => $service['pricingTiers'] ?? [],
        'faqs' => $faqs,
        'related_slugs' => $relatedSlugs,
        'service_data' => $service,
        'city_data' => $city,
        'service_def' => $serviceDef
    ];
}

function e(mixed $string): string {
    return htmlspecialchars((string)($string ?? ''), ENT_QUOTES, 'UTF-8');
}
