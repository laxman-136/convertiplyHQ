<?php
/**
 * Convertiplyhq - About Us Page
 */
require_once __DIR__ . '/includes/config.php';

$pageSeo = [
    'title' => 'About Convertiplyhq | Data-Driven Growth Marketing Agency',
    'description' => 'Learn how Convertiplyhq combines technical SEO engineering, high-performance paid media, and conversion architecture to drive scalable customer acquisition.',
    'canonical' => site_url('about'),
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'About Us', 'url' => site_url('about')]
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
      <li class="breadcrumb-item active">About Convertiplyhq</li>
    </ul>
  </div>
</div>

<!-- Hero Section -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag section-tag-secondary">Our Mission</div>
      <h1>We Replaced Marketing Fluff with <span style="color: var(--color-primary);">Growth Engineering</span></h1>
      <p class="lead">
        Convertiplyhq was founded on a simple premise: marketing should be as measurable, predictable, and rigorous as software engineering.
      </p>
    </div>

    <div class="grid grid-2" style="gap: 48px; align-items: center;">
      <div>
        <h2>Built for Companies That Value Real Revenue Over Vanity Metrics</h2>
        <p>
          Traditional marketing agencies thrive on vague retainers, opaque reports, and vanity metrics like impressions and social clicks. We built Convertiplyhq to be the exact opposite.
        </p>
        <p>
          Headquartered in Hyderabad's HITEC City tech corridor with hubs across Bengaluru, Mumbai, and Delhi NCR, our squad of data analysts, performance media buyers, and technical SEO engineers operate as an agile extension of your growth team.
        </p>
        <div class="flex gap-16" style="margin-top: 24px;">
          <a href="<?= site_url('contact') ?>" class="btn btn-primary">Partner With Us</a>
          <a href="<?= site_url('services') ?>" class="btn btn-ghost">Our Capabilities</a>
        </div>
      </div>

      <div class="card" style="background: var(--color-bg-alt);">
        <h3 style="margin-bottom: 20px;">By The Numbers</h3>
        <div class="grid grid-2" style="gap: 16px;">
          <div class="local-stat-cell" style="background: #ffffff;">
            <div class="local-stat-value">₹45Cr+</div>
            <div class="local-stat-label">Client Revenue Tracked</div>
          </div>
          <div class="local-stat-cell" style="background: #ffffff;">
            <div class="local-stat-value">4.8x</div>
            <div class="local-stat-label">Average Blended ROAS</div>
          </div>
          <div class="local-stat-cell" style="background: #ffffff;">
            <div class="local-stat-value">140+</div>
            <div class="local-stat-label">Successful Sprints</div>
          </div>
          <div class="local-stat-cell" style="background: #ffffff;">
            <div class="local-stat-value">98.4%</div>
            <div class="local-stat-label">Client Retention Rate</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4-Step Methodology -->
<section class="section section-alt">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">How We Work</div>
      <h2>Our 4-Step Growth Operating System</h2>
      <p>A battle-tested framework engineered to eliminate guesswork and maximize ROI.</p>
    </div>

    <div class="grid grid-4">
      <div class="card deliverable-card">
        <div class="deliverable-icon">01</div>
        <h3>Deep Diagnostic Audit</h3>
        <p>We dissect your existing search rankings, ad accounts, analytics telemetry, and landing pages to identify conversion leaks.</p>
      </div>

      <div class="card deliverable-card">
        <div class="deliverable-icon" style="background: var(--color-secondary-light); color: #92400e;">02</div>
        <h3>Strategy & Architecture</h3>
        <p>We design custom keyword clusters, high-converting offer funnels, and precision media buying structures with clear ROI milestones.</p>
      </div>

      <div class="card deliverable-card">
        <div class="deliverable-icon" style="background: var(--color-success-light); color: #065f46;">03</div>
        <h3>Agile Weekly Sprints</h3>
        <p>Rapid execution of technical fixes, creative asset testing, editorial backlinks, and landing page A/B tests.</p>
      </div>

      <div class="card deliverable-card">
        <div class="deliverable-icon">04</div>
        <h3>Attribution & Scale</h3>
        <p>Live GA4 & CRM revenue attribution dashboards so you know exactly which dollar produced which customer.</p>
      </div>
    </div>
  </div>
</section>

<!-- Leadership / Core Principles -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Core Principles</div>
      <h2>The Standard We Hold Ourselves To</h2>
      <p>Principles that guide every campaign, sprint, and client interaction.</p>
    </div>

    <div class="grid grid-3">
      <div class="card">
        <h3 style="font-size: 19px;">1. Absolute Attribution Truth</h3>
        <p style="font-size: 14px;">We configure server-side tracking and offline CRM imports. No claiming credit for organic brand searches or false attribution.</p>
      </div>
      <div class="card">
        <h3 style="font-size: 19px;">2. Zero Thin Content</h3>
        <p style="font-size: 14px;">Whether programmatic SEO or thought leadership, every page we publish carries real data, verified facts, and authentic value.</p>
      </div>
      <div class="card">
        <h3 style="font-size: 19px;">3. Speed as a Feature</h3>
        <p style="font-size: 14px;">From campaign turnaround times to sub-second website page loads, speed is our competitive advantage.</p>
      </div>
    </div>
  </div>
</section>

<!-- Bottom CTA -->
<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="cta-banner">
      <h2>Let's Engineer Your Growth Engine</h2>
      <p>Schedule your free 30-minute growth roadmap session with our senior strategy team.</p>
      <div class="cta-banner-buttons">
        <a href="<?= site_url('contact') ?>" class="btn btn-white">Get in Touch Today →</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
