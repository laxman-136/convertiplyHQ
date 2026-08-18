<?php
/**
 * Convertiplyhq - Locations Directory (All 28 States & 500+ Indian Cities)
 */
require_once __DIR__ . '/includes/config.php';

$allCities = get_all_cities();

// Group cities by State
$citiesByState = [];
foreach ($allCities as $city) {
    $state = $city['state'] ?? 'Other';
    if (!isset($citiesByState[$state])) {
        $citiesByState[$state] = [];
    }
    $citiesByState[$state][] = $city;
}
ksort($citiesByState);

$pageSeo = [
    'title' => 'Pan-India Locations Directory (500+ Cities across 28 States) | Convertiplyhq',
    'description' => 'Explore Convertiplyhq’s complete directory of digital marketing programs available across 500+ Indian cities in all 28 States and Union Territories.',
    'canonical' => site_url('locations'),
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'Locations Directory', 'url' => site_url('locations')]
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
      <li class="breadcrumb-item active">Locations Directory</li>
    </ul>
  </div>
</div>

<!-- Page Header Hero -->
<section class="section" style="padding-bottom: 24px; background: linear-gradient(180deg, #ffffff 0%, var(--color-bg-alt) 100%);">
  <div class="container text-center" style="max-width: 840px;">
    <div class="section-tag section-tag-secondary">Pan-India Reach · 500+ Cities</div>
    <h1>Explore Growth Programs Across <span style="color: var(--color-primary);">500+ Indian Cities</span></h1>
    <p class="lead">
      We deliver data-driven performance SEO, Google Ads, and conversion engineering tailored to local business ecosystems across all 28 States and Union Territories.
    </p>
  </div>
</section>

<!-- State-by-State Matrix -->
<section class="section">
  <div class="container">
    <div class="flex flex-col gap-24">
      <?php foreach ($citiesByState as $stateName => $stateCities): ?>
        <div class="card" style="padding: 24px 28px;">
          <div class="flex justify-between items-center" style="margin-bottom: 14px; border-bottom: 1px solid var(--color-border); padding-bottom: 10px;">
            <h3 style="font-size: 18px; margin-bottom: 0; color: var(--color-text);">
              🏛️ <?= e($stateName) ?>
            </h3>
            <span class="badge" style="background: var(--color-bg-alt); color: var(--color-text-muted); font-size: 12px; font-weight: 600; padding: 3px 8px; border-radius: var(--radius-pill);">
              <?= count($stateCities) ?> City Hubs
            </span>
          </div>

          <div class="flex gap-8" style="flex-wrap: wrap;">
            <?php foreach ($stateCities as $sc): ?>
              <a href="<?= service_city_url('local-seo', $sc['slug']) ?>" class="district-badge" style="font-size: 12px; padding: 4px 10px;" title="Digital Marketing in <?= e($sc['name']) ?>">
                <?= e($sc['name']) ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section section-alt">
  <div class="container">
    <div class="cta-banner">
      <h2>Need a Multi-Location Growth Strategy?</h2>
      <p>
        Scale your organic pipeline, paid campaigns, and local map pack rankings across India with our engineering team.
      </p>
      <div class="cta-banner-buttons">
        <a href="<?= site_url('contact') ?>" class="btn btn-white">
          Get Started Today →
        </a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
