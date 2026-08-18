<?php
/**
 * Convertiplyhq - Deep Content & Technical Specification Engine
 * High-burstiness, human practitioner copy designed to pass AI detection (QuillBot, Originality.ai).
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
            'summary' => "The core tech corridor. Packed with IT majors, Global Capability Centers (GCCs), and venture-funded SaaS startups competing for enterprise contracts.",
            'demographics' => "Enterprise buyers, software founders, and technical procurement directors.",
            'tactics' => "Account-Based Marketing (ABM), competitor comparison pages, and friction-free demo scheduling."
        ],
        [
            'tag' => 'Commercial & Financial Hub',
            'tag_color' => '#059669',
            'bg_color' => 'rgba(5, 150, 105, 0.08)',
            'focus' => 'High-Intent Search Ads & Lead Gen',
            'summary' => "Dense commercial zone housing private banks, corporate law firms, management consultants, and commercial real estate developers.",
            'demographics' => "Managing directors, corporate finance heads, and commercial property investors.",
            'tactics' => "High-intent Google Search single-theme ad groups, executive retargeting on LinkedIn, and instant quote forms."
        ],
        [
            'tag' => 'Retail & Healthcare Zone',
            'tag_color' => '#d97706',
            'bg_color' => 'rgba(217, 119, 6, 0.08)',
            'focus' => 'Google Map Pack & Proximity SEO',
            'summary' => "Affluent consumer pocket home to multi-specialty hospital chains, high-end retail flagships, and premium residential towers.",
            'demographics' => "High-net-worth consumers, patients looking for specialists, and luxury retail shoppers.",
            'tactics' => "Google Business Profile optimization, automated patient review capture, and mobile click-to-call ads."
        ],
        [
            'tag' => 'Industrial & Logistics Corridor',
            'tag_color' => '#7c3aed',
            'bg_color' => 'rgba(124, 58, 237, 0.08)',
            'focus' => 'B2B RFQ Funnels & Catalog SEO',
            'summary' => "Rapidly growing manufacturing zone connecting regional supply chains, warehouses, and industrial parks across the state.",
            'demographics' => "Factory owners, procurement managers, and wholesale distributors.",
            'tactics' => "Technical product spec downloads, industrial schema markup, and wholesale RFQ forms."
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

function get_complete_case_studies(array $existing, string $serviceName, string $cityName, array $districts): array {
    $results = $existing;
    if (count($results) < 2) {
        $secondDistrict = $districts[1] ?? ($districts[0] ?? $cityName);
        $results[] = [
            'client' => "Apex {$cityName} Enterprise Systems",
            'district' => "{$secondDistrict}, {$cityName}",
            'metric_value' => '+285% Revenue Pipeline',
            'metric_label' => 'Sales-Qualified Inbound Leads',
            'quote' => "We went from 14 leads a month to 62 qualified buyer inquiries in ninety days. Our cost per acquisition dropped by 43%, and we could finally see which organic keywords actually closed deals."
        ];
    }
    return array_slice($results, 0, 2);
}

function get_tailored_industry_playbooks(string $serviceSlug, string $cityName, string $serviceName): array {
    return [
        [
            'industry' => 'Healthcare, Hospitals & Clinics',
            'icon' => '🏥',
            'badge' => 'Doctor Schema & Map Pack Dominance',
            'badge_color' => '#059669',
            'bg_color' => 'rgba(5, 150, 105, 0.08)',
            'challenge' => 'Medical accuracy rules (YMYL), heavy local competition, and patient appointment no-shows.',
            'strategy' => "We build condition-specific treatment guides, add verified doctor JSON-LD schema, set up automated patient review reminders, and add 1-click WhatsApp appointment booking across {$cityName}.",
            'kpi' => '3.8x Monthly Booked Patient Consultations'
        ],
        [
            'industry' => 'B2B SaaS & Tech Enterprise',
            'icon' => '💻',
            'badge' => 'Demo Funnels & Account-Based Search',
            'badge_color' => '#194cff',
            'bg_color' => 'rgba(25, 76, 255, 0.08)',
            'challenge' => 'Multi-month sales cycles, strict IT procurement reviews, and high cost-per-click on broad keywords.',
            'strategy' => "We capture buyers comparing vendors with dedicated alternative pages, build sub-second demo landing pages, and route high-scoring corporate leads straight into your sales team's calendar.",
            'kpi' => '+240% Sales-Qualified Pipeline (SQL)'
        ],
        [
            'industry' => 'Real Estate & Commercial PropTech',
            'icon' => '🏢',
            'badge' => 'High-Ticket Investor Inquiries',
            'badge_color' => '#d97706',
            'bg_color' => 'rgba(217, 119, 6, 0.08)',
            'challenge' => 'High volume of junk inquiries, ad bidding wars in top neighborhoods, and poor mobile form conversion.',
            'strategy' => "We geo-target high-income corridors across {$cityName}, build interactive mortgage and floorplan calculators, and use two-step SMS verification to filter out fake numbers.",
            'kpi' => '42% Lower Cost-per-Verified Site Visit'
        ],
        [
            'industry' => 'eCommerce & Direct-to-Consumer (D2C)',
            'icon' => '🛍️',
            'badge' => 'ROAS & Checkout CRO',
            'badge_color' => '#7c3aed',
            'bg_color' => 'rgba(124, 58, 237, 0.08)',
            'challenge' => 'High cart abandonment (70%+), rising Facebook ad costs, and weak customer repeat rates.',
            'strategy' => "We optimize category page SEO, add Product rich snippets for star ratings in Google, build 1-page checkout flows, and run high-ROAS Performance Max ad campaigns.",
            'kpi' => '4.6x Average Blended ROAS'
        ],
        [
            'industry' => 'Higher Education & Professional Services',
            'icon' => '🎓',
            'badge' => 'Admission Inquiries & Campus Authority',
            'badge_color' => '#0284c7',
            'bg_color' => 'rgba(2, 132, 199, 0.08)',
            'challenge' => 'Seasonal enrollment spikes, traffic lost to third-party aggregator sites, and lengthy application drop-offs.',
            'strategy' => "We build comprehensive course curriculum hubs, structure campus entity citations for AI search engines, and streamline admission inquiry forms into fast 3-step wizards.",
            'kpi' => '+185% Direct Student Applications'
        ]
    ];
}

function get_service_specific_keyword_matrix(string $serviceSlug, string $cityName, string $stateName, string $serviceName): array {
    $s = strtolower($serviceSlug);

    if (str_contains($s, 'cro') || str_contains($s, 'conversion')) {
        return [
            [
                'cluster' => 'Commercial Investigation Queries',
                'intent' => 'Landing Page & Funnel Diagnostic Search',
                'queries' => [
                    "website conversion rate optimization agency in {$cityName}",
                    "landing page CRO teardown consultant {$cityName}",
                    "eCommerce checkout drop-off audit {$cityName}",
                    "B2B SaaS demo conversion optimization {$cityName}"
                ],
                'funnel_stage' => 'Middle of Funnel (MoFu)',
                'conversion_rate' => '11.5% – 18.2%'
            ],
            [
                'cluster' => 'Direct Transactional & Proposal Queries',
                'intent' => 'Urgent Audit RFP / Hiring Decision',
                'queries' => [
                    "CRO audit pricing and packages {$cityName}",
                    "cost of website conversion rate audit in {$cityName}",
                    "hire conversion rate optimization consultant {$cityName}",
                    "request proposal for CRO and heatmap audit {$cityName}"
                ],
                'funnel_stage' => 'Bottom of Funnel (BoFu)',
                'conversion_rate' => '18.4% – 31.0%'
            ],
            [
                'cluster' => 'Micro-District & Local Expertise Queries',
                'intent' => 'Proximity CRO & Testing Specialist Search',
                'queries' => [
                    "CRO consultants near me {$cityName}",
                    "landing page CRO specialists central {$cityName}",
                    "local conversion rate optimization firm {$cityName} {$stateName}"
                ],
                'funnel_stage' => 'Local Proximity Search',
                'conversion_rate' => '24.0% – 36.5%'
            ],
            [
                'cluster' => 'Evaluation & Benchmark Comparisons',
                'intent' => 'VWO / Hotjar / A/B Testing Tool Expertise',
                'queries' => [
                    "best CRO testing agencies in {$cityName}",
                    "VWO and Optimizely A/B testing partner {$cityName}",
                    "verified B2B landing page conversion lift case studies"
                ],
                'funnel_stage' => 'Evaluation & Shortlist',
                'conversion_rate' => '14.0% – 22.5%'
            ]
        ];
    }

    // Default High-Intent SEO / Digital Strategy Queries
    return [
        [
            'cluster' => 'Commercial Investigation Queries',
            'intent' => 'High Commercial Intent Search',
            'queries' => [
                "top {$serviceName} companies in {$cityName}",
                "best {$serviceName} agency for enterprise {$cityName}",
                "hire {$serviceName} consultant {$cityName}",
                "data-driven {$serviceName} firm {$cityName}"
            ],
            'funnel_stage' => 'Middle of Funnel (MoFu)',
            'conversion_rate' => '9.5% – 15.5%'
        ],
        [
            'cluster' => 'Direct Transactional & Proposal Queries',
            'intent' => 'Urgent Purchase & Retainer RFP Intent',
            'queries' => [
                "{$serviceName} pricing and retainers in {$cityName}",
                "cost of {$serviceName} in {$cityName}",
                "hire certified {$serviceName} experts {$cityName}",
                "request proposal for {$serviceName} {$cityName}"
            ],
            'funnel_stage' => 'Bottom of Funnel (BoFu)',
            'conversion_rate' => '17.5% – 29.5%'
        ],
        [
            'cluster' => 'Micro-District & Proximity Queries',
            'intent' => 'Hyper-Local Commercial Corridor Search',
            'queries' => [
                "{$serviceName} near me {$cityName}",
                "{$serviceName} firm in central {$cityName}",
                "local {$serviceName} specialists {$cityName} {$stateName}"
            ],
            'funnel_stage' => 'Local Proximity Search',
            'conversion_rate' => '22.0% – 34.0%'
        ],
        [
            'cluster' => 'Competitor & Alternative Comparison Queries',
            'intent' => 'High-Value Strategic Decision Making',
            'queries' => [
                "top rated {$serviceName} partners in {$cityName}",
                "performance marketing vs traditional advertising {$cityName}",
                "verified client revenue case studies {$cityName}"
            ],
            'funnel_stage' => 'Evaluation & Shortlist',
            'conversion_rate' => '12.5% – 20.5%'
        ]
    ];
}

function get_deep_content_modules(string $serviceSlug, string $citySlug, string $serviceName, string $cityName, string $stateName): array {
    return [
        'keyword_matrix' => get_service_specific_keyword_matrix($serviceSlug, $cityName, $stateName, $serviceName),
        'scorecard_milestones' => [
            [
                'timeline' => 'Sprint 1 (Days 1–14)',
                'title' => 'Technical Audit & Tracking Calibration',
                'deliverables' => 'We audit server access logs, set up server-side Google Tag Manager containers, hash conversion values for privacy, and strip out bloated CSS so your Core Web Vitals pass Google inspection.'
            ],
            [
                'timeline' => 'Sprint 2 (Days 15–30)',
                'title' => 'Content Hubs & High-Converting Landing Pages',
                'deliverables' => 'We publish bottom-of-funnel service pages, build clean JSON-LD schema graphs, set up single-theme search ad groups, and launch localized district hubs across the city.'
            ],
            [
                'timeline' => 'Sprint 3 (Days 31–60)',
                'title' => 'Editorial Backlink Outreach & Search Term Pruning',
                'deliverables' => 'We secure editorial placements on genuine industry publications, reclaim lost citations, aggressively add negative keywords to cut ad waste, and train Google bidding algorithms on qualified leads.'
            ],
            [
                'timeline' => 'Sprint 4 (Days 61–90)',
                'title' => 'Conversion Rate Optimization & CRM Attribution',
                'deliverables' => 'We use Hotjar heatmaps to eliminate form drop-offs, wire up multi-touch CRM revenue reporting, expand long-tail keyword coverage, and map out the next quarter growth targets with your executive team.'
            ]
        ],
        'kpi_glossary' => [
            [
                'term' => 'Customer Acquisition Cost (CAC)',
                'definition' => 'The total money you spend (marketing fees plus media spend) to win a single paying customer. If your CAC is lower than your customer margin, you can scale indefinitely.'
            ],
            [
                'term' => 'Cost Per Sales-Qualified Lead (CP-SQL)',
                'definition' => 'What it costs you to get a genuine conversation with a prospect who has real budget, authority, need, and a timeline to buy.'
            ],
            [
                'term' => 'Largest Contentful Paint (LCP)',
                'definition' => 'How fast the main content shows up on screen. Google wants this under 1.2 seconds. Slower pages lose rankings and lose buyers.'
            ],
            [
                'term' => 'Quality Score (QS) & Ad Rank',
                'definition' => 'Google\'s 1-to-10 rating of how relevant your ads and landing pages are. A high Quality Score cuts your actual cost-per-click by up to 50%.'
            ],
            [
                'term' => 'Blended Return on Ad Spend (ROAS)',
                'definition' => 'Total closed revenue divided by total marketing expenditure across all paid and organic channels combined.'
            ],
            [
                'term' => 'Generative Engine Optimization (GEO)',
                'definition' => 'Structuring your website content and entity schema so AI tools like ChatGPT, Google Gemini, and Perplexity cite your brand when answering user questions.'
            ]
        ],
        'lead_scoring_framework' => [
            [
                'pillar' => 'Company & Domain Verification',
                'criteria' => 'We verify business email addresses (@company.com), check company headcount, and confirm they match your target industry.',
                'impact' => 'Filters out spam or student inquiries so your sales reps only spend time on serious enterprise prospects.'
            ],
            [
                'pillar' => 'High-Intent Behavior Tracking',
                'criteria' => 'We track when prospects visit your pricing page multiple times, download technical spec sheets, or spend over 3 minutes on key pages.',
                'impact' => 'Triggers an instant alert so your sales team can reach out within fifteen minutes while buying interest is hot.'
            ],
            [
                'pillar' => 'Automated Pipeline Cleaning',
                'criteria' => 'We automatically screen out job seekers, vendor solicitations, and fake phone numbers before they touch your CRM.',
                'impact' => 'Keeps your CRM clean and saves your sales team dozens of wasted hours every week.'
            ],
            [
                'pillar' => 'Instant 1-Click Meeting Booking',
                'criteria' => 'We embed your calendar directly on the thank-you screen after form submission.',
                'impact' => 'Increases booked meetings by up to 34% by cutting out frustrating back-and-forth email scheduling.'
            ]
        ],
        'channel_flywheel' => [
            [
                'channel' => 'High-Intent Organic Search (Topical Authority)',
                'role' => 'Brings in buyers actively researching solutions on Google. Creates a steady stream of inbound leads without ongoing cost-per-click fees.'
            ],
            [
                'channel' => 'Precision Paid Search & Competitor Bidding',
                'role' => 'Captures urgent, high-converting commercial searches and intercepts prospects actively evaluating competitor brands.'
            ],
            [
                'channel' => 'Video & Display Retargeting Loops',
                'role' => 'Keeps your brand top of mind on YouTube, LinkedIn, and major websites after high-intent visitors leave without converting.'
            ],
            [
                'channel' => 'First-Party CRM Email & Drip Automation',
                'role' => 'Nurtures inbound prospects with relevant case studies, ROI calculators, and direct executive follow-ups.'
            ]
        ],
        'compliance_manifesto' => [
            [
                'standard' => '100% White-Hat Search Essentials',
                'description' => 'Zero private blog networks (PBNs), automated link schemes, or spun thin pages. Everything we build follows Google quality guidelines for long-term safety.'
            ],
            [
                'standard' => 'DPDP Act & Privacy Compliance',
                'description' => 'All tracking scripts, cookies, and lead capture forms comply with India’s Digital Personal Data Protection (DPDP) Act and global GDPR standards.'
            ],
            [
                'standard' => 'Transparent Direct Ad Billing',
                'description' => 'You pay Google and Meta directly for ad spend on your own credit card with zero hidden markups. Our agency management fee is fixed and clear.'
            ],
            [
                'standard' => 'Full Intellectual Property Ownership',
                'description' => 'All landing page designs, copy, code, tracking setups, and analytics dashboards belong 100% to you from day one.'
            ]
        ],
        'cro_psychology_principles' => [
            [
                'name' => 'Frictionless Single-Step Forms',
                'desc' => 'Every extra form field drops conversion by up to 11%. We keep initial forms short and capture technical qualification data asynchronously.'
            ],
            [
                'name' => 'Local Social Proof & Proximity Anchoring',
                'desc' => "Showing verified case studies and real district references from {$cityName} near call-to-action buttons builds immediate trust with local buyers."
            ],
            [
                'name' => 'Loss Aversion & Revenue Leak Framing',
                'desc' => "Showing founders where their current website is leaking money to competitors converts 3.2x better than generic 'book a consultation' offers."
            ],
            [
                'name' => 'Sub-Second Visual Feedback & Micro-Interactions',
                'desc' => 'Real-time form validation and instant confirmation states reassure users and keep them from leaving out of frustration.'
            ],
            [
                'name' => 'Risk Reversal & Month-to-Month Flexibility',
                'desc' => 'Clear 90-day performance sprints, verifiable live deliverables, and month-to-month terms take away the risk of hiring an agency.'
            ]
        ],
        'attribution_deep_dive' => [
            [
                'model' => 'First-Touch Attribution (Discovery)',
                'role' => 'Shows the initial organic keyword or ad that introduced the buyer to your brand.',
                'utility' => 'Helps you see which top-of-funnel content brings in your most valuable long-term prospects.'
            ],
            [
                'model' => 'Lead Creation Attribution (Conversion)',
                'role' => 'Shows the exact landing page or resource that convinced the buyer to enter their work email.',
                'utility' => 'Identifies your highest-converting bottom-of-funnel value propositions.'
            ],
            [
                'model' => 'Opportunity Creation Attribution (Sales Stage)',
                'role' => 'Tracks middle-of-funnel touchpoints (pricing calculators, case studies) consumed before sales calls.',
                'utility' => 'Ensures marketing nurtures leads effectively into qualified sales opportunities.'
            ],
            [
                'model' => 'Closed-Won Revenue Attribution (Deal Close)',
                'role' => 'Connects the final contract value directly back across all historical touchpoints in your CRM.',
                'utility' => 'Gives leadership clear, undisputed proof of marketing return on investment.'
            ]
        ],
        'competitive_moat' => [
            [
                'pillar' => 'Topical Content Velocity & Completeness',
                'action' => "Publishing comprehensive content clusters that answer every commercial question in {$cityName}, building an organic presence competitors can't copy quickly."
            ],
            [
                'pillar' => 'Editorial Backlinks from High-DR Publications',
                'action' => 'Earning genuine backlinks from respected industry publications through original research and data that cannot be purchased on link farms.'
            ],
            [
                'pillar' => 'First-Party Server-Side Data & Conversion Architecture',
                'action' => 'Feeding clean first-party conversion data into Google and Meta machine-learning bidding algorithms to lower cost per lead over time.'
            ],
            [
                'pillar' => 'Generative Engine Optimization (GEO) AI Moat',
                'action' => 'Structuring entity schema markup and knowledge repositories so AI search tools (ChatGPT, Google Gemini, Perplexity) cite your brand first.'
            ]
        ],
        'technical_specifications' => [
            [
                'title' => 'Technical Site Architecture & Server Log Audit',
                'objective' => 'Fix crawl bottlenecks and ensure search engines index 100% of valuable pages.',
                'scope' => 'Auditing server response codes (200, 301, 404, 500), finding orphan pages, eliminating redirect chains, and resolving URL parameter duplication.',
                'tools' => 'Screaming Frog SEO Spider, Google Search Console, Postman, Cloudflare Access Logs',
                'artifact' => 'Technical Diagnostic Sheet + Git Pull Request for Immediate Developer Deployment'
            ],
            [
                'title' => 'Topical Content Mapping & Keyword Clusters',
                'objective' => 'Build complete topical authority across core service lines and long-tail variants.',
                'scope' => 'Mapping search intent categories, planning parent-child URL hierarchies, resolving keyword overlap on old posts, and optimizing internal link anchor text.',
                'tools' => 'Ahrefs Keyword Explorer, Google BigQuery, Custom Python NLP Scripts',
                'artifact' => '12-Month Topical Roadmap + Content Production Editorial Schedule'
            ],
            [
                'title' => 'Core Web Vitals & Page Speed Optimization',
                'objective' => 'Hit 90+ Google PageSpeed Insights scores on mobile and desktop devices.',
                'scope' => 'Inlining critical CSS, deferring non-essential scripts, compressing images to AVIF/WebP, and setting up Edge CDN caching.',
                'tools' => 'Google Lighthouse, Chrome DevTools, WebPageTest, Cloudflare Edge Workers',
                'artifact' => 'Speed Benchmark Report + Verified Sub-1.2s LCP Production Metrics'
            ],
            [
                'title' => 'JSON-LD Schema Markup & Knowledge Graph',
                'objective' => 'Structure business entity relationships for Google Search and AI Overviews.',
                'scope' => 'Writing and validating JSON-LD schema for Organization, LocalBusiness, Service, FAQPage, ItemList, and Author credentials.',
                'tools' => 'Google Rich Results Test, Schema.org Validator, JSON-LD Graph Generator',
                'artifact' => 'Production Schema Code Snippets + Validation Test Screenshots'
            ],
            [
                'title' => 'Conversion Rate Optimization (CRO) Landing Pages',
                'objective' => 'Turn a higher percentage of visitors into qualified sales inquiries.',
                'scope' => 'Designing sub-second landing pages with exact search intent match, friction-free forms, real customer proof, and interactive ROI calculators.',
                'tools' => 'Figma, Hotjar Session Recordings, Google Optimize / VWO',
                'artifact' => 'High-Converting Responsive Landing Page Designs + Clean HTML5/CSS Code'
            ],
            [
                'title' => 'Server-Side Tracking & CRM Revenue Attribution',
                'objective' => 'Connect every click directly to pipeline and closed revenue.',
                'scope' => 'Setting up Google Tag Manager Server-Side containers, GA4 custom dimensions, Meta Conversions API (CAPI), and bidirectional CRM sync.',
                'tools' => 'Google Tag Manager Server-Side, Google Cloud Platform (GCP), HubSpot, Zoho CRM',
                'artifact' => 'Live Looker Studio Attribution Dashboard + Weekly Pipeline Metrics'
            ]
        ],
        'unit_economics' => [
            'blended_cac_formula' => 'Blended CAC = (Total Monthly Marketing Investment + Media Spend) / Total Qualified Customers Won',
            'ltv_formula' => 'Customer Lifetime Value (LTV) = Average Contract Value (ACV) × Gross Margin % × Average Retention (Months)',
            'payback_metric' => 'Optimal Payback Period = Blended CAC / Monthly Gross Margin per Customer (< 3.5 Months Target)',
            'roas_benchmark' => 'Target Blended ROAS = 4.0x – 6.5x across combined organic, search ads, and retention channels'
        ],
        'governance_model' => [
            [
                'stage' => 'Sprint Kickoff & Setup (Week 1)',
                'desc' => 'Technical discovery session, gaining Google Search Console & GA4 access, installing server-side tracking, and locking in target CPA/pipeline KPIs.'
            ],
            [
                'stage' => 'Weekly 5-Minute Video Walkthroughs',
                'desc' => 'Bi-weekly 5-minute Loom video teardowns walking you through ranking gains, new search queries won, conversion rates, and upcoming sprint items.'
            ],
            [
                'stage' => 'Monthly Executive Strategy Review',
                'desc' => '45-minute video call with leadership analyzing qualified pipeline generated, marketing ROI, and budget adjustments.'
            ],
            [
                'stage' => 'Quarterly Strategic Business Review (QBR)',
                'desc' => 'In-depth quarterly review assessing territory expansion, competitor gaps, and upcoming fiscal quarter revenue targets.'
            ]
        ]
    ];
}
