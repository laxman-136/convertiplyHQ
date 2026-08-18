<?php
/**
 * Convertiplyhq - Single Blog Post Template
 */
require_once __DIR__ . '/includes/config.php';

$slug = $slug ?? ($_GET['slug'] ?? '');
$posts = get_data('blog-posts.json');

$post = null;
foreach ($posts as $p) {
    if ($p['slug'] === $slug) {
        $post = $p;
        break;
    }
}

// Fallback to first post if invalid slug
if (!$post && !empty($posts)) {
    $post = $posts[0];
}

$relatedService = !empty($post['relatedService']) ? get_service_by_slug($post['relatedService']) : get_all_services()[0];

$pageSeo = [
    'title' => $post['title'] . ' | Convertiplyhq Insights',
    'description' => $post['excerpt'],
    'canonical' => blog_url($post['slug']),
    'ogType' => 'article',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'Insights', 'url' => site_url('blog')],
        ['name' => $post['title'], 'url' => blog_url($post['slug'])]
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
      <li class="breadcrumb-item"><a href="<?= site_url('blog') ?>">Insights</a></li>
      <li class="breadcrumb-separator">/</li>
      <li class="breadcrumb-item active"><?= e($post['title']) ?></li>
    </ul>
  </div>
</div>

<article class="section" style="padding-top: 48px;">
  <div class="container" style="max-width: 880px;">
    <!-- Article Header -->
    <div style="margin-bottom: 32px;">
      <span class="section-tag section-tag-secondary"><?= e($post['category']) ?></span>
      <h1 style="font-size: 36px; line-height: 44px; margin: 12px 0 16px 0;">
        <?= e($post['title']) ?>
      </h1>
      
      <div class="flex items-center gap-16" style="font-size: 14px; color: var(--color-text-light); border-bottom: 1px solid var(--color-border); padding-bottom: 20px;">
        <span>✍️ By <strong><?= e($post['author']['name']) ?></strong> (<?= e($post['author']['role']) ?>)</span>
        <span>📅 Published <?= date('F j, Y', strtotime($post['date'])) ?></span>
        <span>⏱️ <?= e($post['readTime']) ?></span>
      </div>
    </div>

    <!-- Article Content -->
    <div class="article-body" style="font-size: 17px; line-height: 1.8; color: var(--color-text);">
      <p class="lead" style="font-weight: 500; margin-bottom: 28px;">
        <?= e($post['excerpt']) ?>
      </p>

      <?php foreach ($post['content'] as $block): ?>
        <?php if ($block['type'] === 'heading'): ?>
          <h2 style="font-size: 24px; margin-top: 36px; margin-bottom: 14px; color: var(--color-text);">
            <?= e($block['text']) ?>
          </h2>
        <?php elseif ($block['type'] === 'paragraph'): ?>
          <p style="margin-bottom: 20px;">
            <?= e($block['text']) ?>
          </p>
        <?php elseif ($block['type'] === 'callout'): ?>
          <div style="background: var(--color-bg-alt); border-left: 4px solid var(--color-primary); padding: 20px 24px; border-radius: 0 var(--radius-md) var(--radius-md) 0; margin: 28px 0; font-weight: 500;">
            💡 <?= e($block['text']) ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- Internal Linking Box to Service & City Pages -->
    <div class="card" style="margin-top: 48px; background: linear-gradient(180deg, #ffffff 0%, var(--color-bg-alt) 100%); padding: 32px 36px;">
      <div class="section-tag section-tag-secondary">Related Growth Hubs</div>
      <h3 style="font-size: 22px; margin-bottom: 8px;">Need Expert Help Implementing <?= e($relatedService['shortName']) ?>?</h3>
      <p style="font-size: 14px; color: var(--color-text-muted); margin-bottom: 20px;">
        Convertiplyhq designs custom, data-driven <?= strtolower(e($relatedService['shortName'])) ?> campaigns across major commercial hubs in India:
      </p>
      
      <div class="grid grid-3" style="gap: 12px; margin-bottom: 20px;">
        <?php 
        $metroSlugs = ['hyderabad', 'bengaluru', 'mumbai', 'delhi', 'pune', 'chennai'];
        foreach ($metroSlugs as $mSlug): 
          $mCity = get_city_by_slug($mSlug);
          if (!$mCity) continue;
        ?>
          <a href="<?= service_city_url($relatedService['slug'], $mCity['slug']) ?>" class="district-badge" style="justify-content: space-between; padding: 8px 14px; font-size: 13.5px;">
            <span>📍 <?= e($mCity['name']) ?> Hub</span>
            <span>→</span>
          </a>
        <?php endforeach; ?>
      </div>

      <div class="flex justify-between items-center" style="border-top: 1px solid var(--color-border-subtle); padding-top: 16px; flex-wrap: wrap; gap: 12px;">
        <a href="<?= service_url($relatedService['slug']) ?>" class="btn btn-primary btn-sm">
          View Full <?= e($relatedService['shortName']) ?> Discipline →
        </a>
        <a href="<?= site_url('locations') ?>" style="font-size: 13px; font-weight: 700; color: var(--color-primary); text-decoration: none;">
          Explore All 500+ Indian Cities in Directory →
        </a>
      </div>
    </div>
  </div>
</article>

<?php require __DIR__ . '/includes/footer.php'; ?>
