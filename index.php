<?php
/**
 * Convertiplyhq - Modern Homepage
 */
require_once __DIR__ . '/includes/config.php';

$allServices = get_all_services();
$allCities = get_all_cities();
$testimonials = get_testimonials(null, null, 3);
$generalFaqs = get_data('faqs.json')['generalFaqs'] ?? [];

$pageSeo = [
    'title' => 'Convertiplyhq | Data-Driven Digital Marketing & Growth Engineering Agency',
    'description' => 'Convertiplyhq is a premier performance marketing agency helping high-growth brands and B2B companies scale revenue through SEO, Google Ads, Paid Social, and Conversion-Engineered Web Design.',
    'canonical' => site_url(),
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()]
    ],
    'faqs' => $generalFaqs
];

require __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <div class="hero-grid">
      <div class="hero-content">
        <div class="section-tag section-tag-secondary">
          ⚡ Engineering-Driven Growth Agency
        </div>
        <h1>Stop Wasting Marketing Budget. <span style="color: var(--color-primary);">Scale Predictable Revenue.</span></h1>
        <p class="lead">
          We combine technical SEO, precision Google & Meta Ads, and sub-second conversion architecture to turn your website into a reliable customer acquisition machine.
        </p>

        <div class="flex gap-16" style="margin-top: 28px; flex-wrap: wrap;">
          <a href="<?= site_url('contact') ?>" class="btn btn-primary">Get Free Growth Audit</a>
          <a href="<?= site_url('services') ?>" class="btn btn-ghost">Explore Services Directory</a>
        </div>

        <div class="hero-stats-row">
          <div class="hero-stat-item">
            <h3>4.8x</h3>
            <p>Average Blended ROAS</p>
          </div>
          <div class="hero-stat-item">
            <h3>+320%</h3>
            <p>Avg Organic Pipeline Lift</p>
          </div>
          <div class="hero-stat-item">
            <h3>₹45Cr+</h3>
            <p>Tracked Client Revenue</p>
          </div>
        </div>
      </div>

      <!-- Hero Lead Capture Card -->
      <div class="hero-card">
        <div class="hero-card-header">
          <span class="section-tag" style="font-size: 11px; margin-bottom: 6px;">Instant Proposal</span>
          <h3>Request Your 2026 Growth Roadmap</h3>
          <p>Get a comprehensive audit of your search rankings, ad spend efficiency, and landing page conversion rate.</p>
        </div>
        <form action="<?= site_url('contact') ?>" method="GET" class="hero-form">
          <div class="form-group">
            <label class="form-label">Company Website / Domain</label>
            <input type="text" name="website" class="form-control" placeholder="e.g. yourcompany.com" required>
          </div>
          <div class="form-group">
            <label class="form-label">Primary Growth Goal</label>
            <select name="service" class="form-control">
              <option value="local-seo">Scale Local & Technical SEO</option>
              <option value="google-ads-management">Google Ads & Performance SEM</option>
              <option value="ai-seo-services">AI SEO & Generative Search (GEO)</option>
              <option value="lead-generation-services">B2B Lead Generation & ABM</option>
              <option value="ecommerce-ppc">eCommerce & Shopify PPC Growth</option>
              <option value="cro-audits">Conversion Rate Optimization (CRO)</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Work Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="alex@company.com" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block" style="margin-top: 8px;">Claim Free Growth Audit →</button>
        </form>
        <p style="font-size: 12px; color: var(--color-text-light); text-align: center; margin-top: 12px; margin-bottom: 0;">
          🔒 Zero commitment. 100% confidential analysis.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Trust Logos / Badges Strip -->
<section class="trust-strip">
  <div class="container">
    <div class="trust-title">Trusted By Fast-Growing Brands & B2B Leaders Across India</div>
    <div class="trust-logos">
      <div class="trust-logo-pill">🚀 KovaTech Cloud</div>
      <div class="trust-logo-pill">🌿 AuraVeda Wellness</div>
      <div class="trust-logo-pill">📦 NexLogix Supply</div>
      <div class="trust-logo-pill">⚡ DevMetrics API</div>
      <div class="trust-logo-pill">⚙️ Autovance Precision</div>
      <div class="trust-logo-pill">🏥 CareAlign Health</div>
    </div>
  </div>
