<?php
/**
 * Convertiplyhq - Programmatic Service × City Landing Page Template
 * Complete 18-section architecture adhering strictly to Programmatic SEO specifications.
 */

if (!defined('CONVERTIPLY_INIT')) {
    require_once __DIR__ . '/../includes/config.php';
}

// Extract service and city parameters
$serviceSlug = $serviceSlug ?? ($_GET['service'] ?? 'seo');
$citySlug = $citySlug ?? ($_GET['city'] ?? 'hyderabad');

$page = get_programmatic_page($serviceSlug, $citySlug);

// Uniqueness Safeguard: If missing or thin content (no case studies and < 4 FAQs), do not render thin content
if (!$page || (empty($page['case_studies']) && count($page['faqs'] ?? []) < 4)) {
    http_response_code(404);
    error_log("[Convertiplyhq PSEO Safeguard] Page omitted due to thin content criteria: {$serviceSlug}-in-{$citySlug}");
    require __DIR__ . '/../index.php';
    exit;
}

$serviceName = $page['service'];
$serviceFullName = $page['service_full_name'];
$cityName = $page['city'];
$stateName = $page['state'];

$isDirect = $isDirectServicePage ?? false;
$canonicalUrl = $isDirect ? service_url($page['service_slug']) : service_city_url($page['service_slug'], $page['city_slug']);
$robotsDirective = $isDirect ? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' : get_robots_meta_directive($page['service_slug'], $page['city_slug']);

// SEO Metadata
$metaTitle = $isDirect ? "{$serviceFullName} | Convertiplyhq" : "{$serviceName} Services in {$cityName} | Convertiplyhq";
$metaDescription = "Accelerate revenue with expert {$serviceName} services in {$cityName}, {$stateName}. Typical investment {$page['avg_price_range']}. Tailored for local high-growth businesses.";

$faqsForSchema = [];
foreach ($page['faqs'] as $faq) {
    $faqsForSchema[] = [
        'q' => $faq['question'],
        'a' => $faq['answer']
    ];
}

$pageSeo = [
    'title' => $metaTitle,
    'description' => $metaDescription,
    'canonical' => $canonicalUrl,
    'robots' => $robotsDirective,
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'Services', 'url' => site_url('services')],
        ['name' => "{$serviceName} in {$cityName}", 'url' => $canonicalUrl]
    ],
    'serviceData' => $page['service_data'],
    'cityData' => $page['city_data'],
    'faqs' => $faqsForSchema
];

require __DIR__ . '/../includes/header.php';
?>

<!-- Section 1: Breadcrumbs -->
<div class="breadcrumb-wrap">
  <div class="container">
    <ul class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?= site_url() ?>" itemprop="item"><span itemprop="name">Home</span></a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb-separator">/</li>
      <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?= site_url('services') ?>" itemprop="item"><span itemprop="name">Services</span></a>
        <meta itemprop="position" content="2" />
      </li>
      <li class="breadcrumb-separator">/</li>
      <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name"><?= e($serviceName) ?> in <?= e($cityName) ?></span>
        <meta itemprop="position" content="3" />
      </li>
    </ul>
  </div>
</div>

