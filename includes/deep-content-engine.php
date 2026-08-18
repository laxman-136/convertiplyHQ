<?php
/**
 * Convertiplyhq - Deep Content & Technical Specification Engine
 * Generates exhaustive, textbook-grade technical modules, keyword matrices,
 * milestone scorecards, and mathematical ROI models to guarantee 5,000+ words per page.
 */

if (!defined('CONVERTIPLY_INIT')) {
    require_once __DIR__ . '/config.php';
}

function get_district_profiles(array $districts, string $cityName): array {
    $archetypes = [
        [
            'tag' => 'Tech & Enterprise GCC Hub',
            'tag_color' => '#194cff',
            'bg_color' => 'rgba(25, 76, 255, 0.08)',
            'focus' => 'Enterprise SEO & B2B Pipeline',
            'summary' => "Primary technology corridor with high concentration of IT leaders, Global Capability Centers (GCCs), and venture-backed SaaS startups.",
            'demographics' => "Enterprise buyers, software founders, and technical procurement teams.",
            'tactics' => "Account-Based Marketing (ABM), competitor alternative keyword targeting, and bottom-of-funnel demo funnels."
        ],
        [
            'tag' => 'Commercial & Financial Hub',
            'tag_color' => '#059669',
            'bg_color' => 'rgba(5, 150, 105, 0.08)',
            'focus' => 'High-Intent Search Ads & Lead Gen',
            'summary' => "Dense corporate corridor housing financial institutions, legal/consulting firms, and commercial real estate developers.",
            'demographics' => "Managing directors, corporate finance heads, and commercial property investors.",
            'tactics' => "High-intent Google Search STAGs, LinkedIn executive retargeting, and instant quote capture flows."
        ],
        [
            'tag' => 'Retail & Healthcare Zone',
            'tag_color' => '#d97706',
            'bg_color' => 'rgba(217, 119, 6, 0.08)',
            'focus' => 'Google Map Pack & Proximity SEO',
            'summary' => "Affluent consumer corridor with multi-specialty hospitals, luxury showrooms, and high-density residential developments.",
            'demographics' => "High-net-worth consumers, patients seeking specialized care, and luxury buyers.",
            'tactics' => "Google Business Profile proximity tuning, local review capture loops, and click-to-call mobile ads."
        ],
        [
            'tag' => 'Industrial & Logistics Corridor',
            'tag_color' => '#7c3aed',
            'bg_color' => 'rgba(124, 58, 237, 0.08)',
            'focus' => 'B2B RFQ Funnels & Catalog SEO',
            'summary' => "Fast-expanding manufacturing and logistics hub connecting regional trade networks and industrial parks.",
            'demographics' => "Industrial plant managers, supply chain directors, and wholesale distributors.",
            'tactics' => "Technical product spec sheets, industrial catalog schema, and wholesale RFQ generation forms."
        ]
    ];

    $profiles = [];
    foreach ($districts as $i => $dist) {
        $arc = $archetypes[$i % count($archetypes)];
        $profiles[] = [
            'name' => $dist,
            'tag' => $arc['tag'],
            'tag_color' => $arc['tag_color'],
            'bg_color' => $arc['bg_color'],
            'focus' => $arc['focus'],
            'summary' => $arc['summary'],
            'demographics' => $arc['demographics'],
            'tactics' => $arc['tactics']
        ];
    }
    return $profiles;
}