</section>

<!-- Core Services Grid -->
<section class="section" id="services-grid">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Capabilities</div>
      <h2>Full-Funnel Digital Growth Services</h2>
      <p>Every channel is engineered for maximum measurable attribution and customer lifetime value.</p>
    </div>

    <div class="grid grid-3">
      <?php foreach ($allServices as $s): ?>
        <div class="card deliverable-card">
          <div class="deliverable-icon">
            <?php if ($s['slug'] === 'seo'): ?>🔍
            <?php elseif ($s['slug'] === 'google-ads-ppc'): ?>🎯
            <?php elseif ($s['slug'] === 'social-media-marketing'): ?>📱
            <?php elseif ($s['slug'] === 'content-marketing'): ?>✍️
            <?php elseif ($s['slug'] === 'web-design'): ?>💻
            <?php else: ?>✉️<?php endif; ?>
          </div>
          <h3><?= e($s['name']) ?></h3>
          <p><?= e($s['shortDesc']) ?></p>
          
          <div style="margin-top: auto; padding-top: 16px; border-top: 1px solid var(--color-border-subtle);">
            <div class="flex justify-between items-center">
              <span style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">
                6 City Hubs Available
              </span>
              <a href="<?= service_hub_url($s['slug']) ?>" class="btn-ghost btn-sm" style="padding: 6px 14px;">
                Learn More →
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <div class="section-tag section-tag-secondary">The Convertiplyhq Advantage</div>
      <h2>Why High-Growth Companies Partner With Us</h2>
      <p>We eliminated the bloat, vanity metrics, and sluggish delivery of legacy marketing agencies.</p>
    </div>

    <div class="grid grid-4">
      <div class="card card-sm">
        <div class="deliverable-icon" style="background: var(--color-bg-secondary); color: #b45309;">📊</div>
        <h4>Revenue-Tied KPIs</h4>
        <p style="font-size: 14px;">We measure qualified pipeline, cost per acquisition (CPA), and verified ROI, not hollow impressions.</p>
      </div>

      <div class="card card-sm">
        <div class="deliverable-icon">⚡</div>
        <h4>Engineering Rigor</h4>
        <p style="font-size: 14px;">Sub-second page speeds, clean schema structures, and automated tracking loops built on data.</p>
      </div>

      <div class="card card-sm">
        <div class="deliverable-icon" style="background: var(--color-success-light); color: #047857;">🔓</div>
        <h4>No Lock-In Retainers</h4>
        <p style="font-size: 14px;">We work in 90-day agile performance sprints. We earn our partnership month after month through results.</p>
      </div>

      <div class="card card-sm">
        <div class="deliverable-icon" style="background: var(--color-primary-light); color: var(--color-primary);">📈</div>
        <h4>Programmatic Scale</h4>
        <p style="font-size: 14px;">Deploy hundreds of localized landing pages systematically to capture high-intent regional searches.</p>
      </div>
    </div>
  </div>
</section>