<!-- Section 2: Hero -->
<section class="hero">
  <div class="container">
    <div class="hero-grid">
      <div class="hero-content">
        <div class="section-tag section-tag-secondary">
          <span>📍</span> <?= e($cityName) ?>, <?= e($stateName) ?> · <?= e($page['service_category']) ?>
        </div>
        <h1><?= e($serviceName) ?> Services in <span style="color: var(--color-primary);"><?= e($cityName) ?></span></h1>
        <p class="lead">
          <?= e($page['intro_stat']) ?>
        </p>

        <div class="flex gap-16" style="margin-top: 24px; flex-wrap: wrap;">
          <a href="<?= site_url('contact?service=' . urlencode($page['service_slug']) . '&city=' . urlencode($page['city_slug'])) ?>" class="btn btn-primary" id="heroCtaBtn">
            Get My Free Proposal →
          </a>
          <a href="#deliverables-grid" class="btn btn-ghost">
            View What's Included
          </a>
        </div>

        <div class="hero-stats-row">
          <div class="hero-stat-item">
            <h3><?= e($page['city_data']['avgMonthlySearches'] ?? '35,000+') ?></h3>
            <p>Monthly Local Searches</p>
          </div>
          <div class="hero-stat-item">
            <h3><?= e($page['avg_price_range']) ?></h3>
            <p>Benchmark Price Range</p>
          </div>
          <div class="hero-stat-item">
            <h3><?= e($page['city_data']['auditedBusinessesCount'] ?? '180+') ?></h3>
            <p><?= e($cityName) ?> Brands Audited</p>
          </div>
        </div>
      </div>

      <!-- Quick Lead Card in Hero -->
      <div class="hero-card">
        <div class="hero-card-header">
          <span class="section-tag" style="font-size: 11px; margin-bottom: 6px;">Confidential Strategy Audit</span>
          <h3>Request Your <?= e($cityName) ?> Growth Proposal</h3>
          <p>Get a diagnostic breakdown of your market opportunities and competitor gaps.</p>
        </div>
        <form action="<?= site_url('contact') ?>" method="GET" class="hero-form">
          <input type="hidden" name="service" value="<?= e($page['service_slug']) ?>">
          <input type="hidden" name="city" value="<?= e($page['city_slug']) ?>">
          <div class="form-group">
            <label class="form-label">Website URL / Company Name</label>
            <input type="text" name="website" class="form-control" placeholder="e.g. yourcompany.com" required>
          </div>
          <div class="form-group">
            <label class="form-label">Work Email</label>
            <input type="email" name="email" class="form-control" placeholder="name@company.com" required>
          </div>
          <div class="form-group">
            <label class="form-label">Phone / WhatsApp</label>
            <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block" style="margin-top: 8px;">Claim Free <?= e($cityName) ?> Proposal →</button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Section 3: Intro / Overview Block -->
