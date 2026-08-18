<?php
/**
 * Convertiplyhq - Global Site Header with Interactive Services Mega Menu
 */
if (!defined('CONVERTIPLY_INIT')) {
    require_once __DIR__ . '/config.php';
}

$currentScript = basename($_SERVER['SCRIPT_NAME'] ?? '');
$currentUri = $_SERVER['REQUEST_URI'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php require __DIR__ . '/seo-meta.php'; ?>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php 
$dripConfig = function_exists('get_drip_indexing_config') ? get_drip_indexing_config() : [];
$gtmId = trim($dripConfig['gtm_id'] ?? '');
if ($gtmId): ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($gtmId) ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php endif; ?>

<header class="site-header">
  <div class="container nav-container">
    <a href="<?= site_url() ?>" class="brand-logo" aria-label="Convertiplyhq Home">
      <div class="brand-icon">C</div>
      <span>Convertiply<span class="brand-accent">hq</span></span>
    </a>

    <nav aria-label="Main Navigation">
      <ul class="nav-menu" id="navMenu">
        <li>
          <a href="<?= site_url() ?>" class="nav-link <?= ($currentScript === 'index.php' && ($currentUri === '/' || $currentUri === '' || str_ends_with($currentUri, 'index.php'))) ? 'active' : '' ?>">Home</a>
        </li>
        
        <!-- Services with Interactive Mega Menu Dropdown -->
        <li class="nav-item has-dropdown">
          <a href="<?= site_url('services') ?>" class="nav-link <?= (str_contains($currentUri, 'services') || $currentScript === 'services.php') ? 'active' : '' ?>">
            <span>Services</span>
            <svg class="dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </a>

          <!-- Mega Menu Panel -->
          <div class="mega-menu" aria-label="Services Submenu">
            <div class="mega-menu-inner">
              
              <!-- Column 1: Strategy & Enterprise -->
              <div class="mega-col">
                <div class="mega-col-title">
                  <span class="mega-icon-tag">💼</span>
                  <span>Strategy & Growth</span>
                </div>
                <ul class="mega-links">
                  <li><a href="<?= site_url('services#digital-marketing-strategy') ?>">Marketing Strategy Development</a></li>
                  <li><a href="<?= site_url('services#franchise-digital-marketing') ?>">Franchise Digital Marketing</a></li>
                  <li><a href="<?= site_url('services#enterprise-digital-marketing') ?>">Enterprise Digital Marketing</a></li>
                  <li><a href="<?= site_url('services#lead-generation-services') ?>">Lead Generation Services</a></li>
                  <li><a href="<?= site_url('services#cro-audits') ?>">CRO & Conversion Audits</a></li>
                </ul>
              </div>

              <!-- Column 2: Organic Search & SEO -->
              <div class="mega-col">
                <div class="mega-col-title">
                  <span class="mega-icon-tag">🔍</span>
                  <span>SEO & Audits</span>
                </div>
                <ul class="mega-links">
                  <li><a href="<?= site_url('services#local-seo') ?>">Local Map Pack SEO</a></li>
                  <li><a href="<?= site_url('services#technical-seo') ?>">Technical SEO Services</a></li>
                  <li><a href="<?= site_url('services#ai-seo-services') ?>">AI SEO & GEO (LLM Search)</a></li>
                  <li><a href="<?= site_url('services#seo-audits') ?>">120-Point SEO Audits</a></li>
                  <li><a href="<?= site_url('services#franchise-seo') ?>">Franchise SEO</a></li>
                  <li><a href="<?= site_url('services#enterprise-seo') ?>">Enterprise SEO</a></li>
                </ul>
              </div>

              <!-- Column 3: Paid Media & PPC -->
              <div class="mega-col">
                <div class="mega-col-title">
                  <span class="mega-icon-tag">🎯</span>
                  <span>Paid Ads & SEM</span>
                </div>
                <ul class="mega-links">
                  <li><a href="<?= site_url('services#google-ads-management') ?>">Google Ads Management</a></li>
                  <li><a href="<?= site_url('services#youtube-ads-management') ?>">YouTube Video Ads</a></li>
                  <li><a href="<?= site_url('services#search-engine-marketing-sem') ?>">Search Engine Marketing (SEM)</a></li>
                  <li><a href="<?= site_url('services#programmatic-advertising') ?>">Programmatic Advertising</a></li>
                  <li><a href="<?= site_url('services#franchise-ppc') ?>">Franchise PPC</a></li>
                  <li><a href="<?= site_url('services#enterprise-ppc') ?>">Enterprise PPC</a></li>
                </ul>
              </div>

              <!-- Column 4: eCommerce & Shopify -->
              <div class="mega-col">
                <div class="mega-col-title">
                  <span class="mega-icon-tag">🛍️</span>
                  <span>eCommerce & Shopify</span>
                </div>
                <ul class="mega-links">
                  <li><a href="<?= site_url('services#shopify-seo') ?>">Shopify SEO Services</a></li>
                  <li><a href="<?= site_url('services#shopify-web-design') ?>">Shopify Web Design</a></li>
                  <li><a href="<?= site_url('services#ecommerce-web-design') ?>">eCommerce Web Design</a></li>
                  <li><a href="<?= site_url('services#ecommerce-seo') ?>">eCommerce SEO</a></li>
                  <li><a href="<?= site_url('services#ecommerce-ppc') ?>">eCommerce PPC & Shopping</a></li>
                  <li><a href="<?= site_url('services#ecommerce-optimization') ?>">eCommerce Retention</a></li>
                </ul>
              </div>

            </div>

            <!-- Mega Menu Footer Bar -->
            <div class="mega-footer">
              <div class="mega-footer-cities">
                <span style="font-weight: 700; color: var(--color-text);">📍 Top Local Hubs:</span>
                <a href="<?= service_city_url('local-seo', 'hyderabad') ?>">Hyderabad</a> ·
                <a href="<?= service_city_url('local-seo', 'bengaluru') ?>">Bengaluru</a> ·
                <a href="<?= service_city_url('local-seo', 'mumbai') ?>">Mumbai</a> ·
                <a href="<?= service_city_url('local-seo', 'delhi') ?>">Delhi NCR</a> ·
                <a href="<?= service_city_url('local-seo', 'pune') ?>">Pune</a> ·
                <a href="<?= service_city_url('local-seo', 'chennai') ?>">Chennai</a>
              </div>
              <div>
                <a href="<?= site_url('services') ?>" class="mega-all-btn">
                  Explore All 25 Services →
                </a>
              </div>
            </div>
          </div>
        </li>

        <li>
          <a href="<?= site_url('about') ?>" class="nav-link <?= ($currentScript === 'about.php' || str_contains($currentUri, 'about')) ? 'active' : '' ?>">About Us</a>
        </li>
        <li>
          <a href="<?= site_url('blog') ?>" class="nav-link <?= ($currentScript === 'blog.php' || str_contains($currentUri, 'blog')) ? 'active' : '' ?>">Insights</a>
        </li>
        <li>
          <a href="<?= site_url('contact') ?>" class="nav-link <?= ($currentScript === 'contact.php' || str_contains($currentUri, 'contact')) ? 'active' : '' ?>">Contact</a>
        </li>
      </ul>
    </nav>

    <div class="nav-actions">
      <a href="<?= site_url('contact') ?>" class="btn btn-primary btn-sm" id="headerCtaBtn">Get a Free Audit</a>
      <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation menu" aria-expanded="false">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
      </button>
    </div>
  </div>
</header>
<main id="mainContent">
