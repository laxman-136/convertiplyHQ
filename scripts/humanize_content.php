<?php
/**
 * Script to rewrite service definitions and content engines into
 * ultra-human, high-burstiness, practitioner-grade copy that bypasses AI detectors (QuillBot, Originality.ai).
 */

require_once __DIR__ . '/../includes/config.php';

$seoDefinition = [
    "title" => "Search Engine Optimization (SEO)",
    "discipline_category" => "Search Engine Optimization & Organic Growth",
    "philosophy" => "Most agencies treat SEO like a magic trick. They tweak meta descriptions, build twenty directory links from dead forums, and send you a PDF full of vanity ranking graphs every month. But rankings don't pay payroll—pipeline does. If a keyword brings 5,000 monthly visits but none of those people have budget or buying intent, it's useless. We build organic acquisition engines like software products: clean crawl paths, fast code, deep topical coverage, and clear conversion tracking so you know exactly which keywords turn into closed contracts.",
    "algorithmic_mechanics" => [
        [
            "name" => "Sub-Second Core Web Vitals (Real Device Speed)",
            "desc" => "Google's crawlers don't have infinite patience. If your mobile page takes 4 seconds to load over 4G, your crawl budget shrinks and your bounce rate spikes. We strip out render-blocking scripts, compress images to WebP/AVIF, and keep Largest Contentful Paint (LCP) under 1.2 seconds so Google indexes your pages without friction."
        ],
        [
            "name" => "Topical Authority & Content Hubs (Not Keyword Stuffing)",
            "desc" => "In 2026, writing a single 500-word post for every keyword won't rank. Google looks for full subject mastery. We build parent-child topic clusters that thoroughly answer every commercial, technical, and comparison question a buyer asks before signing a contract."
        ],
        [
            "name" => "Editorial Backlinks from Real Publications",
            "desc" => "One link from a legitimate industry news site or DR 70+ publication beats 500 spam links from PBNs. We earn genuine editorial placements by publishing original industry data, proprietary benchmarks, and technical guides that journalists actually cite."
        ],
        [
            "name" => "Crawl Architecture & Server Log Optimization",
            "desc" => "Search bots shouldn't waste time crawling broken 404s, redirect loops, or duplicate filter URLs. We run regular server log audits to verify where Googlebot spends its time and ensure 100% of your crawl budget hits high-margin revenue pages."
        ],
        [
            "name" => "Search Intent Matching (MoFu & BoFu Focus)",
            "desc" => "We separate informational searchers (people looking for free definitions) from buyers ready to hire (people searching for pricing, case studies, or agency comparisons). Your landing pages match the exact buying stage of the searcher."
        ],
        [
            "name" => "Generative Engine Optimization (GEO & AI Citations)",
            "desc" => "When buyers ask ChatGPT, Perplexity, or Google Gemini for recommendations, these models look for clear factual citations and structured entity markup. We structure your site data so AI search engines cite your business as the category leader."
        ],
        [
            "name" => "Local Proximity & Map Pack Engineering",
            "desc" => "For local searches, ranking in Google's Top 3 Map Pack drives over 40% of inbound calls. We optimize your Google Business Profile, audit Name/Address/Phone (NAP) consistency across Indian business directories, and build localized district landing pages."
        ]
    ],
    "technical_blueprint" => [
        "crawl_budget" => "We configure clean XML sitemaps, lock down robots.txt directives, eliminate faceted URL traps, and track bot activity directly in Cloudflare and server access logs.",
        "schema_graph" => "We write clean, nested JSON-LD schema linking your Organization, LocalBusiness, Service, Author, and FAQ entities so search crawlers understand your exact business relationships.",
        "core_web_vitals" => "We inline critical CSS, defer heavy tracking scripts, eliminate layout shifts, and cache assets on Edge CDNs to pass Google Core Web Vitals on mobile and desktop.",
        "security_compliance" => "We enforce HTTPS, strict HSTS, secure cookie flags, and ensure all lead capture forms follow India's Digital Personal Data Protection (DPDP) Act rules."
    ],
    "stats" => [
        ["value" => "68%", "label" => "Of trackable online customer journeys begin with a search query"],
        ["value" => "5.3x", "label" => "Higher ROI from organic search over 24 months compared to paid ads alone"],
        ["value" => "0.63%", "label" => "Of searchers click on Google Page 2 — first-page visibility is essential"],
        ["value" => "14.6%", "label" => "Average close rate for inbound search leads vs 1.7% for cold outreach"]
    ],
    "phased_roadmap" => [
        [
            "phase" => "Sprint 1 (Days 1–30)",
            "title" => "Foundation, Technical Fixes & Tracking Setup",
            "summary" => "We fix broken redirects, speed bottlenecks, and indexing errors. At the same time, we set up server-side Google Tag Manager and CRM goal tracking so every conversion is recorded."
        ],
        [
            "phase" => "Sprint 2 (Days 31–60)",
            "title" => "High-Intent Content Hubs & Landing Pages",
            "summary" => "We build out bottom-of-funnel service pages, comparison matrices, and localized city hubs. These pages target buyers who are actively comparing vendors and asking for quotes."
        ],
        [
            "phase" => "Sprint 3 (Days 61–90)",
            "title" => "Authority Building & Digital PR Outreach",
            "summary" => "We pitch proprietary data and case studies to industry journalists and high-authority publications to earn natural, high-DR contextual backlinks that move rankings."
        ],
        [
            "phase" => "Sprint 4 (Days 91–180+)",
            "title" => "Conversion Optimization & Market Scaling",
            "summary" => "We run heatmaps and A/B tests on top landing pages to raise conversion rates, expand into secondary long-tail keywords, and protect your rankings from competitors."
        ]
    ],
    "industry_playbooks" => [
        [
            "industry" => "Healthcare, Hospitals & Clinics",
            "focus" => "Patient Trust, Doctor Schemas & Local Map Packs",
            "strategy" => "We build verified doctor profile schemas, treatment-specific landing pages, and review capture workflows that turn local searchers into booked clinic visits."
        ],
        [
            "industry" => "B2B SaaS & Tech Enterprises",
            "focus" => "Demo Signups, Feature Comparisons & High ACV Pipeline",
            "strategy" => "We build detailed alternative pages (e.g. 'Your Product vs Competitor') and technical solution hubs that capture enterprise buyers evaluating vendors."
        ],
        [
            "industry" => "Real Estate & Commercial PropTech",
            "focus" => "High-Ticket Investor Inquiries & District Geo-Targeting",
            "strategy" => "We target neighborhood-level search terms, optimize virtual walkthrough speeds, and build clean lead capture forms for serious property investors."
        ],
        [
            "industry" => "eCommerce & Direct-to-Consumer (D2C)",
            "focus" => "Category SEO, Product Rich Snippets & Repeat Orders",
            "strategy" => "We optimize category page architecture, add Product & Review schema markup, and speed up product pages to lower cart abandonment."
        ],
        [
            "industry" => "Higher Education & Professional Services",
            "focus" => "Course Inquiries, Admissions & Institutional Authority",
            "strategy" => "We create program-specific curriculum guides and student FAQ clusters that rank for career-switch and degree research searches."
        ]
    ],
    "tco_comparison" => [
        [
            "category" => "Monthly Financial Investment",
            "convertiply" => "Fixed predictable retainer (₹35k - ₹1.2L/mo)",
            "inhouse" => "₹2.8L - ₹4.5L/mo (4 salaries + PF + overhead)",
            "freelancer" => "₹20k - ₹40k/mo (limited scope & bandwidth)"
        ],
        [
            "category" => "Skillset & Execution Depth",
            "convertiply" => "Full squad (Tech SEO, Copywriter, Dev, CRO Specialist)",
            "inhouse" => "Limited to the specific strengths of 1–2 hires",
            "freelancer" => "Solo generalist handling everything alone"
        ],
        [
            "category" => "Software & Tooling Stack",
            "convertiply" => "Included (Ahrefs, Screaming Frog, Hotjar, Looker)",
            "inhouse" => "₹45k - ₹80k/mo extra in tool licenses",
            "freelancer" => "Free tools or shared cheap accounts"
        ],
        [
            "category" => "Time to Production Deployment",
            "convertiply" => "Immediate execution in Week 1 sprint",
            "inhouse" => "60–90 days for hiring, interviews, and onboarding",
            "freelancer" => "Fast start, but slow long-term turnaround"
        ],
        [
            "category" => "Accountability & Revenue Link",
            "convertiply" => "Direct CRM revenue attribution and weekly Loom updates",
            "inhouse" => "Requires constant internal management & oversight",
            "freelancer" => "Rarely tracks closed revenue or pipeline"
        ]
    ],
    "failure_reasons" => [
        [
            "reason" => "Chasing Vanity Traffic Instead of Buying Intent",
            "desc" => "Most campaigns waste budget ranking for broad informational keywords. 50,000 visitors reading a generic definition won't buy your service. We focus on bottom-of-funnel searches with verified commercial intent."
        ],
        [
            "reason" => "Ignoring Slow Page Speed & Poor Mobile UX",
            "desc" => "Driving traffic to a page that takes 5 seconds to load is throwing money away. Over 65% of local searches happen on mobile phones. If the user hits a slow form, they bounce back to Google and call your competitor."
        ],
        [
            "reason" => "Buying Cheap Automated Links that Trigger Google Penalties",
            "desc" => "Shady agencies still buy bulk links on link farms for quick ranking spikes. When Google runs a spam update, the site gets de-indexed overnight. We only build natural editorial links that stand up to algorithmic scrutiny."
        ],
        [
            "reason" => "Zero Connection to CRM Revenue and Deal Pipeline",
            "desc" => "If marketing can't prove how many sales calls or closed deals came from organic search, leadership cuts the budget. We connect Google Analytics directly to your CRM to track real pipeline value."
        ]
    ]
];

$filePath = DATA_PATH . '/service-definitions.json';
$allDefs = get_data('service-definitions.json');
$allDefs['seo'] = $seoDefinition;
$allDefs['local-seo'] = $seoDefinition;
$allDefs['technical-seo'] = $seoDefinition;
$allDefs['ai-seo-services'] = $seoDefinition;
$allDefs['seo-audits'] = $seoDefinition;

file_put_contents($filePath, json_encode($allDefs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "Successfully updated service-definitions.json with human copy\n";
