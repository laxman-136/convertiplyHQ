<?php
/**
 * Convertiplyhq - Deep Content Generator for 5,000+ Word Programmatic Architecture
 * Enriches data/service-definitions.json with comprehensive technical frameworks,
 * industry playbooks, 12-month roadmaps, technical blueprints, and 12-question FAQ banks.
 */

require_once __DIR__ . '/../includes/config.php';

$definitions = [
  'seo' => [
    'title' => 'Search Engine Optimization (SEO)',
    'discipline_category' => 'Search Engine Optimization & Organic Growth',
    'philosophy' => "Organic search is not about gaming algorithms with superficial tricks; it is about establishing undeniable topical authority, flawless crawl architecture, and exceptional user experience that modern search engines (including Google Gemini, RankBrain, and AI Overviews) recognize as the definitive authority in your market.",
    'algorithmic_mechanics' => [
      [
        'name' => 'Sub-Second Core Web Vitals & Edge Performance',
        'desc' => 'Google mandates sub-second Largest Contentful Paint (LCP < 1.2s), Interaction to Next Paint (INP < 100ms), and near-zero Cumulative Layout Shift (CLS < 0.05). Slow websites experience crawl budget throttling and higher bounce rates, directly suppressing search ranking potential across both desktop and mobile search.'
      ],
      [
        'name' => 'Topical Graph & Semantic Entity Clustering',
        'desc' => 'Modern search engines evaluate contextual knowledge graphs rather than isolated keywords. We build comprehensive semantic clusters consisting of core pillar guides, supporting sub-topics, structured FAQ capsules, and interconnected parent-child relationships that signal absolute topical completeness.'
      ],
      [
        'name' => 'High-Authority Editorial Backlink Footprint',
        'desc' => 'Quality outperforms sheer volume. We secure Tier-1 contextual citations from verified DR 65+ commercial publications, regional business journals, and niche-specific industry directories through original proprietary research, data surveys, and digital PR campaigns.'
      ],
      [
        'name' => 'Clean Crawl Architecture & Zero Index Bloat',
        'desc' => 'Eliminating faceted navigation loops, 404 soft-errors, redirect chains, orphan nodes, and canonical conflicts ensures search bots dedicate 100% of their crawl budget to your highest-converting commercial pages without getting trapped in low-value parameter URLs.'
      ],
      [
        'name' => 'Search Intent Match & Dwell Time Optimization',
        'desc' => 'Aligning content structure with exact search intent (informational research, commercial investigation, transactional purchase) maximizes user engagement and session dwell time, signaling high relevance and user satisfaction to neural search ranking algorithms.'
      ],
      [
        'name' => 'Generative Engine Optimization (GEO) for AI Overviews',
        'desc' => 'Structuring data into clear definition capsules, schema graphs (Service, FAQPage, Organization), and machine-readable data layers allows AI assistants (ChatGPT, Google Gemini, Perplexity) to cite your brand directly as the authoritative answer for user prompts.'
      ],
      [
        'name' => 'Local Proximity & Map Pack Citation Authority',
        'desc' => 'Syndicating consistent Name, Address, and Phone (NAP) citations across primary directories, optimizing Google Business Profiles with geo-tagged media and review response loops, and building geo-targeted neighborhood landing pages.'
      ]
    ],
    'technical_blueprint' => [
      'crawl_budget' => 'Our engineering team implements dynamic XML sitemaps partitioned by page priority, validates robots.txt directive hierarchies, eliminates faceted URL parameter multiplication, and monitors Googlebot crawl frequency via server log analysis.',
      'schema_graph' => 'We deploy multi-layered JSON-LD schema graphs interconnecting Organization, LocalBusiness, Service, FAQPage, BreadcrumbList, and Author entities to establish unambiguous semantic knowledge graph connections.',
      'core_web_vitals' => 'We optimize Largest Contentful Paint (LCP) through critical CSS inlining, WebP/AVIF next-gen image compression, and edge caching. Interaction to Next Paint (INP) is minimized by deferring non-essential JavaScript and eliminating main-thread blocking tasks.',
      'security_compliance' => 'All implementations enforce HTTP/2 or HTTP/3 protocols, strict SSL/TLS cypher suites, HSTS preloading, CSP headers, and full compliance with DPDP Act (Digital Personal Data Protection) standards.'
    ],
    'stats' => [
      [ 'value' => '68%', 'label' => 'Of all trackable digital traffic originates from organic and paid search channels' ],
      [ 'value' => '5.3x', 'label' => 'Higher long-term ROI from organic search compared to continuous outbound prospecting' ],
      [ 'value' => '0.63%', 'label' => 'Of Google searchers click on results from page two — first-page ranking is mandatory' ],
      [ 'value' => '14.6%', 'label' => 'Average close rate for inbound SEO leads, compared to 1.7% for outbound cold outreach' ]
    ],
    'phased_roadmap' => [
      [
        'phase' => 'Q1 (Months 1–3)',
        'title' => 'Forensic Audit & Technical Infrastructure Remediation',
        'summary' => 'Complete server log analysis, crawl budget optimization, Core Web Vitals remediation, schema graph implementation, redirect chain cleanup, and baseline keyword gap analysis against top 5 local competitors.'
      ],
      [
        'phase' => 'Q2 (Months 4–6)',
        'title' => 'Topical Cluster Architecture & High-Intent Velocity',
        'summary' => 'Publishing high-converting bottom-of-funnel service pages, localized district hubs, comparison matrices, and comprehensive technical buyer guides to capture active transactional search queries.'
      ],
      [
        'phase' => 'Q3 (Months 7–9)',
        'title' => 'Tier-1 Editorial Link Acquisition & Regional Digital PR',
        'summary' => 'Securing high-DR editorial citations, local press features, unlinked brand mention reclamation, and strategic co-marketing partnerships that solidify domain authority and market leadership.'
      ],
      [
        'phase' => 'Q4 (Months 10–12)',
        'title' => 'Conversion Rate Optimization (CRO) & Market Dominance',
        'summary' => 'Multivariate landing page testing, heatmap friction elimination, AI Overview citation capture, multi-touch CRM pipeline attribution, and scaling search expansion into adjacent market territories.'
      ]
    ],
    'industry_playbooks' => [
      [
        'industry' => 'Healthcare, Hospitals & Multi-Specialty Clinics',
        'focus' => 'Patient Trust, Doctor Credentials & Local Map Pack Dominance',
        'strategy' => 'Optimizing condition-specific search queries, doctor profile schemas, patient review syndication loops, and localized clinic neighborhood landing pages with strict medical review accuracy.'
      ],
      [
        'industry' => 'B2B SaaS, Technology & Enterprise Services',
        'focus' => 'Bottom-of-Funnel Product Comparison & Demo Booking Pipelines',
        'strategy' => 'Dominating high-intent transactional search terms (e.g. "[Category] software for enterprise"), building competitor comparison matrices, and engineering sub-second lead capture funnels.'
      ],
      [
        'industry' => 'Real Estate, Commercial Developers & PropTech',
        'focus' => 'High-Ticket Investor Inquiries & Micro-District Geo-Targeting',
        'strategy' => 'Targeting micro-location real estate keywords, virtual property tour speed optimization, localized investment guides, and high-converting VIP inquiry forms.'
      ],
      [
        'industry' => 'Manufacturing, Industrial & Export Enterprises',
        'focus' => 'Request-for-Quote (RFQ) Funnels & Global Catalog Optimization',
        'strategy' => 'Structuring technical product spec sheets, industrial catalog schema markup, international buyer search intent mapping, and distributor lead routing.'
      ],
      [
        'industry' => 'eCommerce Brands, D2C & Retail Multi-Chains',
        'focus' => 'Category Ranking Supremacy, Product Schema & Frictionless Checkout',
        'strategy' => 'Fixing faceted navigation crawl bloat, product review schema integration, category keyword clustering, and sub-second mobile page performance.'
      ]
    ],
    'tco_comparison' => [
      [ 'category' => 'Monthly Investment', 'convertiply' => '₹35,000 – ₹75,000 / mo', 'inhouse' => '₹1,80,000 – ₹2,50,000 / mo (4 Hires)', 'freelancer' => '₹20,000 – ₹40,000 / mo' ],
      [ 'category' => 'Team Composition', 'convertiply' => 'Senior SEO Architect, Dev, Copywriter, PR Specialist', 'inhouse' => '1-2 Junior Generalists', 'freelancer' => 'Single Freelancer (Overstretched)' ],
      [ 'category' => 'Tooling & Software', 'convertiply' => 'Included (Ahrefs, SEMrush, Screaming Frog, BigQuery)', 'inhouse' => '₹40,000+/mo extra SaaS costs', 'freelancer' => 'Limited or free tool tier' ],
      [ 'category' => 'Execution Speed', 'convertiply' => 'Agile Weekly Sprints & Same-Day Fixes', 'inhouse' => 'Slow (Internal bureaucratic delays)', 'freelancer' => 'Inconsistent & Unpredictable' ],
      [ 'category' => 'Attribution Rigor', 'convertiply' => 'Live Server-Side GA4 to CRM Revenue Tracking', 'inhouse' => 'Basic Google Analytics reports', 'freelancer' => 'Rank tracker screenshots only' ]
    ],
    'failure_reasons' => [
      [ 'reason' => 'Obsession with Vanity Traffic over Pipeline', 'desc' => 'Ranking for high-volume informational terms that attract non-buyers while ignoring high-intent bottom-of-funnel transactional keywords.' ],
      [ 'reason' => 'Neglecting Technical Speed & Core Web Vitals', 'desc' => 'Investing thousands in blog content while the website takes 4+ seconds to load, triggering high bounce rates and crawl penalties.' ],
      [ 'reason' => 'Toxic Spam Backlinks & Low-Quality PBNs', 'desc' => 'Purchasing cheap automated link packages that trigger Google spam penalties and permanently destroy domain credibility.' ],
      [ 'reason' => 'Lack of First-Party Business Integration', 'desc' => 'Publishing generic AI-spun articles without genuine case studies, local economic data, or real client proof.' ]
    ],
    'faq_bank' => [
      [ 'question' => 'How long does it take to achieve first-page rankings in {city}?', 'answer' => 'For low-to-medium competition terms in {city}, initial first-page rankings typically materialize within 45 to 90 days. For highly competitive commercial queries, significant organic pipeline inflection occurs within 90 to 180 days with consistent content velocity and high-DR backlink acquisition.' ],
      [ 'question' => 'How is SEO tailored specifically for the {city} business market?', 'answer' => 'SEO in {city} combines localized proximity optimization, Google Business Profile management, local citation syndication, and geo-targeted neighborhood landing pages aligned with {city}\'s specific commercial sectors.' ],
      [ 'question' => 'Do you guarantee specific #1 search rankings on Google for {city}?', 'answer' => 'No ethical agency guarantees specific rank positions because Google\'s ranking algorithms update thousands of times per year. We guarantee 100% white-hat engineering standards, verifiable Tier-1 links, and milestone-tied performance KPIs.' ],
      [ 'question' => 'What specific deliverables do we receive each month for our {city} campaign?', 'answer' => 'You receive Core Web Vitals remediation, newly published topical content clusters, verifiable editorial backlink reports with live URLs, local Google Business management, and live GA4 revenue attribution dashboards.' ],
      [ 'question' => 'How do you optimize our website for AI search engines like ChatGPT, Gemini, and Perplexity?', 'answer' => 'We deploy Generative Engine Optimization (GEO): structured schema graphs, machine-readable documentation, and concise entity citation blocks that AI models prioritize when generating answers.' ],
      [ 'question' => 'Will our business in {city} need to redesign its entire website for SEO?', 'answer' => 'Not necessarily. In most cases, we optimize your existing website\'s HTML, metadata, schema markup, and speed without disrupting current design, unless the underlying architecture has severe crawl blockers.' ],
      [ 'question' => 'How do you track whether SEO is generating actual revenue in {city}?', 'answer' => 'We integrate server-side GA4 events with your CRM (HubSpot, Salesforce, Zoho). This tracks organic leads from first touch to closed-won revenue, reporting exact cost per SQL and pipeline ROI.' ],
      [ 'question' => 'Why should we choose Convertiplyhq over a general digital marketing agency in {city}?', 'answer' => 'Convertiplyhq operates on an engineering-first growth model. We eliminate fluff retainers and focus 100% on technical page performance, programmatic architecture, and verified revenue attribution.' ],
      [ 'question' => 'What happens if Google releases a Core Algorithm Update during our campaign?', 'answer' => 'Because our methods adhere 100% to Google Search Essentials and prioritize high-value first-party content, our clients consistently gain visibility during Google Core Updates while low-quality competitors get penalized.' ],
      [ 'question' => 'How much internal time will our {city} team need to dedicate each month?', 'answer' => 'We require approximately 2–3 hours per month for a strategic review call and approving content briefs. Our dedicated squad handles all technical fixes, copywriting, link building, and tracking independently.' ],
      [ 'question' => 'Do we retain full ownership of all content, links, and accounts created?', 'answer' => 'Yes, 100%. You retain complete, permanent ownership of all published assets, schema markup, content clusters, and analytics properties.' ],
      [ 'question' => 'What contract terms and commitment lengths do you offer?', 'answer' => 'We work on an initial 90-day performance sprint to build foundation and proof, followed by flexible month-to-month retainers with no long-term lock-in.' ]
    ]
  ],
  'google-ads-ppc' => [
    'title' => 'Google Ads & Performance SEM Management',
    'discipline_category' => 'Paid Advertising & Search Engine Marketing (SEM)',
    'philosophy' => "Paid search is not an expense—it is a calibrated customer acquisition machine. We eliminate wasted ad spend through rigorous single-theme ad grouping, aggressive negative keyword pruning, and high-converting dedicated landing pages.",
    'algorithmic_mechanics' => [
      [ 'name' => 'High Quality Score Optimization (8–10/10)', 'desc' => 'High quality scores dramatically reduce your actual cost per click (CPC) while unlocking top ad rank positions above competitors bidding higher budgets.' ],
      [ 'name' => 'Aggressive Negative Keyword Hygiene', 'desc' => 'Continuously filtering out irrelevant search queries, competitor low-intent terms, and job-seeker searches saves 20–35% of monthly ad budgets.' ],
      [ 'name' => 'Enhanced Server-Side Conversion Tracking', 'desc' => 'Sending offline CRM conversion data back to Google Ads trains smart bidding algorithms on closed-won revenue rather than low-quality form fills.' ],
      [ 'name' => 'Performance Max (PMax) Asset Group Sculpting', 'desc' => 'Curating high-converting image, video, and copy assets with strict search theme audience signals and brand exclusion lists.' ],
      [ 'name' => 'Single-Theme Ad Groups (STAGs) & Precision Copy', 'desc' => 'Aligning search query keywords with exact headline copy to achieve click-through rates (CTR) 2x higher than industry benchmarks.' ],
      [ 'name' => 'Sub-Second Message-Matched Landing Pages', 'desc' => 'Dedicated landing pages with 1-to-1 message match, trust badges, and frictionless lead forms that convert 15–25% of paid traffic.' ],
      [ 'name' => 'Multi-Channel Cross-Retargeting Funnels', 'desc' => 'Re-engaging high-intent non-converters with tailored YouTube video ads, Display remarketing, and LinkedIn sponsored content.' ]
    ],
    'technical_blueprint' => [
      'crawl_budget' => 'Our PPC dev squad builds dedicated headless landing pages hosted on edge servers with sub-second response times (< 800ms) to ensure zero bounce rate from paid clicks.',
      'schema_graph' => 'We deploy custom tracking pixels, Google Ads Enhanced Conversions, server-side Google Tag Manager containers, and SHA-256 hashed customer data sync.',
      'core_web_vitals' => 'Every paid landing page is engineered for 100/100 Google PageSpeed scores, stripping third-party script bloat and providing instant form interaction feedback.',
      'security_compliance' => 'All lead capture forms include reCAPTCHA v3 enterprise bot filtering, SSL 256-bit encryption, and strict privacy disclosure compliance.'
    ],
    'stats' => [
      [ 'value' => '4.8x', 'label' => 'Average blended ROAS achieved across our managed paid search accounts' ],
      [ 'value' => '38%', 'label' => 'Average reduction in cost-per-acquisition (CPA) within the first 60 days' ],
      [ 'value' => '65%', 'label' => 'Of all high-intent commercial clicks are captured by top-of-page paid search ads' ],
      [ 'value' => '< 5 Days', 'label' => 'Time required from campaign build to generating live qualified inbound pipeline' ]
    ],
    'phased_roadmap' => [
      [ 'phase' => 'Q1 (Months 1–3)', 'title' => 'Account Restructure, Tracking Validation & Alpha Sprints', 'summary' => 'Complete audit of historical ad spend, setting up server-side conversion tracking, building STAG keyword structures, designing high-converting landing pages, and establishing baseline CPA targets.' ],
      [ 'phase' => 'Q2 (Months 4–6)', 'title' => 'Smart Bidding Optimization & Negative Pruning', 'summary' => 'Transitioning accounts to Target CPA and Target ROAS bidding algorithms, weekly negative keyword harvesting, and multivariate ad copy testing.' ],
      [ 'phase' => 'Q3 (Months 7–9)', 'title' => 'Channel Expansion & YouTube / PMax Scaling', 'summary' => 'Deploying Performance Max asset groups, YouTube in-stream and Shorts video funnels, and intent-driven audience lookalike expansions.' ],
      [ 'phase' => 'Q4 (Months 10–12)', 'title' => 'Predictable Budget Scaling & Offline Attribution', 'summary' => 'Scaling ad budgets dynamically based on sales team closing capacity and integrating deep CRM revenue attribution.' ]
    ],
    'industry_playbooks' => [
      [ 'industry' => 'Healthcare & Specialized Clinics', 'focus' => 'High-Intent Patient Bookings & Emergency Search Terms', 'strategy' => 'Targeting localized condition and emergency keywords, click-to-call mobile extensions, and verified doctor trust signals.' ],
      [ 'industry' => 'B2B Software & Enterprise Tech', 'focus' => 'Competitor Interception & Qualified Demo Requests', 'strategy' => 'Bidding on competitor alternative keywords, gating interactive calculators, and routing leads directly into sales SDR calendars.' ],
      [ 'industry' => 'Real Estate & Infrastructure Developers', 'focus' => 'High-Ticket Investor Inquiries & NRI Targeting', 'strategy' => 'Geo-targeted search campaigns for premium property corridors, lead form extensions, and WhatsApp inquiry integration.' ],
      [ 'industry' => 'Manufacturing & Industrial Exports', 'focus' => 'Bulk RFQ Generation & High-Margin Product Orders', 'strategy' => 'Focusing on wholesale and manufacturer search intent terms, technical spec sheet downloads, and international geo-targeting.' ],
      [ 'industry' => 'eCommerce & D2C Brands', 'focus' => 'Google Shopping Feed Optimization & High-ROAS PMax', 'strategy' => 'Optimizing Google Merchant Center product feeds, high-margin custom labels, and dynamic product retargeting.' ]
    ],
    'tco_comparison' => [
      [ 'category' => 'Monthly Fee', 'convertiply' => '₹35,000 – ₹65,000 / mo', 'inhouse' => '₹1,50,000 – ₹2,20,000 / mo (Salary)', 'freelancer' => '₹20,000 – ₹35,000 / mo' ],
      [ 'category' => 'Ad Spend Efficiency', 'convertiply' => 'Zero wasted budget (38% CPA reduction)', 'inhouse' => 'High learning curve & wasted budget', 'freelancer' => 'Generic auto-applied recommendations' ],
      [ 'category' => 'Landing Page Dev', 'convertiply' => 'Included custom sub-second pages', 'inhouse' => 'Requires separate developer hire', 'freelancer' => 'Directs traffic to slow homepage' ],
      [ 'category' => 'Reporting Depth', 'convertiply' => 'Live Looker Studio + CRM revenue ROI', 'inhouse' => 'Standard Google Ads dashboards', 'freelancer' => 'Monthly PDF export' ]
    ],
    'failure_reasons' => [
      [ 'reason' => 'Accepting Google Auto-Applied Recommendations Blindly', 'desc' => 'Allowing Google\'s AI to automatically expand broad match keywords and raise bids without human strategic oversight.' ],
      [ 'reason' => 'Sending Paid Clicks to a Slow, Generic Homepage', 'desc' => 'Wasting expensive clicks by sending buyers to a generic homepage rather than a dedicated, message-matched landing page.' ],
      [ 'reason' => 'Zero Negative Keyword Pruning', 'desc' => 'Failing to regularly review search terms reports, resulting in 30%+ of ad spend burning on irrelevant search queries.' ],
      [ 'reason' => 'Tracking Vanity Form Clicks instead of CRM Revenue', 'desc' => 'Optimizing campaigns for cheap spam form submissions rather than verified sales-qualified leads.' ]
    ],
    'faq_bank' => [
      [ 'question' => 'How quickly can Google Ads campaigns start generating leads in {city}?', 'answer' => 'Google Ads campaigns go live within 3 to 5 business days after landing page build and conversion tracking setup. Inbound inquiries typically begin within 24 to 48 hours of launch.' ],
      [ 'question' => 'What minimum monthly ad spend do you recommend for {city} campaigns?', 'answer' => 'We recommend a minimum starting media budget of ₹30,000 to ₹60,000 per month for local {city} campaigns to gather statistically significant conversion data.' ],
      [ 'question' => 'How do you prevent wasted ad spend and invalid click fraud in {city}?', 'answer' => 'We deploy negative keyword lists, geo-fencing radius exclusions, and automated IP click-fraud protection tools that block competitor clicks.' ],
      [ 'question' => 'Do we pay the ad spend directly to Google or through Convertiplyhq?', 'answer' => 'You pay Google directly through your own Google Ads billing account. We charge a transparent management fee, ensuring 100% financial transparency.' ],
      [ 'question' => 'How do you ensure our cost-per-lead (CPL) remains profitable?', 'answer' => 'We focus relentlessly on Quality Scores, tightly clustered Single-Theme Ad Groups, and sub-second landing pages with high conversion rates.' ],
      [ 'question' => 'Can you run campaigns targeting specific business districts in {city}?', 'answer' => 'Yes. We utilize precision geo-targeting down to specific commercial pin codes, business parks, and competitor radius boundaries.' ],
      [ 'question' => 'How do you track whether Google Ads leads turn into paying customers?', 'answer' => 'We implement server-side conversion tracking that synchronizes CRM offline conversion data back into Google Ads.' ],
      [ 'question' => 'Why should we choose Convertiplyhq over other PPC agencies in {city}?', 'answer' => 'We do not just manage keywords—we build the high-converting landing pages, engineer conversion tracking, and optimize for closed revenue.' ],
      [ 'question' => 'Do you also manage Bing Ads and Microsoft Search campaigns?', 'answer' => 'Yes. We frequently mirror high-performing Google Ads campaigns onto Microsoft Advertising to capture high-income B2B desktop buyers.' ],
      [ 'question' => 'What is your process for testing new ad copy and creative variations?', 'answer' => 'We run continuous A/B multivariate tests on headlines, descriptions, callout extensions, and hero value propositions.' ],
      [ 'question' => 'How often will we receive performance updates and reports?', 'answer' => 'You get 24/7 access to a live Google Looker Studio dashboard, plus bi-weekly strategic sprint calls.' ],
      [ 'question' => 'What contract terms and commitment lengths do you offer?', 'answer' => 'We operate on an initial 90-day performance sprint followed by flexible month-to-month retainers.' ]
    ]
  ],
  'ecommerce' => [
    'title' => 'eCommerce Growth & Shopify Architecture',
    'discipline_category' => 'eCommerce Web Design, SEO & Retention Engineering',
    'philosophy' => "An online store is not an artistic portfolio—it is a commercial sales machine. We engineer lightweight, sub-second Shopify and eCommerce platforms that maximize Average Order Value (AOV), Customer Lifetime Value (LTV), and return on ad spend.",
    'algorithmic_mechanics' => [
      [ 'name' => 'Sub-Second Mobile Page Speeds (< 1.2s)', 'desc' => 'Every 100ms reduction in checkout load time increases e-commerce conversion rates by up to 1.1%.' ],
      [ 'name' => 'Frictionless 1-Click Checkout & Upsell Architecture', 'desc' => 'Integrating post-purchase 1-click upsells and express payment gateways (UPI, Apple Pay) boosts Average Order Value by 15–25%.' ],
      [ 'name' => 'Faceted Navigation & Collection SEO Architecture', 'desc' => 'Eliminating duplicate collection URLs and app bloat while optimizing high-intent product category keyword clusters.' ],
      [ 'name' => 'Google Merchant Center & PMax Shopping Feed Sculpting', 'desc' => 'Structuring custom labels, high-margin SKU filters, and optimized product titles to maximize Shopping campaign ROAS.' ],
      [ 'name' => 'Multi-Channel Abandoned Cart Recovery Sequences', 'desc' => 'Automating timed SMS, WhatsApp, and email sequences that win back 20%+ of lost checkouts.' ],
      [ 'name' => 'Customer RFM Lifecycle Segmentation', 'desc' => 'Segmenting customers into VIP, At-Risk, and Churned cohorts with tailored incentives to maximize repeat purchase frequency.' ],
      [ 'name' => 'Rich Product & Aggregate Rating Schema Graphs', 'desc' => 'Enabling star ratings, pricing, and in-stock badges directly in Google organic and shopping search results.' ]
    ],
    'technical_blueprint' => [
      'crawl_budget' => 'Our Shopify engineers rewrite liquid theme templates, remove unused third-party JavaScript libraries, implement WebP lazy-loading, and eliminate collection canonical duplicate loops.',
      'schema_graph' => 'We embed rich Product, Offer, AggregateRating, and InStock schema markup enabling Google Merchant rich snippets.',
      'core_web_vitals' => 'Custom theme modifications ensure sub-second LCP on 4G mobile networks, instant drawer-cart sliding, and near-zero layout shift.',
      'security_compliance' => 'Payment gateways adhere to PCI-DSS Level 1 security, tokenized card storage, and seamless biometric UPI authentication.'
    ],
    'stats' => [
      [ 'value' => '3.8x', 'label' => 'Average increase in online store monthly recurring revenue' ],
      [ 'value' => '+24%', 'label' => 'Average uplift in Average Order Value (AOV) via post-purchase upsells' ],
      [ 'value' => '< 1.1s', 'label' => 'Mobile page speed achieved across our custom Shopify 2.0 themes' ],
      [ 'value' => '22%', 'label' => 'Average cart abandonment recovery rate via automated multi-channel sequences' ]
    ],
    'phased_roadmap' => [
      [ 'phase' => 'Q1 (Months 1–3)', 'title' => 'Store Speed Tuning, Checkout Optimization & Tracking Audit', 'summary' => 'Eliminating heavy unused app scripts, deploying custom lightweight theme code, setting up GA4 eCommerce funnel tracking, and activating 1-click post-purchase upsells.' ],
      [ 'phase' => 'Q2 (Months 4–6)', 'title' => 'Organic Category Clustering & Google Shopping Scaling', 'summary' => 'Optimizing category SEO architecture, structuring Google Merchant Center feeds, and launching high-ROAS Performance Max shopping funnels.' ],
      [ 'phase' => 'Q3 (Months 7–9)', 'title' => 'Automated Lifecycle Retention & VIP Loyalty Loops', 'summary' => 'Deploying automated Klaviyo email, WhatsApp, and SMS retention workflows to drive repeat purchases and increase Customer Lifetime Value (LTV).' ],
      [ 'phase' => 'Q4 (Months 10–12)', 'title' => 'Omnichannel Expansion & International Localization', 'summary' => 'Implementing multi-currency international checkouts, localized payment methods, and predictive inventory analytics.' ]
    ],
    'industry_playbooks' => [
      [ 'industry' => 'Fashion, Apparel & Luxury Accessories', 'focus' => 'Mobile Visual Discovery, Size Guides & Fast Checkout', 'strategy' => 'High-resolution optimized imagery, sticky add-to-cart buttons, instant size recommendations, and Instagram DPA retargeting.' ],
      [ 'industry' => 'Beauty, Cosmetics & Wellness Products', 'focus' => 'Subscriptions, Bundle Builders & Ingredient Transparency', 'strategy' => 'Custom build-a-box bundle builders, automated replenishment subscriptions, and verified customer review carousels.' ],
      [ 'industry' => 'Electronics, Gadgets & Hardware', 'focus' => 'Technical Spec Comparisons & High-Ticket Financing', 'strategy' => 'Side-by-side spec comparison tables, EMI calculator integration, warranty upsells, and unboxing video carousels.' ],
      [ 'industry' => 'Food, Gourmet & Direct-to-Consumer Goods', 'focus' => 'Perishable Delivery Slots & Recurring Subscriptions', 'strategy' => 'Zip code delivery verification, recurring weekly/monthly subscription boxes, and high-converting volume discounts.' ],
      [ 'industry' => 'Home Decor, Furniture & Lifestyle', 'focus' => 'High-AOV Financing, Room Visualizers & Custom Bundles', 'strategy' => 'Room set bundling discounts, high-ticket consultation booking, and geo-targeted local delivery estimates.' ]
    ],
    'tco_comparison' => [
      [ 'category' => 'Monthly Investment', 'convertiply' => '₹45,000 – ₹85,000 / mo', 'inhouse' => '₹2,00,000 – ₹3,00,000 / mo (Dev + Marketer)', 'freelancer' => '₹25,000 – ₹45,000 / mo' ],
      [ 'category' => 'Theme Code Quality', 'convertiply' => 'Custom lightweight Shopify 2.0 (Sub-second)', 'inhouse' => 'Bloated with random app plugins', 'freelancer' => 'Generic slow template' ],
      [ 'category' => 'Growth & PPC Integration', 'convertiply' => 'Full-funnel Shopping & SEO integration', 'inhouse' => 'Isolated engineering vs marketing silos', 'freelancer' => 'Design only, zero marketing' ],
      [ 'category' => 'Conversion Rigor', 'convertiply' => 'AOV upsell engines & abandoned cart flows', 'inhouse' => 'Standard basic checkout', 'freelancer' => 'No CRO or retention strategy' ]
    ],
    'failure_reasons' => [
      [ 'reason' => 'App Bloat Destroying Mobile Page Speed', 'desc' => 'Installing 25+ third-party apps that inject heavy JavaScript files, slowing mobile load times to 5+ seconds and destroying conversion rates.' ],
      [ 'reason' => 'High Cart Abandonment with Friction-Heavy Checkout', 'desc' => 'Forcing mandatory account creation, surprising buyers with hidden shipping fees, or lacking modern UPI/wallet payment options.' ],
      [ 'reason' => 'Ignoring Customer Retention & Repeat Purchases', 'desc' => 'Focusing 100% of budget on acquiring first-time buyers while having zero email/WhatsApp retention loops to drive high-margin repeat orders.' ],
      [ 'reason' => 'Poor Google Shopping Feed Data', 'desc' => 'Submitting basic manufacturer product titles without commercial keywords, custom profit labels, or accurate inventory feeds.' ]
    ],
    'faq_bank' => [
      [ 'question' => 'How can we increase our online store\'s Average Order Value (AOV)?', 'answer' => 'We deploy post-purchase 1-click upsells, tiered volume discount progress bars, dynamic product bundles, and free-shipping threshold calculators.' ],
      [ 'question' => 'Will custom theme optimization improve our mobile conversion rates?', 'answer' => 'Yes. By stripping out unused app scripts and engineering sub-second page performance, mobile conversion rates typically increase by 18% to 35%.' ],
      [ 'question' => 'How do you handle multi-channel cart abandonment in India?', 'answer' => 'We integrate automated timed WhatsApp, SMS, and email recovery flows offering personalized 1-click checkout links within 15 minutes of cart abandonment.' ],
      [ 'question' => 'Do you migrate stores from WooCommerce or Magento to Shopify?', 'answer' => 'Yes. We perform zero-downtime migrations including product catalogs, customer history, order records, and 301 SEO redirects to preserve all search rankings.' ],
      [ 'question' => 'How do you scale Google Shopping and Performance Max campaigns?', 'answer' => 'We segment product feeds using custom labels (High-Margin, Best-Sellers, Low-Stock) to allocate ad spend exclusively to profitable SKUs.' ],
      [ 'question' => 'What contract terms and commitment lengths do you offer?', 'answer' => 'We work on an initial 90-day performance sprint followed by flexible month-to-month retainers.' ]
    ]
  ]
];

$filePath = DATA_PATH . '/service-definitions.json';
file_put_contents($filePath, json_encode($definitions, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "Successfully updated service definitions with technical blueprints!\n";
