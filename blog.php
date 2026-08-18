<?php
/**
 * Convertiplyhq - Blog & Resource Center
 */
require_once __DIR__ . '/includes/config.php';

$posts = get_data('blog-posts.json');

$pageSeo = [
    'title' => 'Growth Marketing Insights & Frameworks | Convertiplyhq Blog',
    'description' => 'Tactical guides on Programmatic SEO, Google Ads optimization, CRO principles, and performance marketing frameworks for B2B and high-growth brands.',
    'canonical' => site_url('blog'),
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'Insights', 'url' => site_url('blog')]
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
      <li class="breadcrumb-item active">Growth Insights</li>
    </ul>
  </div>
</div>

<!-- Header -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">Field-Tested Insights</div>
      <h1>Growth Engineering & Marketing Guides</h1>
      <p class="lead">
        In-depth playbooks on technical SEO, programmatic page generation, high-ROAS paid media, and landing page conversion psychology.
      </p>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-3">
      <?php foreach ($posts as $post): ?>
        <article class="card" style="display: flex; flex-direction: column; height: 100%;">
          <div class="flex justify-between items-center" style="margin-bottom: 12px;">
            <span class="section-tag section-tag-secondary" style="font-size: 11px; margin-bottom: 0;">
              <?= e($post['category']) ?>
            </span>
            <span style="font-size: 12px; color: var(--color-text-light);">
              ⏱️ <?= e($post['readTime']) ?>
            </span>
          </div>

          <h2 style="font-size: 20px; line-height: 28px; margin-bottom: 12px;">
            <a href="<?= blog_url($post['slug']) ?>" style="color: var(--color-text);">
              <?= e($post['title']) ?>
            </a>
          </h2>

          <p style="font-size: 14px; color: var(--color-text-muted); margin-bottom: 20px; flex-grow: 1;">
            <?= e($post['excerpt']) ?>
          </p>

          <div style="padding-top: 14px; border-top: 1px solid var(--color-border-subtle); display: flex; justify-content: space-between; align-items: center;">
            <div style="font-size: 12px; color: var(--color-text-light);">
              By <strong><?= e($post['author']['name']) ?></strong> · <?= date('M j, Y', strtotime($post['date'])) ?>
            </div>
            <a href="<?= blog_url($post['slug']) ?>" style="font-weight: 600; font-size: 13px;">Read Article →</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Bottom CTA -->
<section class="section section-alt">
  <div class="container">
    <div class="cta-banner">
      <h2>Want These Growth Strategies Applied to Your Brand?</h2>
      <p>Book a free 30-minute growth diagnostic session with our technical marketing team.</p>
      <div class="cta-banner-buttons">
        <a href="<?= site_url('contact') ?>" class="btn btn-white">Claim Free Growth Audit →</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
