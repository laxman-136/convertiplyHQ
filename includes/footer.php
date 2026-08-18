<?php
/**
 * Convertiplyhq - Global Site Footer
 * Upgraded, well-balanced 5-column layout with pre-footer audit bar.
 */
if (!defined('CONVERTIPLY_INIT')) {
    require_once __DIR__ . '/config.php';
}

$allCities = get_all_cities();
?>
</main>

<footer class="site-footer">
  <div class="container">
    
    <!-- Pre-Footer Quick Growth Bar -->
    <div class="pre-footer">
      <div class="pre-footer-grid">
        <div>
          <div class="section-tag section-tag-secondary" style="font-size: 11px; margin-bottom: 6px;">Instant Audit</div>
          <h3>Ready to Scale Your Inbound Revenue?</h3>
          <p>Get a confidential diagnostic of your search rankings, ad efficiency, and conversion funnels.</p>
        </div>
        <form action="<?= site_url('contact') ?>" method="GET" class="pre-footer-form">
          <input type="text" name="website" class="form-control" placeholder="Enter your website..." required>
          <button type="submit" class="btn btn-primary" style="white-space: nowrap; padding: 12px 24px;">
            Get Free Audit →
          </button>
        </form>
      </div>
    </div>

    <!-- Main 5-Column Grid -->
    <div class="footer-grid">
      
      <!-- Column 1: Brand & Contact Info -->
      <div class="footer-brand">
        <a href="<?= site_url() ?>" class="brand-logo" aria-label="Convertiplyhq Home">
          <div class="brand-icon">C</div>
          <span>Convertiply<span class="brand-accent">hq</span></span>
        </a>
        <p>
          Engineering-first performance marketing agency scaling B2B and high-growth brands through technical SEO, paid media, and conversion architecture.
        </p>

        <div class="footer-contact-list">
          <div class="footer-contact-item">
            <span>📍</span>
            <span>Level 4, Cyber Towers, HITEC City, Hyderabad, 500081</span>
          </div>
          <div class="footer-contact-item">
            <span>📞</span>
            <a href="tel:<?= urlencode(SITE_PHONE) ?>" style="color: var(--color-text); font-weight: 600;"><?= e(SITE_PHONE) ?></a>
          </div>
          <div class="footer-contact-item">
            <span>✉️</span>
            <a href="mailto:<?= e(SITE_EMAIL) ?>" style="color: var(--color-primary); font-weight: 600;"><?= e(SITE_EMAIL) ?></a>
          </div>
        </div>

        <div class="footer-social-row">
          <a href="https://linkedin.com/company/convertiplyhq" class="social-btn" target="_blank" rel="noopener" aria-label="LinkedIn">in</a>
          <a href="https://twitter.com/convertiplyhq" class="social-btn" target="_blank" rel="noopener" aria-label="Twitter / X">𝕏</a>
          <a href="https://youtube.com/@convertiplyhq" class="social-btn" target="_blank" rel="noopener" aria-label="YouTube">▶</a>
          <a href="https://instagram.com/convertiplyhq" class="social-btn" target="_blank" rel="noopener" aria-label="Instagram">📸</a>
        </div>
      </div>

      <!-- Column 2: Strategy & Enterprise -->
      <div class="footer-col">
        <h4>Strategy & Growth</h4>
        <ul class="footer-links">
          <li><a href="<?= site_url('services#digital-marketing-strategy') ?>">Marketing Strategy</a></li>
          <li><a href="<?= site_url('services#franchise-digital-marketing') ?>">Franchise Marketing</a></li>
          <li><a href="<?= site_url('services#enterprise-digital-marketing') ?>">Enterprise Marketing</a></li>
          <li><a href="<?= site_url('services#lead-generation-services') ?>">Lead Generation</a></li>
          <li><a href="<?= site_url('services#cro-audits') ?>">CRO & Funnel Audits</a></li>
          <li><a href="<?= site_url('services#ecommerce-optimization') ?>">eCommerce Retention</a></li>
        </ul>
      </div>

      <!-- Column 3: Organic & Technical SEO -->
      <div class="footer-col">
        <h4>SEO & Audits</h4>
        <ul class="footer-links">
          <li><a href="<?= site_url('services#local-seo') ?>">Local Map Pack SEO</a></li>
          <li><a href="<?= site_url('services#technical-seo') ?>">Technical SEO</a></li>
          <li><a href="<?= site_url('services#ai-seo-services') ?>">AI SEO & GEO (LLMs)</a></li>
          <li><a href="<?= site_url('services#seo-audits') ?>">120-Point SEO Audits</a></li>
          <li><a href="<?= site_url('services#ecommerce-seo') ?>">eCommerce SEO</a></li>
          <li><a href="<?= site_url('services#shopify-seo') ?>">Shopify SEO</a></li>
        </ul>
      </div>

      <!-- Column 4: Paid Media & PPC -->
      <div class="footer-col">
        <h4>Paid Ads & SEM</h4>
        <ul class="footer-links">
          <li><a href="<?= site_url('services#google-ads-management') ?>">Google Ads (PPC)</a></li>
          <li><a href="<?= site_url('services#youtube-ads-management') ?>">YouTube Video Ads</a></li>
          <li><a href="<?= site_url('services#programmatic-advertising') ?>">Programmatic Ads</a></li>
          <li><a href="<?= site_url('services#franchise-ppc') ?>">Franchise PPC</a></li>
          <li><a href="<?= site_url('services#enterprise-ppc') ?>">Enterprise PPC</a></li>
          <li><a href="<?= site_url('services#ecommerce-ppc') ?>">eCommerce Google Shopping</a></li>
        </ul>
      </div>

      <!-- Column 5: Hubs & Company -->
      <div class="footer-col">
        <h4>Hubs & Company</h4>
        <ul class="footer-links">
          <?php foreach (array_slice($allCities, 0, 6) as $c): ?>
            <li>
              <a href="<?= service_city_url('local-seo', $c['slug']) ?>">
                📍 <?= e($c['name']) ?> Hub
              </a>
            </li>
          <?php endforeach; ?>
          <li style="margin-top: 4px;">
            <a href="<?= site_url('locations') ?>" style="color: var(--color-primary); font-weight: 700;">
              View 500+ Locations Directory →
            </a>
          </li>
          <li style="margin-top: 8px; border-top: 1px solid var(--color-border-subtle); padding-top: 8px;">
            <a href="<?= site_url('services') ?>">All Services Directory</a>
          </li>
          <li><a href="<?= site_url('about') ?>">About Convertiplyhq</a></li>
          <li><a href="<?= site_url('blog') ?>">Insights & Playbooks</a></li>
          <li><a href="<?= site_url('sitemap.php') ?>" target="_blank">XML Sitemap</a></li>
        </ul>
      </div>

    </div>

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom">
      <div>
        © <?= date('Y') ?> Convertiplyhq Digital Private Limited. All rights reserved.
      </div>
      
      <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
        <span class="footer-badge-pill">🔒 100% White-Hat & Attribution-First</span>
        <span class="footer-badge-pill">⚡ Plain PHP 8+ PSEO Architecture</span>
      </div>

      <div>
        <a href="#mainContent" style="color: var(--color-primary); font-weight: 600; font-size: 13px;">↑ Back to Top</a>
      </div>
    </div>

  </div>
</footer>

<script src="/assets/js/main.js"></script>
</body>
</html>