<section class="section">
  <div class="container">
    <div class="grid grid-2" style="gap: 48px; align-items: center;">
      <div>
        <div class="section-tag">Market Overview</div>
        <h2>Why <?= e($serviceName) ?> Matters for Businesses in <?= e($cityName) ?></h2>
        <p>
          <?= e($page['service_full_name']) ?> in <?= e($cityName) ?> is engineered to help ambitious enterprises and high-growth SMEs capture ready-to-buy customer demand. In a market where digital competition is rapidly intensifying across commercial hubs like <?= e($page['city_data']['hub'] ?? $cityName) ?>, relying on unoptimized marketing creates high customer acquisition friction.
        </p>
        <p>
          We tailor every campaign to the <?= e($cityName) ?> commercial ecosystem, prioritizing high-growth regional sectors including <strong><?= implode(', ', $page['industry_focus']) ?></strong>.
        </p>
      </div>

      <div class="card card-tint">
        <h3 style="font-size: 19px; margin-bottom: 16px;">Core Deliverables Included:</h3>
        <ul style="list-style: none; display: flex; flex-direction: column; gap: 10px;">
          <?php foreach (array_slice($page['deliverables'], 0, 6) as $del): ?>
            <li style="font-size: 15px; font-weight: 500; display: flex; align-items: center; gap: 8px;">
              <span style="color: var(--color-success); font-weight: bold; font-size: 16px;">✓</span>
              <span><?= e($del['title']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
        <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid var(--color-border);">
          <span style="font-size: 13px; color: var(--color-text-light);">Typical Retainer: <strong><?= e($page['avg_price_range']) ?></strong></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section 4: Proof Strip (Static Site-Wide) -->
<section class="trust-strip" style="background: var(--color-bg-alt);">
  <div class="container">
    <div class="grid grid-4" style="text-align: center; gap: 20px;">
      <div>
        <div style="font-size: 32px; font-weight: 800; color: var(--color-primary); margin-bottom: 2px;">148+</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">5-Star Client Reviews</div>
      </div>
      <div>
        <div style="font-size: 32px; font-weight: 800; color: var(--color-primary); margin-bottom: 2px;">5+ Years</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Engineering Growth</div>
      </div>
      <div>
        <div style="font-size: 32px; font-weight: 800; color: var(--color-primary); margin-bottom: 2px;">210+</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Brands Scaled in India</div>
      </div>
      <div>
        <div style="font-size: 32px; font-weight: 800; color: var(--color-primary); margin-bottom: 2px;">₹45Cr+</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Client Revenue Tracked</div>
      </div>
    </div>
  </div>
</section>

<!-- Section 5: Case Studies (Omitted if empty) -->
<?php if (!empty($page['case_studies'])): ?>
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag section-tag-secondary">Proven Results</div>
      <h2><?= e($cityName) ?> Client Case Studies</h2>
      <p>Real performance outcomes delivered for companies in <?= e($cityName) ?>.</p>
    </div>

    <div class="flex flex-col gap-24">
      <?php foreach ($page['case_studies'] as $cs): ?>
        <div class="case-study-card">
          <div class="flex justify-between items-center" style="flex-wrap: wrap; gap: 12px;">
            <div>
              <span class="case-badge">Verified Performance</span>
              <h3 style="margin-bottom: 4px;"><?= e($cs['client']) ?></h3>
              <p style="font-size: 14px; margin-bottom: 0; color: var(--color-text-muted);">
                📍 <?= e($cs['district']) ?> · <strong>Industry:</strong> <?= e($cs['industry'] ?? 'B2B Growth') ?>
              </p>
            </div>
            <div style="text-align: right;">
              <div class="case-metric-highlight"><?= e($cs['metric_value']) ?></div>
              <span style="font-size: 13px; font-weight: 600; color: var(--color-success);"><?= e($cs['metric_label']) ?></span>
            </div>
          </div>
          <p style="margin-top: 18px; font-size: 15px; line-height: 1.65; color: var(--color-text);">
            "<?= e($cs['quote']) ?>"
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Section 6: Lead Capture Form (Embedded Shared Component) -->
<section class="section section-alt">
  <div class="container" style="max-width: 840px;">
    <div class="card">
      <div class="section-header" style="margin-bottom: 24px;">
        <div class="section-tag">Direct Strategy Access</div>
        <h2 style="font-size: 26px;">Get a Tailored <?= e($serviceName) ?> Plan for <?= e($cityName) ?></h2>
        <p style="font-size: 14px;">Speak with our senior growth architects. Zero hard sell. 100% confidential analysis.</p>
      </div>

      <form action="<?= site_url('contact') ?>" method="POST" id="contactForm">
        <input type="hidden" name="service" value="<?= e($page['service_slug']) ?>">
        <input type="hidden" name="city" value="<?= e($page['city_slug']) ?>">

        <div class="grid grid-2" style="gap: 16px;">
          <div class="form-group">
            <label class="form-label" for="name">Your Name *</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Alex Morgan" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="email">Work Email *</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="alex@company.com" required>
          </div>
        </div>

        <div class="grid grid-2" style="gap: 16px;">
          <div class="form-group">
            <label class="form-label" for="phone">Phone / WhatsApp *</label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="+91 98765 43210" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="website">Company Website</label>
            <input type="text" id="website" name="website" class="form-control" placeholder="yourcompany.com">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="message">What is your primary growth goal?</label>
          <textarea id="message" name="message" class="form-control" placeholder="Tell us about your current challenges, target CAC, or timeline..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="padding: 14px 32px; font-size: 16px;">
          Claim Free Proposal for <?= e($cityName) ?> →
        </button>
      </form>
    </div>
  </div>
</section>

<!-- Section 7: "What is {Service}?" (Static per service type) -->
<section class="section">
  <div class="container">
    <div class="section-header text-left" style="max-width: 900px;">
      <div class="section-tag">Educational Breakdown</div>
      <h2>What is <?= e($page['service_full_name']) ?>?</h2>
      <p style="font-size: 17px; line-height: 1.7; color: var(--color-text);">
        <?= e($page['service_def']['what_is'] ?? "{$page['service_full_name']} is a systematic digital acquisition framework designed to drive measurable qualified revenue and market share.") ?>
      </p>
    </div>
  </div>
</section>

<!-- Section 8: Ranking / Success Factors List (Static per service type) -->
<?php if (!empty($page['service_def']['ranking_factors'])): ?>
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Core Principles</div>
      <h2>Critical Success Factors for <?= e($serviceName) ?></h2>
      <p>The technical and strategic pillars required to win in modern competitive search landscapes.</p>
    </div>

    <div class="grid grid-3">
      <?php foreach ($page['service_def']['ranking_factors'] as $idx => $factor): ?>
        <div class="card card-sm">
          <div style="font-size: 14px; font-weight: 700; color: var(--color-primary); margin-bottom: 8px;">
            0<?= $idx + 1 ?>
          </div>
          <p style="font-size: 14px; margin-bottom: 0; color: var(--color-text); font-weight: 500;">
            <?= e($factor) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Section 9: Stats / Why-It-Matters Block (Static per service type) -->
<?php if (!empty($page['service_def']['stats'])): ?>
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag section-tag-secondary">Data & Benchmarks</div>
      <h2>Why <?= e($serviceName) ?> Matters by the Numbers</h2>
      <p>Key industry benchmarks illustrating the impact of performance execution.</p>
    </div>

    <div class="grid grid-4">
      <?php foreach ($page['service_def']['stats'] as $stat): ?>
        <div class="card" style="text-align: center; padding: 28px 20px;">
          <div style="font-size: 34px; font-weight: 800; color: var(--color-primary); margin-bottom: 6px;">
            <?= e($stat['value']) ?>
          </div>
          <p style="font-size: 13px; margin-bottom: 0; color: var(--color-text-muted);">
            <?= e($stat['label']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Section 10: Benefits List (Two-Column Bullet List, Static per service) -->
<?php if (!empty($page['service_def']['benefits_column_1']) || !empty($page['service_def']['benefits_column_2'])): ?>
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Business Impact</div>
      <h2>Direct Business Benefits of <?= e($serviceName) ?></h2>
      <p>How this capability directly accelerates enterprise enterprise value and EBITDA.</p>
    </div>

    <div class="grid grid-2" style="gap: 32px;">
      <div class="card">
        <ul style="list-style: none; display: flex; flex-direction: column; gap: 14px;">
          <?php foreach ($page['service_def']['benefits_column_1'] as $ben): ?>
            <li style="font-size: 15px; color: var(--color-text); display: flex; align-items: start; gap: 10px;">
              <span style="color: var(--color-success); font-weight: bold; font-size: 16px; margin-top: 1px;">✓</span>
              <span><?= e($ben) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="card">
        <ul style="list-style: none; display: flex; flex-direction: column; gap: 14px;">
          <?php foreach ($page['service_def']['benefits_column_2'] as $ben): ?>
            <li style="font-size: 15px; color: var(--color-text); display: flex; align-items: start; gap: 10px;">
              <span style="color: var(--color-success); font-weight: bold; font-size: 16px; margin-top: 1px;">✓</span>
              <span><?= e($ben) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Section 11: Methodology / Tools Block (Static Site-Wide) -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Proven Methodology</div>
      <h2>Our 4-Stage Growth Operating System</h2>
      <p>A battle-tested engineering process designed for repeatable, compounding results.</p>
    </div>

    <div class="grid grid-4">
      <div class="card deliverable-card">
        <div class="deliverable-icon">01</div>
        <h3>Forensic Audit</h3>
        <p>Comprehensive telemetry, crawl budget, and funnel leak diagnosis.</p>
      </div>
      <div class="card deliverable-card">
        <div class="deliverable-icon" style="background: var(--color-secondary-light); color: #92400e;">02</div>
        <h3>Growth Architecture</h3>
        <p>Custom keyword clusters, sub-second landing pages, and campaign structures.</p>
      </div>
      <div class="card deliverable-card">
        <div class="deliverable-icon" style="background: var(--color-success-light); color: #065f46;">03</div>
        <h3>Weekly Sprints</h3>
        <p>Continuous creative testing, backlink outreach, and technical fixes.</p>
      </div>
      <div class="card deliverable-card">
        <div class="deliverable-icon">04</div>
        <h3>Revenue Scale</h3>
        <p>Live BI dashboards reporting cost per SQL and closed revenue.</p>
      </div>
    </div>
  </div>
</section>

<!-- Section 12: Deliverables Grid (Full Title + Description) -->
<section class="section section-alt" id="deliverables-grid">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Complete Scope</div>
      <h2>Everything Included in Our <?= e($serviceName) ?> Program</h2>
      <p>Full-stack deliverables engineered for the <?= e($cityName) ?> commercial ecosystem.</p>
    </div>

    <div class="grid grid-3">
      <?php foreach ($page['deliverables'] as $del): ?>
        <div class="card deliverable-card">
          <div class="deliverable-icon">⚡</div>
          <h3><?= e($del['title']) ?></h3>
          <p><?= e($del['description']) ?></p>
          <div style="font-size: 13px; font-weight: 600; color: var(--color-primary); margin-top: auto;">
            Included in all engagements →
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Section 13: "How This Drives Results" (Narrative + Tips, Static per service) -->
<section class="section">
  <div class="container">
    <div class="card" style="padding: 40px; background: linear-gradient(180deg, #ffffff 0%, var(--color-bg-alt) 100%);">
      <div class="section-tag">Outcome Engineering</div>
      <h2>How <?= e($serviceName) ?> Drives Measurable Pipeline</h2>
      <p style="font-size: 16px; line-height: 1.7; color: var(--color-text); margin-bottom: 24px;">
        <?= e($page['service_def']['how_it_drives_results'] ?? "Our data-driven execution aligns keyword intent, sub-second UX, and closed-loop attribution to transform casual web traffic into qualified sales pipeline.") ?>
      </p>

      <?php if (!empty($page['service_def']['practical_tips'])): ?>
        <h4 style="font-size: 16px; margin-bottom: 12px; color: var(--color-text);">Expert Execution Tips:</h4>
        <ul style="list-style: none; display: flex; flex-direction: column; gap: 8px;">
          <?php foreach ($page['service_def']['practical_tips'] as $tip): ?>
            <li style="font-size: 14px; color: var(--color-text-muted); display: flex; align-items: start; gap: 8px;">
              <span style="color: var(--color-primary); font-weight: bold;">💡</span>
              <span><?= e($tip) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Section 14: Why Choose Us (Static Site-Wide Differentiators) -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <div class="section-tag section-tag-secondary">The Convertiplyhq Standard</div>
      <h2>Why Leaders Partner With Convertiplyhq</h2>
      <p>We built our agency to eliminate the bloat, opacity, and excuses of legacy firms.</p>
    </div>

    <div class="grid grid-4">
      <div class="card card-sm">
        <div class="deliverable-icon">📊</div>
        <h4>Pricing Transparency</h4>
        <p style="font-size: 13px;">Clear scopes with no hidden fees or multi-year lock-ins.</p>
      </div>
      <div class="card card-sm">
        <div class="deliverable-icon" style="background: var(--color-success-light); color: #047857;">📈</div>
        <h4>Real-Time Reporting</h4>
        <p style="font-size: 13px;">Live GA4 & CRM revenue attribution dashboards 24/7.</p>
      </div>
      <div class="card card-sm">
        <div class="deliverable-icon" style="background: var(--color-secondary-light); color: #92400e;">⚡</div>
        <h4>Sub-Second Speed</h4>
        <p style="font-size: 13px;">All pages engineered to score 95+ on Google Core Web Vitals.</p>
      </div>
      <div class="card card-sm">
        <div class="deliverable-icon">👥</div>
        <h4>Senior Squad Only</h4>
        <p style="font-size: 13px;">Direct execution by veteran growth architects, not junior interns.</p>
      </div>
    </div>
  </div>
</section>

<!-- Section 15: "How to Choose the Right Agency" (Static Site-Wide) -->
<section class="section">
  <div class="container" style="max-width: 900px;">
    <div class="section-header text-left">
      <div class="section-tag">Buyer's Guide</div>
      <h2>How to Choose the Right <?= e($serviceName) ?> Agency for <?= e($cityName) ?></h2>
      <p>Before hiring any digital marketing firm in <?= e($cityName) ?>, ensure they meet these 4 essential criteria:</p>
    </div>

    <div class="flex flex-col gap-16">
      <div class="card card-sm" style="display: flex; gap: 16px; align-items: start;">
        <div style="font-size: 20px; font-weight: 800; color: var(--color-primary);">1.</div>
        <div>
          <h4 style="font-size: 16px; margin-bottom: 4px;">Demands Revenue & Pipeline KPIs (Not Just Impressions)</h4>
          <p style="font-size: 14px; margin-bottom: 0;">Reject agencies that only report clicks, impressions, or traffic without connecting metrics to sales opportunities and ROI.</p>
        </div>
      </div>

      <div class="card card-sm" style="display: flex; gap: 16px; align-items: start;">
        <div style="font-size: 20px; font-weight: 800; color: var(--color-primary);">2.</div>
        <div>
          <h4 style="font-size: 16px; margin-bottom: 4px;">Provides Complete 100% Account Ownership</h4>
          <p style="font-size: 14px; margin-bottom: 0;">Ensure you own all Google Ads accounts, tracking pixels, analytics containers, and creative assets directly.</p>
        </div>
      </div>

      <div class="card card-sm" style="display: flex; gap: 16px; align-items: start;">
        <div style="font-size: 20px; font-weight: 800; color: var(--color-primary);">3.</div>
        <div>
          <h4 style="font-size: 16px; margin-bottom: 4px;">Demonstrates Technical Rigor & Page Speed Mastery</h4>
          <p style="font-size: 14px; margin-bottom: 0;">Slow landing pages waste ad budget and hurt organic search. Your agency must engineer sub-second page performance.</p>
        </div>
      </div>

      <div class="card card-sm" style="display: flex; gap: 16px; align-items: start;">
        <div style="font-size: 20px; font-weight: 800; color: var(--color-primary);">4.</div>
        <div>
          <h4 style="font-size: 16px; margin-bottom: 4px;">Operates in Agile Sprints Without 12-Month Lock-Ins</h4>
          <p style="font-size: 14px; margin-bottom: 0;">Trust agencies that earn your partnership monthly through verifiable deliverables and sprint agility.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section 16: FAQ (8-12 Questions with FAQPage Schema) -->
<section class="section section-alt" id="faq-section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Frequently Asked Questions</div>
      <h2>FAQs: <?= e($serviceName) ?> in <?= e($cityName) ?></h2>
      <p>Direct answers to questions regarding our <?= strtolower(e($serviceName)) ?> campaigns in <?= e($cityName) ?>.</p>
    </div>

    <div class="faq-list">
      <?php foreach ($page['faqs'] as $index => $faq): ?>
        <div class="faq-item <?= ($index === 0) ? 'active' : '' ?>">
          <button class="faq-question" type="button" aria-expanded="<?= ($index === 0) ? 'true' : 'false' ?>">
            <span><?= e($faq['question']) ?></span>
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p><?= e($faq['answer']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Section 17: Closing CTA -->
<section class="section">
  <div class="container">
    <div class="cta-banner">
      <h2>Ready to Dominate Your Market in <?= e($cityName) ?>?</h2>
      <p>
        Schedule your free 30-minute growth roadmap session today. We will audit your current <?= strtolower(e($serviceName)) ?> performance and show you the exact strategy to scale revenue in <?= e($cityName) ?>.
      </p>
      <div class="cta-banner-buttons">
        <a href="<?= site_url('contact?service=' . urlencode($page['service_slug']) . '&city=' . urlencode($page['city_slug'])) ?>" class="btn btn-white">
          Get My Free Proposal →
        </a>
        <a href="tel:<?= urlencode(SITE_PHONE) ?>" class="btn btn-ghost" style="color: #ffffff; border-color: rgba(255,255,255,0.4);">
          📞 Call <?= e(SITE_PHONE) ?>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Section 18: Related Pages / Internal Links Matrix -->
<section class="section section-alt" style="padding-top: 40px; padding-bottom: 48px;">
  <div class="container">
    <div class="grid grid-2" style="gap: 36px;">
      <div>
        <h3 style="font-size: 20px; margin-bottom: 8px;">Related Digital Services in <?= e($cityName) ?></h3>
        <p style="font-size: 13px; color: var(--color-text-muted); margin-bottom: 16px;">Explore complementary growth channels for your <?= e($cityName) ?> business:</p>
        <div class="flex flex-col gap-8">
          <?php 
          $allServices = get_all_services();
          $sCount = 0;
          foreach ($allServices as $otherS):
            if ($otherS['slug'] === $page['service_slug']) continue;
            $sCount++;
            if ($sCount > 5) break;
          ?>
            <a href="<?= service_city_url($otherS['slug'], $page['city_slug']) ?>" class="link-card" style="padding: 10px 16px; font-size: 14px;">
              <span><?= e($otherS['name']) ?> in <?= e($cityName) ?></span>
              <span class="link-arrow">→</span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <div>
        <h3 style="font-size: 20px; margin-bottom: 8px;"><?= e($serviceName) ?> in Other Major Cities</h3>
        <p style="font-size: 13px; color: var(--color-text-muted); margin-bottom: 16px;">We also deliver premier <?= strtolower(e($serviceName)) ?> programs across India:</p>
        <div class="flex flex-col gap-8">
          <?php 
          $allCities = get_all_cities();
          $cCount = 0;
          
          // Prioritize cities in the same state first, then top metros
          $sameStateCities = array_filter($allCities, fn($c) => ($c['state'] ?? '') === $stateName && $c['slug'] !== $page['city_slug']);
          $metroSlugs = ['hyderabad', 'bengaluru', 'mumbai', 'delhi', 'pune', 'chennai', 'ahmadabad', 'kolkata'];
          
          $featuredCities = array_slice($sameStateCities, 0, 3);
          foreach ($metroSlugs as $mSlug) {
            if (count($featuredCities) >= 5) break;
            $mCity = get_city_by_slug($mSlug);
            if ($mCity && $mCity['slug'] !== $page['city_slug'] && !in_array($mCity, $featuredCities)) {
              $featuredCities[] = $mCity;
            }
          }

          foreach ($featuredCities as $otherC):
          ?>
            <a href="<?= service_city_url($page['service_slug'], $otherC['slug']) ?>" class="link-card" style="padding: 10px 16px; font-size: 14px;">
              <span><?= e($serviceName) ?> Services in <?= e($otherC['name']) ?> (<?= e($otherC['state'] ?? 'India') ?>)</span>
              <span class="link-arrow">→</span>
            </a>
          <?php endforeach; ?>
          
          <a href="<?= site_url('services#city-matrix') ?>" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: var(--color-primary); margin-top: 6px; padding: 4px 8px;">
            Explore All 500+ Indian Cities Matrix →
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
