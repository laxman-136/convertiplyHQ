<?php
/**
 * Convertiplyhq - Dynamic SEO & Schema Markup Generator
 * Generates valid HTML5 meta tags, Canonical links, OpenGraph, and JSON-LD structured data.
 */

if (!defined('CONVERTIPLY_INIT')) {
    require_once __DIR__ . '/config.php';
}

/**
 * Standardize SEO parameters
 * @var array $pageSeo
 */
$pageSeo = $pageSeo ?? [];

$metaTitle = $pageSeo['title'] ?? (SITE_NAME . ' | Data-Driven Digital Marketing Agency');
$metaDescription = $pageSeo['description'] ?? 'Convertiplyhq is a premier performance marketing agency specializing in SEO, Google Ads, Social Media Marketing, Web Design, and Growth Engineering.';
$canonicalUrl = $pageSeo['canonical'] ?? get_base_url() . ($_SERVER['REQUEST_URI'] ?? '');
$ogType = $pageSeo['ogType'] ?? 'website';
$ogImage = $pageSeo['ogImage'] ?? site_url('assets/img/convertiplyhq-og.png');
$breadcrumbs = $pageSeo['breadcrumbs'] ?? [];
$faqsForSchema = $pageSeo['faqs'] ?? [];
$serviceSchemaData = $pageSeo['serviceData'] ?? null;
$citySchemaData = $pageSeo['cityData'] ?? null;
$siteData = get_data('pages.json')['site'] ?? [];
$robotsMeta = $pageSeo['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
?>
<!-- Primary SEO Meta Tags -->
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDescription) ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="<?= e($robotsMeta) ?>">
<link rel="canonical" href="<?= e($canonicalUrl) ?>">

<!-- Open Graph / Facebook / LinkedIn -->
<meta property="og:type" content="<?= e($ogType) ?>">
<meta property="og:url" content="<?= e($canonicalUrl) ?>">
<meta property="og:title" content="<?= e($metaTitle) ?>">
<meta property="og:description" content="<?= e($metaDescription) ?>">
<meta property="og:image" content="<?= e($ogImage) ?>">
<meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
<meta property="og:locale" content="en_IN">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?= e($canonicalUrl) ?>">
<meta name="twitter:title" content="<?= e($metaTitle) ?>">
<meta name="twitter:description" content="<?= e($metaDescription) ?>">
<meta name="twitter:image" content="<?= e($ogImage) ?>">

<!-- Favicon & Brand Icons -->
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='24' fill='%23194cff'/><path d='M25 68 L48 28 L72 68' stroke='%23ffffff' stroke-width='10' stroke-linecap='round' stroke-linejoin='round' fill='none'/><circle cx='58' cy='46' r='7' fill='%23fc9c03'/></svg>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Structured Data: Organization & LocalBusiness -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MarketingAgency",
  "name": "<?= e(SITE_NAME) ?>",
  "url": "<?= e(get_base_url()) ?>",
  "logo": "<?= e(site_url('assets/img/logo.svg')) ?>",
  "description": "Data-driven performance marketing and programmatic growth engineering agency.",
  "email": "<?= e(SITE_EMAIL) ?>",
  "telephone": "<?= e(SITE_PHONE) ?>",
  "priceRange": "₹₹ - ₹₹₹",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Level 4, Cyber Towers, HITEC City",
    "addressLocality": "<?= e($citySchemaData['name'] ?? 'Hyderabad') ?>",
    "addressRegion": "<?= e($citySchemaData['state'] ?? 'Telangana') ?>",
    "postalCode": "500081",
    "addressCountry": "IN"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?= e($siteData['aggregateRating']['ratingValue'] ?? '4.9') ?>",
    "reviewCount": "<?= e($siteData['aggregateRating']['reviewCount'] ?? '148') ?>",
    "bestRating": "5"
  },
  "sameAs": [
    "<?= e($siteData['social']['linkedin'] ?? '') ?>",
    "<?= e($siteData['social']['twitter'] ?? '') ?>",
    "<?= e($siteData['social']['instagram'] ?? '') ?>",
    "<?= e($siteData['social']['youtube'] ?? '') ?>"
  ]
}
</script>

<?php if (!empty($breadcrumbs)): ?>
<!-- Structured Data: BreadcrumbList -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    <?php 
    $bCount = count($breadcrumbs);
    $bIndex = 1;
    foreach ($breadcrumbs as $item): ?>
    {
      "@type": "ListItem",
      "position": <?= $bIndex ?>,
      "name": "<?= e($item['name']) ?>",
      "item": "<?= e($item['url']) ?>"
    }<?= ($bIndex < $bCount) ? ',' : '' ?>
    <?php $bIndex++; endforeach; ?>
  ]
}
</script>
<?php endif; ?>

<?php if ($serviceSchemaData): ?>
<!-- Structured Data: Service Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "serviceType": "<?= e($serviceSchemaData['name']) ?>",
  "provider": {
    "@type": "MarketingAgency",
    "name": "<?= e(SITE_NAME) ?>",
    "url": "<?= e(get_base_url()) ?>"
  },
  "areaServed": {
    "@type": "City",
    "name": "<?= e($citySchemaData['name'] ?? 'India') ?>"
  },
  "description": "<?= e($serviceSchemaData['shortDesc'] ?? '') ?>",
  "offers": {
    "@type": "AggregateOffer",
    "priceCurrency": "INR",
    "lowPrice": "30000",
    "highPrice": "150000",
    "offerCount": "3"
  }
}
</script>
<?php endif; ?>

<?php if (!empty($faqsForSchema)): ?>
<!-- Structured Data: FAQPage Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php 
    $faqCount = count($faqsForSchema);
    $fIdx = 0;
    foreach ($faqsForSchema as $faq): 
      $fIdx++;
    ?>
    {
      "@type": "Question",
      "name": <?= json_encode($faq['q']) ?>,
      "acceptedAnswer": {
        "@type": "Answer",
        "text": <?= json_encode($faq['a']) ?>
      }
    }<?= ($fIdx < $faqCount) ? ',' : '' ?>
    <?php endforeach; ?>
  ]
}
</script>
<?php endif; ?>
