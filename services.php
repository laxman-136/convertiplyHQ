<?php
/**
 * Convertiplyhq - Core Services & Capabilities Catalog
 * Premium UI with Interactive Category Filtering and Direct Dedicated Page Links.
 */
require_once __DIR__ . '/includes/config.php';

$allServices = get_all_services();
$categories = get_service_categories();

$pageSeo = [
    'title' => 'Digital Marketing Services Directory (All 25 Core Capabilities) | Convertiplyhq',
    'description' => 'Browse Convertiplyhq’s 25 specialized performance marketing services: Technical SEO, Google Ads, AI SEO, Paid Media, CRO Audits, and eCommerce Web Design.',
    'canonical' => site_url('services'),
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'Services Directory', 'url' => site_url('services')]
    ]
];

require __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumbs -->
<div class="breadcrumb-wrap">
  <div class="container">
    <ul class="breadcrumb-list">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
      <li class="breadcrumb-separator">/</li>
      <li class="breadcrumb-item active">Services Directory</li>
    </ul>
  </div>
</div>

<!-- Hero Section -->
<section class="section" style="padding-bottom: 28px; background: linear-gradient(180deg, #ffffff 0%, var(--color-bg-alt) 100%);">
  <div class="container text-center" style="max-width: 900px;">
    <div class="section-tag section-tag-secondary">25 Specialized Growth Capabilities</div>
    <h1 style="font-size: 38px; line-height: 1.25; margin-bottom: 16px;">
      Performance Digital Marketing <span style="color: var(--color-primary);">Services & Disciplines</span>
    </h1>
    <p class="lead" style="font-size: 17px; max-width: 760px; margin: 0 auto 28px auto;">
      We eliminate agency bloat with engineering rigor. Explore our 25 data-driven growth capabilities—from sub-second Technical SEO and Generative Engine Optimization (GEO) to high-ROAS Paid Search and eCommerce Web Architecture.
    </p>

    <!-- Interactive Category Filter Tabs -->
    <div class="services-filter-nav">
      <button type="button" class="service-filter-btn active" data-filter="all">
        <span>⚡ All Capabilities</span>
        <span class="tab-count">25</span>
      </button>
      <button type="button" class="service-filter-btn" data-filter="strategy">
        <span>💼 Strategy & Enterprise</span>
        <span class="tab-count">5</span>
      </button>
      <button type="button" class="service-filter-btn" data-filter="seo">
        <span>🔍 Search & AI SEO</span>
        <span class="tab-count">8</span>
      </button>
      <button type="button" class="service-filter-btn" data-filter="sem">
        <span>🎯 Paid Ads & SEM</span>
        <span class="tab-count">6</span>
      </button>
      <button type="button" class="service-filter-btn" data-filter="ecommerce">
        <span>🛍️ eCommerce & Shopify</span>
        <span class="tab-count">6</span>
      </button>
    </div>
  </div>
</section>

<!-- Trust & Benchmarks Bar -->
<section class="trust-strip" style="background: #ffffff;">
  <div class="container">
    <div class="grid grid-4" style="text-align: center; gap: 20px;">
      <div>
        <div style="font-size: 30px; font-weight: 800; color: var(--color-primary);">25</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Specialized Disciplines</div>
      </div>
      <div>
        <div style="font-size: 30px; font-weight: 800; color: var(--color-primary);">4.8x</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Average Blended ROAS</div>
      </div>
      <div>
        <div style="font-size: 30px; font-weight: 800; color: var(--color-primary);">100%</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Attribution Transparency</div>
      </div>
      <div>
        <div style="font-size: 30px; font-weight: 800; color: var(--color-primary);">95+</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Core Web Vitals Scores</div>
      </div>
    </div>
  </div>
</section>