<!-- Programmatic SEO Featured Matrix / Internal Linking Engine -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Programmatic SEO Engine</div>
      <h2>Explore Localized Digital Marketing by City</h2>
      <p>Our programmatic architecture provides tailored market insights, localized pricing, and verified results for major economic hubs across India.</p>
    </div>

    <div class="grid grid-3">
      <?php 
      // Showcase top programmatic combinations
      $featuredPairs = [
          ['local-seo', 'hyderabad'],
          ['google-ads-management', 'mumbai'],
          ['ai-seo-services', 'bengaluru'],
          ['lead-generation-services', 'delhi'],
          ['ecommerce-seo', 'pune'],
          ['shopify-web-design', 'chennai'],
          ['franchise-digital-marketing', 'mumbai'],
          ['enterprise-ppc', 'bengaluru'],
          ['cro-audits', 'hyderabad']
      ];

      foreach ($featuredPairs as $pair):
        $sObj = get_service_by_slug($pair[0]);
        $cObj = get_city_by_slug($pair[1]);
        if (!$sObj || !$cObj) continue;
      ?>
        <a href="<?= service_city_url($sObj['slug'], $cObj['slug']) ?>" class="card" style="display: flex; flex-direction: column; justify-content: space-between; text-decoration: none;">
          <div>
            <div class="flex justify-between items-center" style="margin-bottom: 12px;">
              <span class="district-badge" style="background: var(--color-primary-light); color: var(--color-primary);">
                📍 <?= e($cObj['name']) ?>
              </span>
              <span style="font-size: 13px; color: var(--color-text-light); font-weight: 500;">
                <?= e($cObj['avgMonthlySearches']) ?> Searches/mo
              </span>
            </div>
            <h3 style="font-size: 18px; color: var(--color-text); margin-bottom: 6px;">
              <?= e($sObj['shortName']) ?> in <?= e($cObj['name']) ?>
            </h3>
            <p style="font-size: 14px; color: var(--color-text-muted); margin-bottom: 12px;">
              Hub: <?= e($cObj['hub'] ?? (!empty($cObj['keyDistricts']) ? implode(' & ', array_slice($cObj['keyDistricts'], 0, 2)) : $cObj['name'])) ?>
            </p>
          </div>
          <div class="flex justify-between items-center" style="border-top: 1px solid var(--color-border-subtle); padding-top: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: var(--color-primary);">View <?= e($cObj['name']) ?> Case & Pricing →</span>
            <span class="link-arrow">→</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <div style="text-align: center; margin-top: 36px;">
      <a href="<?= site_url('services') ?>" class="btn btn-ghost" style="padding: 12px 32px;">
        Browse All 36+ Service & City Combinations in Directory →
      </a>
    </div>
  </div>
</section>

<!-- Client Testimonials -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Testimonials</div>
      <h2>Real Outcomes from Real Growth Leaders</h2>
      <p>Hear how our data-driven sprints helped companies scale pipeline across tech, D2C, and industrial markets.</p>
    </div>

    <div class="grid grid-3">
      <?php foreach ($testimonials as $t): ?>
        <div class="testimonial-card">
          <div class="testimonial-stars">★★★★★</div>
          <p class="testimonial-quote">"<?= e($t['quote']) ?>"</p>
          <div class="testimonial-author">
            <div class="author-avatar"><?= substr($t['name'], 0, 1) ?></div>
            <div class="author-info">
              <h4><?= e($t['name']) ?></h4>
              <p><?= e($t['role']) ?>, <?= e($t['company']) ?></p>
              <?php if (!empty($t['result'])): ?>
                <span class="author-result-pill"><?= e($t['result']) ?></span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- General FAQ Accordion -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">FAQs</div>
      <h2>Frequently Asked Questions</h2>
      <p>Everything you need to know about partnering with Convertiplyhq.</p>
    </div>

    <div class="faq-list">
      <?php foreach ($generalFaqs as $idx => $faq): ?>
        <div class="faq-item <?= ($idx === 0) ? 'active' : '' ?>">
          <button class="faq-question" type="button" aria-expanded="<?= ($idx === 0) ? 'true' : 'false' ?>">
            <span><?= e($faq['q']) ?></span>
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p><?= e($faq['a']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- High-Converting CTA Banner -->
<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="cta-banner">
      <h2>Ready to Accelerate Your Customer Acquisition?</h2>
      <p>
        Book your free 30-minute growth roadmap session. We'll show you the exact bottlenecks holding back your pipeline and how to scale profitably.
      </p>
      <div class="cta-banner-buttons">
        <a href="<?= site_url('contact') ?>" class="btn btn-white">
          Claim Free Growth Audit →
        </a>
        <a href="tel:<?= urlencode(SITE_PHONE) ?>" class="btn btn-ghost" style="color: #ffffff; border-color: rgba(255,255,255,0.4);">
          📞 Call <?= e(SITE_PHONE) ?>
        </a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