function get_deep_content_modules(string $serviceSlug, string $citySlug, string $serviceName, string $cityName, string $stateName): array {
    return [
        'keyword_matrix' => [
            [
                'cluster' => 'Commercial Investigation Keywords',
                'intent' => 'High Commercial Intent',
                'queries' => [
                    "best {$serviceName} agency in {$cityName}",
                    "top {$serviceName} companies {$cityName}",
                    "hire {$serviceName} consultant {$cityName}",
                    "{$serviceName} services for enterprise {$cityName}"
                ],
                'funnel_stage' => 'Middle of Funnel (MoFu)',
                'conversion_rate' => '8.5% – 14.2%'
            ],
            [
                'cluster' => 'Direct Transactional & Quote Keywords',
                'intent' => 'Urgent Purchase / RFP Intent',
                'queries' => [
                    "{$serviceName} pricing {$cityName}",
                    "cost of {$serviceName} in {$cityName}",
                    "{$serviceName} retainer packages {$cityName}",
                    "request proposal for {$serviceName} {$cityName}"
                ],
                'funnel_stage' => 'Bottom of Funnel (BoFu)',
                'conversion_rate' => '16.8% – 28.5%'
            ],
            [
                'cluster' => 'Micro-District & Proximity Keywords',
                'intent' => 'Hyper-Local Map Pack Intent',
                'queries' => [
                    "{$serviceName} near me {$cityName}",
                    "{$serviceName} firm in central {$cityName}",
                    "local {$serviceName} experts {$cityName} {$stateName}"
                ],
                'funnel_stage' => 'Local Proximity Search',
                'conversion_rate' => '22.0% – 34.0%'
            ],
            [
                'cluster' => 'Competitor & Alternative Comparison Queries',
                'intent' => 'High-Value Decision Making',
                'queries' => [
                    "top rated {$serviceName} partners {$cityName}",
                    "performance marketing vs traditional agency {$cityName}",
                    "enterprise {$serviceName} case studies {$cityName}"
                ],
                'funnel_stage' => 'Evaluation & Shortlist',
                'conversion_rate' => '12.0% – 19.5%'
            ]
        ],
        'scorecard_milestones' => [
            [
                'timeline' => 'Sprint 1 (Days 1–14)',
                'title' => 'Telemetry Calibration & Forensic Speed Tuning',
                'deliverables' => 'Server log hygiene audit, GA4 server-side container deployment, conversion value hashing, and critical CSS rendering optimizations for Core Web Vitals compliance.'
            ],
            [
                'timeline' => 'Sprint 2 (Days 15–30)',
                'title' => 'Topical Cluster Blueprints & Landing Page Alpha',
                'deliverables' => 'Publishing high-converting bottom-of-funnel service pages, structured JSON-LD schema graphs, single-theme ad groups, and localized district hub architectures.'
            ],
            [
                'timeline' => 'Sprint 3 (Days 31–60)',
                'title' => 'Authority Link Acquisition & Negative Pruning',
                'deliverables' => 'Editorial backlink outreach across Tier-1 publications, unlinked citation reclamation, aggressive search terms negative pruning, and smart bidding algorithmic training.'
            ],
            [
                'timeline' => 'Sprint 4 (Days 61–90)',
                'title' => 'Multivariate CRO & Multi-Touch Attribution Review',
                'deliverables' => 'Heatmap session friction elimination, multi-touch CRM revenue modeling, expanded long-tail keyword indexing, and quarterly executive scaling roadmaps.'
            ]
        ],
        'kpi_glossary' => [
            [
                'term' => 'Customer Acquisition Cost (CAC)',
                'definition' => 'The complete, fully loaded financial investment (ad spend + agency retainers) required to acquire one paying customer in your target market.'
            ],
            [
                'term' => 'Cost Per Sales-Qualified Lead (CP-SQL)',
                'definition' => 'The average marketing expense incurred to produce an inbound inquiry that meets full budget, authority, need, and timeline (BANT) criteria.'
            ],
            [
                'term' => 'Largest Contentful Paint (LCP)',
                'definition' => 'A primary Core Web Vital measuring how quickly the main visible content loads for users, with Google requiring sub-1.2s speeds for optimal search indexing.'
            ],
            [
                'term' => 'Quality Score (QS) & Ad Rank',
                'definition' => 'Google\'s 1-to-10 diagnostic rating of keyword relevance, ad copy click-through rate, and landing page experience that directly lowers your real cost-per-click.'
            ],
            [
                'term' => 'Blended Return on Ad Spend (ROAS)',
                'definition' => 'The ratio of total closed-won revenue generated across both organic search and paid channels divided by total marketing expenditure.'
            ],
            [
                'term' => 'Generative Engine Optimization (GEO)',
                'definition' => 'The engineering discipline of structuring entity data and factual citations so AI search assistants (ChatGPT, Google Gemini, Perplexity) cite your company as the authoritative answer.'
            ]
        ],
        'lead_scoring_framework' => [
            [
                'pillar' => 'Firmographic & Demographic Qualification',
                'criteria' => 'Verified corporate email domains (@company.com), employee headcount (> 25), and operating within high-margin target industries.',
                'impact' => 'Filters out unqualified personal queries and routes enterprise leads immediately to senior solution architects.'
            ],
            [
                'pillar' => 'Behavioral Intent & Telemetry Signals',
                'criteria' => 'Multiple visits to pricing or service deliverable pages, whitepaper/calculator interactions, and session dwell times exceeding 3 minutes.',
                'impact' => 'Triggers priority sales alerts and accelerates outbound sales outreach within 15 minutes of high-intent engagement.'
            ],
            [
                'pillar' => 'Negative Intent Filtering & Hygiene',
                'criteria' => 'Detecting generic student/freelance queries, job seeker intent, and invalid phone numbers to keep CRM pipelines clean.',
                'impact' => 'Prevents sales team fatigue and preserves 100% of executive bandwidth for high-probability commercial opportunities.'
            ],
            [
                'pillar' => 'Automated Meeting Booking & Routing SLAs',
                'criteria' => 'Embedding instant 1-click calendar scheduling directly on the post-submission confirmation screen.',
                'impact' => 'Increases demo completion rates by up to 34% by eliminating back-and-forth email scheduling delays.'
            ]
        ],
        'channel_flywheel' => [
            [
                'channel' => 'High-Intent Organic Search (Topical Authority)',
                'role' => 'Attracts ready-to-buy prospects during commercial discovery and establishes compounding organic pipeline with zero ongoing per-click fees.'
            ],
            [
                'channel' => 'Precision Paid Search & Competitor Bidding',
                'role' => 'Captures urgent, high-converting commercial searches and intercepts prospects actively evaluating competitor solutions.'
            ],
            [
                'channel' => 'Multi-Channel Video & Retargeting Loops',
                'role' => 'Re-engages high-intent website visitors across YouTube, LinkedIn, and Display networks to accelerate multi-touch sales cycles.'
            ],
            [
                'channel' => 'First-Party CRM Lifecycle Automation',
                'role' => 'Nurtures inbound prospects through automated case study drips, product calculators, and VIP executive outreach sequences.'
            ]
        ],
        'compliance_manifesto' => [
            [
                'standard' => '100% Google Search Essentials Compliance',
                'description' => 'Zero reliance on private blog networks (PBNs), automated link wheels, or spun doorway content. All growth is engineered through genuine topical depth and editorial value.'
            ],
            [
                'standard' => 'DPDP Act & Digital Privacy Architecture',
                'description' => 'All tracking containers, cookies, and lead capture funnels strictly comply with India’s Digital Personal Data Protection (DPDP) Act and global GDPR standards.'
            ],
            [
                'standard' => 'Transparent Single-Ledger Billing',
                'description' => 'You pay Google and Meta ad platforms directly with zero hidden markups. Our agency management fee is completely decoupled and transparent.'
            ],
            [
                'standard' => 'Complete First-Party Asset Ownership',
                'description' => 'All landing page code, design assets, conversion tracking scripts, and analytics properties remain 100% your permanent intellectual property.'
            ]
        ],
        'cro_psychology_principles' => [
            [
                'name' => 'Frictionless Single-Step Cognitive Load',
                'desc' => 'Every extra form field reduces landing page conversion rates by up to 11%. We streamline inquiry capture to essential qualifiers (Website, Email, Business Hub) while capturing rich technical telemetry asynchronously.'
            ],
            [
                'name' => 'Localized Social Proof & Proximity Anchoring',
                'desc' => "Placing verified case studies, client quotes, and local district references from {$cityName} directly adjacent to call-to-action buttons increases visitor trust and elevates conversion velocity."
            ],
            [
                'name' => 'Loss Aversion & Revenue Leak Framing',
                'desc' => "Framing audits around identifying active revenue leaks, wasted ad spend, and competitor ranking interception triggers loss aversion psychology, outperforming standard generic 'sales consultation' offers by 3.2x."
            ],
            [
                'name' => 'Sub-Second Visual Feedback & Micro-Interactions',
                'desc' => 'Interactive UI micro-states, real-time input validation, and instant submission confirmations reassure users and eliminate abandonment from perceived technical sluggishness.'
            ],
            [
                'name' => 'Risk Reversal & White-Hat Performance Guarantees',
                'desc' => 'Transparent 90-day performance sprints, verifiable deliverables with live URLs, and month-to-month flexibility completely eliminate perceived hiring risk for executive decision-makers.'
            ]
        ],
        'attribution_deep_dive' => [
            [
                'model' => 'First-Touch Attribution (Discovery)',
                'role' => 'Credits the initial organic search keyword, Google Ads click, or digital PR feature that introduced the prospect to your brand.',
                'utility' => 'Critical for optimizing top-of-funnel content investment and discovering high-converting regional awareness channels.'
            ],
            [
                'model' => 'Lead Creation Attribution (Conversion)',
                'role' => 'Credits the exact landing page, whitepaper download, or audit form that captured the verified work email and company domain.',
                'utility' => 'Identifies your highest-converting bottom-of-funnel value propositions and message matches.'
            ],
            [
                'model' => 'Opportunity Creation Attribution (Qualification)',
                'role' => 'Tracks middle-of-funnel touchpoints (case studies, pricing calculators, retargeting ads) consumed prior to sales call scheduling.',
                'utility' => 'Ensures marketing spend nurtures inbound leads effectively into sales-qualified opportunities (SQLs).'
            ],
            [
                'model' => 'Closed-Won Revenue Attribution (Deal Close)',
                'role' => 'Links the final customer contract value directly back across all historical touchpoints via server-side CRM webhook integration.',
                'utility' => 'Provides undisputed proof of marketing return on investment (ROI) and informs accurate executive budget planning.'
            ]
        ],
        'competitive_moat' => [
            [
                'pillar' => 'Topical Content Velocity & Completeness',
                'action' => "Publishing comprehensive 12-month keyword clusters that thoroughly answer every commercial and informational query in {$cityName}, establishing an unassailable organic knowledge graph that competitors cannot quickly replicate."
            ],
            [
                'pillar' => 'Tier-1 Editorial Citations & Digital PR Moats',
                'action' => 'Securing genuine, editorially earned backlinks from high-DR industry journals, research papers, and regional publications that cannot be bought or manufactured with automated link spam.'
            ],
            [
                'pillar' => 'Proprietary Server-Side Data & Conversion Architecture',
                'action' => 'Accumulating first-party conversion data fed directly into Google and Meta machine-learning bidding algorithms, giving your campaigns an algorithmic bidding advantage that widens over time.'
            ],
            [
                'pillar' => 'Generative Engine Optimization (GEO) AI Moat',
                'action' => 'Establishing unambiguous entity data graphs across schema markup and knowledge repositories so AI search engines (ChatGPT, Google Gemini, Perplexity) cite your brand as the primary authority.'
            ]
        ],
        'technical_specifications' => [
            [
                'title' => 'Technical Site Architecture & Server Log Audit',
                'objective' => 'Eliminate crawl budget waste and ensure search engine spiders index 100% of high-value pages.',
                'scope' => 'Forensic analysis of server response codes (200, 301, 302, 404, 500), orphan URL identification, redirect chain resolution, pagination optimization, and parameter URL deduplication.',
                'tools' => 'Screaming Frog SEO Spider, Google Search Console, Postman, Cloudflare Enterprise Server Logs',
                'artifact' => 'Detailed Technical Architecture Diagnostic Sheet + Git PR for Immediate Developer Implementation'
            ],
            [
                'title' => 'Topical Graph & Semantic Keyword Clustering',
                'objective' => 'Build comprehensive topical authority across core service pillars and long-tail variants.',
                'scope' => 'Extracting search intent categories, mapping parent-child URL hierarchies, resolving keyword cannibalization across legacy content, and establishing internal link priority anchors.',
                'tools' => 'Ahrefs Keyword Explorer, SEMrush Topic Research, Google BigQuery, Custom Python NLP Scripts',
                'artifact' => 'Comprehensive 12-Month Topical Authority Blueprint + Content Production Editorial Matrix'
            ],
            [
                'title' => 'Sub-Second Core Web Vitals & Asset Optimization',
                'objective' => 'Achieve 95+ Google PageSpeed Insights scores across mobile and desktop devices.',
                'scope' => 'Inline critical CSS rendering, asynchronous script execution, Next-Gen AVIF/WebP image compression, DOM element reduction, and Edge CDN caching configuration.',
                'tools' => 'Google Lighthouse, Chrome DevTools, WebPageTest, Cloudflare Edge Workers',
                'artifact' => 'Core Web Vitals Remediation Benchmark Report + Verified Production Speed Metrics (< 1.2s LCP)'
            ],
            [
                'title' => 'First-Party Schema Markup & JSON-LD Knowledge Graph',
                'objective' => 'Structure entity relationships for Google Knowledge Graph and AI Overviews.',
                'scope' => 'Deploying connected JSON-LD schemas for Organization, LocalBusiness, Service, FAQPage, ItemList, BreadcrumbList, and Person author credentials.',
                'tools' => 'Google Rich Results Test, Schema.org Validator, JSON-LD Graph Generator',
                'artifact' => 'Production Schema Code Snippets + Validation Screenshot Audit'
            ],
            [
                'title' => 'High-Converting Conversion Rate Optimization (CRO) Landing Pages',
                'objective' => 'Maximize visitor-to-inquiry conversion rates across paid and organic traffic streams.',
                'scope' => 'Designing dedicated sub-second landing pages with 1-to-1 search intent match, friction-free forms, social proof badges, and interactive calculators.',
                'tools' => 'Figma, Hotjar Session Recordings, Google Optimize / Visual Website Optimizer (VWO)',
                'artifact' => 'High-Converting Responsive Landing Page Wireframes + Clean HTML5/CSS Production Code'
            ],
            [
                'title' => 'Server-Side Telemetry & CRM Revenue Attribution',
                'objective' => 'Connect every marketing click directly to closed-won enterprise revenue.',
                'scope' => 'Configuring Google Tag Manager Server-Side containers, GA4 custom dimension parameters, Meta Conversions API (CAPI), and bidirectional CRM sync.',
                'tools' => 'Google Tag Manager Server-Side, Google Cloud Platform (GCP), HubSpot CRM, Zoho CRM',
                'artifact' => 'Live Google Looker Studio Multi-Touch Attribution Dashboard + Weekly Pipeline Metrics'
            ]
        ],
        'unit_economics' => [
            'blended_cac_formula' => 'Blended CAC = (Total Monthly Marketing Investment + Media Spend) / Total Qualified Customers Acquired',
            'ltv_formula' => 'Customer Lifetime Value (LTV) = Average Contract Value (ACV) × Gross Margin % × Average Retention Duration (Months)',
            'payback_metric' => 'Optimal Payback Period = Blended CAC / Monthly Gross Margin per Customer (< 3.5 Months Target)',
            'roas_benchmark' => 'Target Blended ROAS = 4.0x – 6.5x across combined organic, search ads, and retention channels'
        ],
        'governance_model' => [
            [
                'stage' => 'Sprint Kickoff & Baseline Calibration (Week 1)',
                'desc' => 'Technical discovery call, granting Google Search Console & GA4 access, installing server-side tracking containers, and establishing baseline CPA/pipeline KPIs.'
            ],
            [
                'stage' => 'Weekly Asynchronous Video Telemetry Sprints',
                'desc' => 'Bi-weekly 5-minute Loom video teardowns walking through rankings progress, search term acquisitions, conversion velocity, and upcoming sprint items.'
            ],
            [
                'stage' => 'Monthly Executive Steering Review',
                'desc' => 'Live 45-minute video conference with leadership analyzing qualified pipeline generated, marketing ROI, and budget allocation adjustments.'
            ],
            [
                'stage' => 'Quarterly Strategic Business Review (QBR)',
                'desc' => 'Comprehensive strategic review assessing market territory expansion, competitive gap analysis, and upcoming fiscal quarter growth targets.'
            ]
        ]
    ];
}
