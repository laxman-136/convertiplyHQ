<?php
/**
 * Convertiplyhq - Built-in PHP Development Server Router
 * Usage: php -S localhost:8000 router.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');
if ($uri === '') {
    $uri = '/';
}

$filePath = __DIR__ . $uri;

// 1. If physical file exists (static asset like CSS, JS, images), serve directly
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    $ext = pathinfo($filePath, PATHINFO_EXTENSION);
    if ($ext === 'css') {
        header('Content-Type: text/css');
    } elseif ($ext === 'js') {
        header('Content-Type: application/javascript');
    } elseif ($ext === 'svg') {
        header('Content-Type: image/svg+xml');
    } elseif ($ext === 'json') {
        header('Content-Type: application/json');
    }
    return false;
}

// 2. Programmatic Service × City Route: /services/{service-slug}-in-{city-slug} or /service/{service-slug}-in-{city-slug}
if (preg_match('#^/(?:services|service)/([a-z0-9\-]+)-in-([a-z0-9\-]+)$#i', $uri, $matches)) {
    $serviceSlug = $matches[1];
    $citySlug = $matches[2];
    require __DIR__ . '/templates/template-service-city.php';
    exit;
}

// 2.1 Direct Service Page Route: /services/{service-slug} or /service/{service-slug}
if (preg_match('#^/(?:services|service)/([a-z0-9\-]+)$#i', $uri, $matches)) {
    $serviceSlug = $matches[1];
    $citySlug = 'hyderabad'; // Flagship / HQ hub
    $isDirectServicePage = true;
    require __DIR__ . '/templates/template-service-city.php';
    exit;
}

// 3. Blog Single Post Route: /blog/{slug}
if (preg_match('#^/blog/([a-z0-9\-]+)$#i', $uri, $matches)) {
    $slug = $matches[1];
    require __DIR__ . '/blog-post.php';
    exit;
}

// 4. Static / Hub Routes
switch ($uri) {
    case '/':
    case '/index':
    case '/index.php':
        require __DIR__ . '/index.php';
        break;

    case '/services':
    case '/services.php':
        require __DIR__ . '/services.php';
        break;

    case '/locations':
    case '/locations.php':
        require __DIR__ . '/locations.php';
        break;

    case '/about':
    case '/about.php':
        require __DIR__ . '/about.php';
        break;

    case '/blog':
    case '/blog.php':
        require __DIR__ . '/blog.php';
        break;

    case '/contact':
    case '/contact.php':
        require __DIR__ . '/contact.php';
        break;

    case '/admin':
    case '/admin/':
    case '/admin/index':
    case '/admin/index.php':
        require __DIR__ . '/admin/index.php';
        break;

    case '/sitemap.xml':
    case '/sitemap.php':
        require __DIR__ . '/sitemap.php';
        break;

    case '/robots.txt':
        header('Content-Type: text/plain');
        readfile(__DIR__ . '/robots.txt');
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/index.php';
        break;
}