<!-- Main Services Cards Grid -->
<section class="section" style="padding-top: 56px;">
  <div class="container">
    <div class="grid grid-2" id="servicesGrid" style="gap: 32px;">
      <?php 
      $globalIdx = 0;
      foreach ($allServices as $s): 
        $globalIdx++;
        
        // Map category key for filter
        $catName = $s['category'] ?? 'Digital Marketing';
        $catKey = 'strategy';
        if (str_contains(strtolower($catName), 'seo') || str_contains(strtolower($s['slug']), 'seo') || str_contains(strtolower($s['slug']), 'audit')) {
          $catKey = 'seo';
        } elseif (str_contains(strtolower($catName), 'sem') || str_contains(strtolower($s['slug']), 'ppc') || str_contains(strtolower($s['slug']), 'ads')) {
          $catKey = 'sem';
        } elseif (str_contains(strtolower($catName), 'ecommerce') || str_contains(strtolower($s['slug']), 'shopify') || str_contains(strtolower($s['slug']), 'web-design')) {
          $catKey = 'ecommerce';
        }

        // Category-specific emoji icon
        $icon = '⚡';
        if ($catKey === 'seo') $icon = '🔍';
        elseif ($catKey === 'sem') $icon = '🎯';
        elseif ($catKey === 'ecommerce') $icon = '🛍️';
        elseif ($catKey === 'strategy') $icon = '💼';
      ?>
        <div class="service-card-pro" data-category="<?= e($catKey) ?>" id="<?= e($s['slug']) ?>" style="scroll-margin-top: 100px;">
          <div>
            
            <!-- Top Header & Badges -->
            <div class="service-card-top">
              <span class="service-badge-cat"><?= e($s['category'] ?? 'Growth Discipline') ?></span>
              <span class="service-index-tag">0<?= $globalIdx ?> / 25</span>
            </div>

            <!-- Icon & Title -->
            <div class="flex items-center gap-16" style="margin-bottom: 12px;">
              <div class="service-icon-box" style="margin-bottom: 0;">
                <?= $icon ?>
              </div>
              <div>
                <h3 class="service-card-title" style="margin-bottom: 0;">
                  <a href="<?= service_url($s['slug']) ?>">
                    <?= e($s['name']) ?>
                  </a>
                </h3>
              </div>
            </div>

            <!-- Summary Description -->
            <p class="service-card-desc">
              <?= e($s['shortDesc']) ?>
            </p>

            <!-- Key Deliverables Box -->
            <div class="deliverables-box">
              <div class="deliverables-box-title">Key Deliverables Included:</div>
              <ul class="deliverables-list">
                <?php foreach (array_slice($s['deliverables'] ?? [], 0, 4) as $del): ?>
                  <li>
                    <span class="check-icon">✓</span>
                    <div>
                      <strong><?= e($del['title']) ?></strong>
                      <span style="font-size: 12px; color: var(--color-text-muted); display: block;"><?= e($del['desc'] ?? '') ?></span>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

          </div>

          <!-- Bottom Action Buttons -->
          <div class="service-card-footer">
            <a href="<?= service_url($s['slug']) ?>" class="btn btn-primary btn-sm" style="padding: 10px 20px; font-weight: 600;">
              View Full <?= e($s['shortName']) ?> Page →
            </a>
            <a href="<?= site_url('contact?service=' . urlencode($s['slug'])) ?>" class="btn btn-ghost btn-sm" style="padding: 10px 18px;">
              Get Proposal
            </a>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Locations Directory Banner -->
<section class="section section-alt" style="padding: 48px 0;">
  <div class="container">
    <div class="card" style="padding: 36px 44px; background: linear-gradient(135deg, #f8faff 0%, #edf2ff 100%); border-color: #cbd8ff;">
      <div class="flex justify-between items-center" style="flex-wrap: wrap; gap: 24px;">
        <div style="max-width: 620px;">
          <div class="section-tag section-tag-secondary" style="font-size: 11px; margin-bottom: 6px;">Pan-India Coverage</div>
          <h3 style="font-size: 24px; margin-bottom: 6px;">Looking for Local City Campaigns?</h3>
          <p style="font-size: 14.5px; color: var(--color-text-muted); margin-bottom: 0; line-height: 1.6;">
            All 25 services are available with localized market data, pricing benchmarks, and dedicated case studies across 500+ Indian cities in all 28 States & Union Territories.
          </p>
        </div>
        <div>
          <a href="<?= site_url('locations') ?>" class="btn btn-primary" style="padding: 14px 28px;">
            Explore 500+ Locations Directory →
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4-Stage Operating System -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Engineering Framework</div>
      <h2>Our 4-Stage Growth Operating System</h2>
      <p>A battle-tested methodology designed for predictable, compounding revenue acceleration.</p>
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

<!-- Closing CTA Banner -->
<section class="section section-alt">
  <div class="container">
    <div class="cta-banner">
      <h2>Ready to Build a High-Performing Growth Engine?</h2>
      <p>
        Speak directly with our senior growth architects. We will audit your current channels and deliver a clear 90-day execution roadmap.
      </p>
      <div class="cta-banner-buttons">
        <a href="<?= site_url('contact') ?>" class="btn btn-white">
          Claim Free Strategy Audit →
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Client-side Interactive Filter Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const filterBtns = document.querySelectorAll('.service-filter-btn');
  const serviceCards = document.querySelectorAll('.service-card-pro');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');

      serviceCards.forEach(card => {
        const cat = card.getAttribute('data-category');
        if (filter === 'all' || cat === filter) {
          card.style.display = 'flex';
          card.style.animation = 'fadeIn 0.3s ease';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
