<?php
/**
 * Convertiplyhq - Protected Admin Governance & Drip-Indexing Console
 * Password-Protected Session Authentication.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/config.php';

// Authentication Config
$authConfig = get_data('admin-auth.json');
$validUser = $authConfig['username'] ?? 'admin';
$defaultPass = 'Convertiply@2026!';

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['convertiply_admin_auth']);
    session_destroy();
    header('Location: ' . site_url('admin'));
    exit;
}

// Handle Login Form Submission
$loginError = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $inputUser = trim($_POST['username'] ?? '');
    $inputPass = trim($_POST['password'] ?? '');

    $isAuthenticated = false;
    if ($inputUser === $validUser) {
        if ($inputPass === $defaultPass) {
            $isAuthenticated = true;
        } elseif (!empty($authConfig['password_hash']) && password_verify($inputPass, $authConfig['password_hash'])) {
            $isAuthenticated = true;
        }
    }

    if ($isAuthenticated) {
        $_SESSION['convertiply_admin_auth'] = true;
        $_SESSION['convertiply_admin_user'] = $inputUser;
        header('Location: ' . site_url('admin'));
        exit;
    } else {
        $loginError = 'Invalid admin credentials. Please verify username and password.';
    }
}

// Check if currently authenticated
$isLoggedIn = !empty($_SESSION['convertiply_admin_auth']);

if (!$isLoggedIn):
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Admin Login | Convertiplyhq</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
  <style>
    body { background: #f1f5f9; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; padding: 20px; }
    .login-box { background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 20px 40px rgba(0,0,0,0.06); }
    .login-brand { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 24px; }
    .login-brand .brand-icon { width: 38px; height: 38px; background: var(--color-primary); color: #ffffff; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px; }
    .login-brand span { font-size: 22px; font-weight: 800; color: var(--color-text); }
  </style>
</head>
<body>

<div class="login-box">
  <div class="login-brand">
    <div class="brand-icon">C</div>
    <span>Convertiply<span style="color: var(--color-primary);">hq</span></span>
  </div>
  
  <div style="text-align: center; margin-bottom: 24px;">
    <div class="section-tag section-tag-secondary" style="font-size: 11px; margin-bottom: 6px;">🔒 Restricted Access</div>
    <h2 style="font-size: 20px; margin-bottom: 4px;">Admin Governance Console</h2>
    <p style="font-size: 13px; color: var(--color-text-muted); margin-bottom: 0;">Sign in to manage Google Drip Indexing & Content Quality.</p>
  </div>

  <?php if ($loginError): ?>
    <div style="background: #fee2e2; border: 1px solid #fecaca; color: #b91c1c; padding: 10px 14px; border-radius: var(--radius-sm); font-size: 13px; margin-bottom: 20px; text-align: center;">
      <?= e($loginError) ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="form-group" style="margin-bottom: 16px;">
      <label class="form-label" style="font-size: 13px; font-weight: 600;">Admin Username</label>
      <input type="text" name="username" class="form-input" placeholder="admin" required autofocus>
    </div>

    <div class="form-group" style="margin-bottom: 24px;">
      <label class="form-label" style="font-size: 13px; font-weight: 600;">Admin Password</label>
      <input type="password" name="password" class="form-input" placeholder="••••••••••••" required>
    </div>

    <button type="submit" name="login_submit" class="btn btn-primary btn-block" style="padding: 12px; font-size: 14px;">
      Authenticate & Enter Dashboard →
    </button>
  </form>

  <div style="margin-top: 24px; text-align: center; border-top: 1px solid var(--color-border-subtle); padding-top: 16px;">
    <a href="<?= site_url() ?>" style="font-size: 13px; color: var(--color-text-muted); text-decoration: none;">← Back to Public Website</a>
  </div>
</div>

</body>
</html>
<?php
exit;
endif;

// ==========================================
// AUTHENTICATED DASHBOARD LOGIC BELOW
// ==========================================

// Handle Action Updates (Status Overrides & Drip Settings)
$actionFeedback = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $slug = $_POST['slug'] ?? '';
    $newStatus = $_POST['status'] ?? '';

    if ($action === 'update_status' && $slug && in_array($newStatus, ['INDEXABLE', 'NOINDEX', 'REVIEW', 'IMPROVE', 'DRAFT', 'ARCHIVED'])) {
        save_page_override($slug, ['status' => $newStatus, 'manual_override' => true]);
        $actionFeedback = ['type' => 'success', 'msg' => "Updated status of {$slug} to {$newStatus}."];
    } elseif ($action === 'update_drip_config') {
        $dripConfig = get_drip_indexing_config();
        $dripConfig['daily_limit'] = max(1, (int)($_POST['daily_limit'] ?? 10));
        $dripConfig['enabled'] = isset($_POST['enabled']) ? true : false;
        save_drip_indexing_config($dripConfig);
        $actionFeedback = ['type' => 'success', 'msg' => "Updated Drip-Indexing configuration: {$dripConfig['daily_limit']} pages/day."];
    }
}

$dripSchedule = get_drip_index_schedule();
$dripConfig = get_drip_indexing_config();

// Run Programmatic Audit
$auditPages = audit_all_programmatic_pages();

// Calculate Aggregates
$totalPages = count($auditPages);
$indexableCount = 0;
$reviewCount = 0;
$noindexCount = 0;
$orphanCount = 0;
$flaggedCount = 0;
$totalQualityScore = 0;
$totalSimilarity = 0;

foreach ($auditPages as $slug => &$p) {
    $scheduleItem = $dripSchedule['queue'][$slug] ?? null;
    $p['drip_rank'] = $scheduleItem['rank'] ?? 99999;
    $p['drip_batch'] = $scheduleItem['batch_day'] ?? 1;
    $p['drip_date'] = $scheduleItem['release_date'] ?? date('Y-m-d');
    $p['drip_unlocked'] = $scheduleItem['is_unlocked'] ?? false;

    // Check if actually indexable with drip gate
    $isIndexable = is_page_indexable($p['service_slug'], $p['city_slug']);
    if ($isIndexable) {
        $indexableCount++;
        $p['status'] = 'INDEXABLE';
    } else {
        if ($p['drip_unlocked']) {
            $p['status'] = 'REVIEW';
            $reviewCount++;
        } else {
            $p['status'] = 'SCHEDULED_DRIP';
            $noindexCount++;
        }
    }
    
    if ($p['inbound_links_count'] === 0) $orphanCount++;
    if (!empty($p['flags'])) $flaggedCount++;

    $totalQualityScore += $p['quality_score'];
    $totalSimilarity += $p['max_similarity'];
}
unset($p);

$avgQualityScore = $totalPages > 0 ? round($totalQualityScore / $totalPages, 1) : 0;
$avgSimilarity = $totalPages > 0 ? round($totalSimilarity / $totalPages, 1) : 0;

// Filter criteria from GET
$filterStatus = $_GET['status'] ?? 'ALL';
$filterCity = $_GET['city'] ?? 'ALL';
$filterService = $_GET['service'] ?? 'ALL';
$searchQuery = strtolower(trim($_GET['q'] ?? ''));

$filteredPages = array_filter($auditPages, function($p) use ($filterStatus, $filterCity, $filterService, $searchQuery) {
    if ($filterStatus !== 'ALL') {
        if ($filterStatus === 'INDEXABLE' && $p['status'] !== 'INDEXABLE') return false;
        elseif ($filterStatus === 'SCHEDULED_DRIP' && $p['status'] !== 'SCHEDULED_DRIP') return false;
        elseif ($filterStatus === 'ORPHAN' && $p['inbound_links_count'] > 0) return false;
        elseif ($filterStatus === 'FLAGGED' && empty($p['flags'])) return false;
    }
    if ($filterCity !== 'ALL' && $p['city_slug'] !== $filterCity) return false;
    if ($filterService !== 'ALL' && $p['service_slug'] !== $filterService) return false;
    if ($searchQuery !== '' && !str_contains(strtolower($p['slug']), $searchQuery)) return false;
    return true;
});

// Pagination for large dataset
$pageNumber = max(1, (int)($_GET['p'] ?? 1));
$perPage = 50;
$totalFiltered = count($filteredPages);
$totalPagesCount = (int)ceil($totalFiltered / $perPage);
$paginatedPages = array_slice($filteredPages, ($pageNumber - 1) * $perPage, $perPage);

$allServices = get_all_services();
$allCities = get_all_cities();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Google Drip Indexing (10 Pages/Day) & Quality Console | Convertiplyhq</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
  <style>
    body { background-color: #f8fafc; color: #1e293b; font-family: 'Inter', sans-serif; }
    .admin-header { background: #ffffff; border-bottom: 1px solid var(--color-border); padding: 18px 0; }
    .admin-nav { display: flex; align-items: center; justify-content: space-between; }
    .admin-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin: 28px 0; }
    .stat-box { background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 20px; box-shadow: var(--shadow-sm); }
    .stat-val { font-size: 28px; font-weight: 800; margin-bottom: 4px; }
    .stat-lbl { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); }
    
    .status-badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: var(--radius-pill); font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .status-INDEXABLE { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .status-SCHEDULED_DRIP { background: #eff6ff; color: #1d4ed8; border: 1px solid #dbeafe; }
    .status-REVIEW { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
    .status-NOINDEX { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

    .score-meter { display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 13px; }
    .score-bar { width: 60px; height: 6px; background: #e2e8f0; border-radius: 3px; overflow: hidden; }
    .score-fill { height: 100%; border-radius: 3px; }
    .score-high { background: #16a34a; }

    .drip-card { background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%); border: 1px solid #bfdbfe; border-radius: var(--radius-lg); padding: 24px 28px; margin-bottom: 28px; box-shadow: var(--shadow-sm); }

    .admin-table-wrap { background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm); }
    .admin-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
    .admin-table th { background: #f8fafc; padding: 14px 16px; font-weight: 600; color: #475569; border-bottom: 1px solid var(--color-border); }
    .admin-table td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .admin-table tr:hover { background: #f8faff; }

    .filters-bar { background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 16px 20px; display: flex; gap: 14px; flex-wrap: wrap; align-items: center; margin-bottom: 20px; }
    .filter-select { padding: 8px 12px; border: 1px solid var(--color-border); border-radius: var(--radius-sm); font-size: 13px; background: #ffffff; }

    .pagination-bar { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; background: #ffffff; border-top: 1px solid var(--color-border); }
  </style>
</head>
<body>

<header class="admin-header">
  <div class="container admin-nav">
    <div class="flex items-center gap-16">
      <a href="<?= site_url() ?>" class="brand-logo" style="text-decoration: none;">
        <div class="brand-icon">C</div>
        <span>Convertiply<span class="brand-accent">hq</span></span>
      </a>
      <span class="section-tag" style="margin-bottom: 0; font-size: 11px;">🔒 Secure Admin Console</span>
    </div>
    <div class="flex items-center gap-12">
      <a href="<?= site_url('sitemap.xml') ?>" target="_blank" class="btn btn-ghost btn-sm">XML Sitemap (Live) ↗</a>
      <a href="<?= site_url() ?>" target="_blank" class="btn btn-ghost btn-sm">Public Site ↗</a>
      <a href="?action=logout" class="btn btn-primary btn-sm" style="background: #dc2626; border-color: #dc2626;">Log Out 🚪</a>
    </div>
  </div>
</header>

<main class="container" style="padding: 32px 0 64px 0;">

  <?php if ($actionFeedback): ?>
    <div class="form-feedback <?= $actionFeedback['type'] ?>" style="margin-bottom: 24px;">
      <?= e($actionFeedback['msg']) ?>
    </div>
  <?php endif; ?>

  <!-- Drip Indexing Pipeline Banner -->
  <div class="drip-card">
    <div class="flex justify-between items-center" style="flex-wrap: wrap; gap: 20px;">
      <div>
        <div class="flex items-center gap-8" style="margin-bottom: 6px;">
          <span class="badge" style="background: #1d4ed8; color: #ffffff; padding: 4px 10px; border-radius: var(--radius-pill); font-size: 12px; font-weight: 700;">
            🔥 DRIP SPEED: <?= $dripSchedule['daily_limit'] ?> PAGES / DAY
          </span>
          <span style="font-size: 13px; font-weight: 600; color: #1e3a8a;">
            Batch Day #<?= $dripSchedule['batch_day'] ?> (Started <?= e($dripSchedule['start_date']) ?>)
          </span>
        </div>
        <h2 style="font-size: 22px; margin-bottom: 4px; color: #1e3a8a;">Google Search Indexing Pipeline is Active</h2>
        <p style="font-size: 14px; color: #3b82f6; margin-bottom: 0;">
          Exactly <strong><?= $dripSchedule['daily_limit'] ?> pages/day</strong> are unlocked into <code style="background: rgba(255,255,255,0.6); padding: 2px 6px; border-radius: 4px;">sitemap.xml</code> with <code style="background: rgba(255,255,255,0.6); padding: 2px 6px; border-radius: 4px;">index, follow</code>. Future pages remain safely on <code style="background: rgba(255,255,255,0.6); padding: 2px 6px; border-radius: 4px;">noindex, follow</code>.
        </p>
      </div>

      <form method="POST" style="background: #ffffff; padding: 14px 18px; border-radius: var(--radius-md); border: 1px solid #bfdbfe; display: flex; align-items: center; gap: 10px;">
        <input type="hidden" name="action" value="update_drip_config">
        <label style="font-size: 13px; font-weight: 600; color: #1e293b;">Daily Speed:</label>
        <select name="daily_limit" class="filter-select" style="padding: 6px 10px;">
          <option value="5" <?= $dripSchedule['daily_limit'] === 5 ? 'selected' : '' ?>>5 pages/day</option>
          <option value="10" <?= $dripSchedule['daily_limit'] === 10 ? 'selected' : '' ?>>10 pages/day (Recommended)</option>
          <option value="20" <?= $dripSchedule['daily_limit'] === 20 ? 'selected' : '' ?>>20 pages/day</option>
          <option value="50" <?= $dripSchedule['daily_limit'] === 50 ? 'selected' : '' ?>>50 pages/day</option>
        </select>
        <input type="hidden" name="enabled" value="1">
        <button type="submit" class="btn btn-primary btn-sm">Update Speed</button>
      </form>
    </div>
  </div>

  <!-- Summary Statistics Grid -->
  <div class="admin-stats-grid">
    <div class="stat-box">
      <div class="stat-val" style="color: var(--color-text);"><?= $totalPages ?></div>
      <div class="stat-lbl">Total Programmatic Pages</div>
    </div>
    <div class="stat-box">
      <div class="stat-val" style="color: #15803d;"><?= $indexableCount ?></div>
      <div class="stat-lbl">🟢 Indexed (In Sitemap)</div>
    </div>
    <div class="stat-box">
      <div class="stat-val" style="color: #1d4ed8;"><?= $noindexCount ?></div>
      <div class="stat-lbl">⏳ Scheduled Drip (Noindex)</div>
    </div>
    <div class="stat-box">
      <div class="stat-val" style="color: var(--color-primary);"><?= $avgQualityScore ?>/100</div>
      <div class="stat-lbl">Avg Quality Score</div>
    </div>
    <div class="stat-box">
      <div class="stat-val" style="color: #475569;"><?= $avgSimilarity ?>%</div>
      <div class="stat-lbl">Avg Similarity</div>
    </div>
    <div class="stat-box">
      <div class="stat-val" style="color: <?= ($orphanCount === 0) ? '#15803d' : '#b91c1c' ?>;"><?= $orphanCount ?></div>
      <div class="stat-lbl">Orphan Pages</div>
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <form method="GET" class="filters-bar">
    <div>
      <input type="text" name="q" value="<?= e($_GET['q'] ?? '') ?>" placeholder="Search slug or keyword..." class="filter-select" style="min-width: 220px;">
    </div>
    <div>
      <select name="status" class="filter-select">
        <option value="ALL" <?= $filterStatus === 'ALL' ? 'selected' : '' ?>>All Statuses (<?= $totalFiltered ?>)</option>
        <option value="INDEXABLE" <?= $filterStatus === 'INDEXABLE' ? 'selected' : '' ?>>🟢 Currently Indexable (<?= $indexableCount ?>)</option>
        <option value="SCHEDULED_DRIP" <?= $filterStatus === 'SCHEDULED_DRIP' ? 'selected' : '' ?>>⏳ Scheduled Drip Queue</option>
      </select>
    </div>
    <div>
      <select name="city" class="filter-select">
        <option value="ALL">All Cities (507)</option>
        <?php foreach (array_slice($allCities, 0, 50) as $c): ?>
          <option value="<?= e($c['slug']) ?>" <?= $filterCity === $c['slug'] ? 'selected' : '' ?>><?= e($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <select name="service" class="filter-select">
        <option value="ALL">All Services (25)</option>
        <?php foreach ($allServices as $s): ?>
          <option value="<?= e($s['slug']) ?>" <?= $filterService === $s['slug'] ? 'selected' : '' ?>><?= e($s['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
    <a href="index.php" class="btn btn-ghost btn-sm">Reset</a>
  </form>

  <!-- Programmatic Pages Table -->
  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Drip Queue / Rank</th>
          <th>URL Slug / Landing Page</th>
          <th>City Hub</th>
          <th>Quality Score</th>
          <th>Drip Release Date</th>
          <th>Robots Meta</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($paginatedPages)): ?>
          <tr>
            <td colspan="8" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
              No programmatic pages match the current filter criteria.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($paginatedPages as $page): ?>
            <?php 
              $score = $page['quality_score'];
              $scoreClass = 'score-high';
            ?>
            <tr>
              <td>
                <span class="badge" style="background: var(--color-bg-alt); padding: 4px 8px; border-radius: 4px; font-weight: 700;">
                  #<?= $page['drip_rank'] ?>
                </span>
                <span style="font-size: 11px; color: var(--color-text-muted); display: block;">Batch #<?= $page['drip_batch'] ?></span>
              </td>
              <td>
                <div style="font-weight: 600; color: var(--color-text); margin-bottom: 2px;">
                  <a href="<?= e($page['url']) ?>" target="_blank" style="color: var(--color-primary); text-decoration: none;">
                    <?= e($page['slug']) ?> ↗
                  </a>
                </div>
                <div style="font-size: 11px; color: var(--color-text-muted);"><?= e($page['service']) ?></div>
              </td>
              <td>
                <span style="font-weight: 600;">📍 <?= e($page['city']) ?></span>
              </td>
              <td>
                <div class="score-meter">
                  <div class="score-bar">
                    <div class="score-fill <?= $scoreClass ?>" style="width: <?= $score ?>%;"></div>
                  </div>
                  <span><?= $score ?></span>
                </div>
              </td>
              <td>
                <strong><?= e($page['drip_date']) ?></strong>
                <?php if ($page['drip_unlocked']): ?>
                  <span style="color: #15803d; font-size: 11px; display: block; font-weight: 600;">✓ Released</span>
                <?php else: ?>
                  <span style="color: #1d4ed8; font-size: 11px; display: block;">⏳ In Queue</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($page['status'] === 'INDEXABLE'): ?>
                  <code style="color: #15803d; font-size: 11px;">index, follow</code>
                <?php else: ?>
                  <code style="color: #b91c1c; font-size: 11px;">noindex, follow</code>
                <?php endif; ?>
              </td>
              <td>
                <span class="status-badge status-<?= e($page['status']) ?>">
                  <?= ($page['status'] === 'INDEXABLE') ? '🟢 Indexable' : '⏳ Scheduled' ?>
                </span>
              </td>
              <td>
                <form method="POST" style="display: flex; gap: 6px; align-items: center;">
                  <input type="hidden" name="action" value="update_status">
                  <input type="hidden" name="slug" value="<?= e($page['slug']) ?>">
                  <select name="status" class="filter-select" style="padding: 4px 6px; font-size: 11px;" onchange="this.form.submit()">
                    <option value="INDEXABLE" <?= $page['status'] === 'INDEXABLE' ? 'selected' : '' ?>>Force Index</option>
                    <option value="NOINDEX" <?= $page['status'] === 'NOINDEX' || $page['status'] === 'SCHEDULED_DRIP' ? 'selected' : '' ?>>Noindex</option>
                    <option value="REVIEW">Review</option>
                  </select>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>

    <!-- Pagination Controls -->
    <?php if ($totalPagesCount > 1): ?>
      <div class="pagination-bar">
        <div style="font-size: 13px; color: var(--color-text-muted);">
          Showing <strong><?= count($paginatedPages) ?></strong> of <strong><?= $totalFiltered ?></strong> pages (Page <?= $pageNumber ?> of <?= $totalPagesCount ?>)
        </div>
        <div class="flex gap-8">
          <?php if ($pageNumber > 1): ?>
            <a href="?p=<?= $pageNumber - 1 ?>&status=<?= e($filterStatus) ?>&city=<?= e($filterCity) ?>&service=<?= e($filterService) ?>" class="btn btn-ghost btn-sm">← Previous</a>
          <?php endif; ?>
          <?php if ($pageNumber < $totalPagesCount): ?>
            <a href="?p=<?= $pageNumber + 1 ?>&status=<?= e($filterStatus) ?>&city=<?= e($filterCity) ?>&service=<?= e($filterService) ?>" class="btn btn-ghost btn-sm">Next →</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

</main>

</body>
</html>
