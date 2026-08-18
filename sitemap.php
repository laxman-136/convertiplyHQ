<?php
/**
 * Convertiplyhq - Dynamic XML Sitemap Generator
 * Loops through static pages, blog articles, and all programmatic service × city pages.
 */
require_once __DIR__ . '/includes/config.php';

header('Content-Type: application/xml; charset=utf-8');

$baseUrl = rtrim(get_base_url(), '/');
$allServices = get_all_services();
$allCities = get_all_cities();
$blogPosts = get_data('blog-posts.json');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

  <!-- Core Static Pages -->
  <url>
    <loc><?= e($baseUrl) ?>/</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc><?= e($baseUrl) ?>/services</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc><?= e($baseUrl) ?>/about</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc><?= e($baseUrl) ?>/blog</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc><?= e($baseUrl) ?>/contact</loc>
    <lastmod><?= date('Y-m-d') ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Blog Posts -->
  <?php foreach ($blogPosts as $post): ?>
  <url>
    <loc><?= e(blog_url($post['slug'])) ?></loc>
    <lastmod><?= e($post['date']) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <?php endforeach; ?>

  <!-- Programmatic Service × City Landing Pages (Only genuinely INDEXABLE pages) -->
  <?php foreach ($allServices as $service): ?>
    <?php foreach ($allCities as $city): ?>
      <?php if (is_page_indexable($service['slug'], $city['slug'])): ?>
      <url>
        <loc><?= e(service_city_url($service['slug'], $city['slug'])) ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.85</priority>
      </url>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endforeach; ?>

</urlset>
