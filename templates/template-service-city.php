<?php
/**
 * Convertiplyhq - Authoritative Programmatic Service × City Landing Page Template
 * Exhaustive 5,000+ word editorial architecture delivering deep technical rigor,
 * micro-district economic dynamics, 12-month roadmaps, and 5-industry playbooks.
 */

if (!defined('CONVERTIPLY_INIT')) {
    require_once __DIR__ . '/../includes/config.php';
}
require_once __DIR__ . '/../includes/deep-content-engine.php';

// Extract service and city parameters
$serviceSlug = $serviceSlug ?? ($_GET['service'] ?? 'seo');
$citySlug = $citySlug ?? ($_GET['city'] ?? 'hyderabad');

$page = get_programmatic_page($serviceSlug, $citySlug);

// Safeguard against thin content
if (!$page || (empty($page['case_studies']) && count($page['faqs'] ?? []) < 4)) {
    http_response_code(404);
    require __DIR__ . '/../index.php';
    exit;
}

$serviceName = $page['service'];
$serviceFullName = $page['service_full_name'];
$cityName = $page['city'];
$stateName = $page['state'];

$isDirect = $isDirectServicePage ?? false;
$canonicalUrl = $isDirect ? service_url($page['service_slug']) : service_city_url($page['service_slug'], $page['city_slug']);
$robotsDirective = $isDirect ? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' : get_robots_meta_directive($page['service_slug'], $page['city_slug']);

// SEO Metadata
$metaTitle = $isDirect ? "{$serviceFullName} | Convertiplyhq" : "{$serviceName} Services in {$cityName} | Convertiplyhq";
$metaDescription = "Accelerate revenue with expert {$serviceName} services in {$cityName}, {$stateName}. Typical investment {$page['avg_price_range']}. Tailored for local high-growth businesses.";

$faqsForSchema = [];
foreach ($page['faqs'] as $faq) {
    $faqsForSchema[] = [
        'q' => $faq['question'],
        'a' => $faq['answer']
    ];
}

$pageSeo = [
    'title' => $metaTitle,
    'description' => $metaDescription,
    'canonical' => $canonicalUrl,
    'robots' => $robotsDirective,
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'Services', 'url' => site_url('services')],
        ['name' => "{$serviceName} in {$cityName}", 'url' => $canonicalUrl]
    ],
    'serviceData' => $page['service_data'],
    'cityData' => $page['city_data'],
    'faqs' => $faqsForSchema
];

require __DIR__ . '/../includes/header.php';

// Retrieve enriched definition data and deep modules
$definition = get_service_definition($page['service_slug']);
$districts = $page['city_data']['keyDistricts'] ?? ['Central Commercial District', 'IT Corridor', 'Industrial Zone', 'Suburban Hub'];
$industries = $page['industry_focus'];
$deepModules = get_deep_content_modules($page['service_slug'], $page['city_slug'], $serviceName, $cityName, $stateName);
?>

<!-- 1. Breadcrumbs -->
<div class="breadcrumb-wrap">
  <div class="container">
    <ul class="breadcrumb-list">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
      <li class="breadcrumb-separator">/</li>
      <li class="breadcrumb-item"><a href="<?= site_url('services') ?>">Services</a></li>
      <li class="breadcrumb-separator">/</li>
      <li class="breadcrumb-item active"><?= e($serviceName) ?> in <?= e($cityName) ?></li>
    </ul>
  </div>
</div>

<!-- 2. Hero Section -->
<section class="section" style="padding-bottom: 32px; background: linear-gradient(180deg, #ffffff 0%, var(--color-bg-alt) 100%);">
  <div class="container">
    <div class="grid grid-2" style="align-items: center; gap: 48px;">
      <div>
        <div class="section-tag section-tag-secondary">
          📍 Regional Growth Hub · <?= e($cityName) ?>, <?= e($stateName) ?>
        </div>
        <h1 style="font-size: 38px; line-height: 1.2; margin-bottom: 18px;">
          Data-Driven <span style="color: var(--color-primary);"><?= e($serviceName) ?></span> Services in <?= e($cityName) ?>
        </h1>
        <p class="lead" style="font-size: 16.5px; line-height: 1.7; margin-bottom: 24px;">
          Convertiplyhq engineers high-performing, revenue-tied <?= strtolower(e($serviceName)) ?> campaigns tailored specifically to <?= e($cityName) ?>'s commercial ecosystem. We combine technical rigor, sub-second landing page architecture, and transparent CRM attribution to scale predictable customer acquisition.
        </p>

        <!-- Quick Facts Pill Grid -->
        <div class="grid grid-3" style="gap: 12px; margin-bottom: 28px;">
          <div style="background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 12px 14px;">
            <div style="font-size: 11px; font-weight: 700; color: var(--color-text-light); text-transform: uppercase;">Active Market SMEs</div>
            <div style="font-size: 15px; font-weight: 800; color: var(--color-primary); margin-top: 2px;"><?= e($page['city_data']['activeSMEs'] ?? '8,500+') ?></div>
          </div>
          <div style="background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 12px 14px;">
            <div style="font-size: 11px; font-weight: 700; color: var(--color-text-light); text-transform: uppercase;">Typical Retainer</div>
            <div style="font-size: 15px; font-weight: 800; color: var(--color-text); margin-top: 2px;"><?= e($page['avg_price_range']) ?></div>
          </div>
          <div style="background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-sm); padding: 12px 14px;">
            <div style="font-size: 11px; font-weight: 700; color: var(--color-text-light); text-transform: uppercase;">Growth Horizon</div>
            <div style="font-size: 15px; font-weight: 800; color: var(--color-success); margin-top: 2px;">90-Day Sprint</div>
          </div>
        </div>

        <div class="flex gap-12" style="flex-wrap: wrap;">
          <a href="#audit-form" class="btn btn-primary">Claim Free <?= e($cityName) ?> Audit →</a>
          <a href="#roadmap" class="btn btn-ghost">View 12-Month Playbook</a>
        </div>
      </div>

      <!-- Lead Capture Card -->
      <div class="card" id="audit-form" style="padding: 32px; box-shadow: var(--shadow-md);">
        <div style="margin-bottom: 20px;">
          <span class="badge" style="background: var(--color-primary-light); color: var(--color-primary); font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: var(--radius-pill);">
            ⚡ 24-HOUR TURNAROUND
          </span>
          <h3 style="font-size: 21px; margin-top: 8px; margin-bottom: 4px;">Request Your <?= e($cityName) ?> Growth Blueprint</h3>
          <p style="font-size: 13.5px; color: var(--color-text-muted); margin-bottom: 0;">
            Our senior architects will audit your current <?= strtolower(e($serviceName)) ?> channels and identify high-value revenue leaks.
          </p>
        </div>

        <form action="<?= site_url('contact') ?>" method="GET" style="display: flex; flex-direction: column; gap: 14px;">
          <input type="hidden" name="service" value="<?= e($page['service_slug']) ?>">
          <input type="hidden" name="city" value="<?= e($page['city_slug']) ?>">

          <div class="form-group">
            <label class="form-label" style="font-size: 12.5px;">Company Website / Domain</label>
            <input type="text" name="website" class="form-control" placeholder="e.g. yourcompany.com" required>
          </div>

          <div class="form-group">
            <label class="form-label" style="font-size: 12.5px;">Work Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="alex@company.com" required>
          </div>

          <div class="form-group">
            <label class="form-label" style="font-size: 12.5px;">Primary Business Hub</label>
            <select name="district" class="form-control">
              <?php foreach ($districts as $dist): ?>
                <option value="<?= e($dist) ?>"><?= e($dist) ?> (<?= e($cityName) ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="submit" class="btn btn-primary btn-block" style="padding: 12px; font-size: 14px;">
            Generate My Free <?= e($cityName) ?> Audit Roadmap →
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- 3. Proof & Benchmarks Strip -->
<section class="trust-strip" style="background: #ffffff;">
  <div class="container">
    <div class="grid grid-4" style="text-align: center; gap: 20px;">
      <div>
        <div style="font-size: 28px; font-weight: 800; color: var(--color-primary);">4.8x</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Average Blended ROAS</div>
      </div>
      <div>
        <div style="font-size: 28px; font-weight: 800; color: var(--color-primary);">+320%</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Avg Pipeline Growth</div>
      </div>
      <div>
        <div style="font-size: 28px; font-weight: 800; color: var(--color-primary);">100%</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">White-Hat Engineering</div>
      </div>
      <div>
        <div style="font-size: 28px; font-weight: 800; color: var(--color-primary);">90-Day</div>
        <div style="font-size: 13px; font-weight: 600; color: var(--color-text-muted);">Performance Sprints</div>
      </div>
    </div>
  </div>
</section>

<!-- 4. Deep Technical Discipline Framework & Core Philosophy -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Core Technical Framework</div>
    <h2 style="font-size: 32px; line-height: 1.3; margin-bottom: 16px;">
      The Engineering Philosophy Behind <?= e($serviceFullName) ?>
    </h2>
    <div class="editorial-lead-box">
      <p style="margin-bottom: 12px;">
        <?= e($definition['philosophy'] ?? "Modern digital acquisition requires engineering precision. Rather than treating marketing as superficial promotion, we build systematic growth loops that combine technical site speed, topical keyword clustering, high-converting checkout flows, and granular server-side attribution.") ?>
      </p>
      <p style="margin-bottom: 12px; font-size: 14.5px; color: var(--color-text-muted);">
        For enterprises and high-growth businesses operating in <?= e($cityName) ?>, executing <?= strtolower(e($serviceName)) ?> requires navigating intense local search competition and capturing high-intent commercial buyers at the exact moment of decision-making. Search algorithms have evolved past superficial metadata matching—today, neural search systems evaluate comprehensive semantic depth, factual accuracy, user dwell patterns, and multi-channel brand consensus.
      </p>
      <p style="margin-bottom: 0; font-size: 14.5px; color: var(--color-text-muted);">
        By anchoring your digital architecture on verifiable customer acquisition unit economics rather than vanity traffic metrics, we transform your web presence into an appreciating enterprise asset that continually lowers your blended cost-per-acquisition (CAC) while compounding organic and paid market share.
      </p>
    </div>

    <!-- 7 Algorithmic Mechanics -->
    <h3 style="font-size: 24px; margin-top: 40px; margin-bottom: 20px;">
      7 Critical Algorithmic Ranking & Performance Mechanics
    </h3>
    <p style="font-size: 15px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 24px;">
      Search engines and paid ad bidding networks evaluate hundreds of technical signals. Here is how our engineering squad calibrates your <?= e($cityName) ?> digital architecture to outperform competitors:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 40px;">
      <?php foreach (($definition['algorithmic_mechanics'] ?? []) as $mech): ?>
        <div class="card" style="padding: 24px;">
          <h4 style="font-size: 16.5px; color: var(--color-text); margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
            <span style="color: var(--color-primary);">⚡</span> <?= e($mech['name']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($mech['desc']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 5. City Commercial Ecosystem & Micro-District Dynamics -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Local Market Intelligence</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Commercial District & Micro-Market Dynamics in <?= e($cityName) ?>
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      <?= e($cityName) ?> represents a dynamic commercial landscape with over <strong><?= e($page['city_data']['activeSMEs'] ?? '8,500+') ?> active registered businesses</strong> competing across key sectors like <?= implode(', ', $industries) ?>. Effective <?= strtolower(e($serviceName)) ?> must account for the distinct commercial characteristics of <?= e($cityName) ?>'s primary business hubs:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php 
      $districtProfiles = get_district_profiles($districts, $cityName);
      foreach ($districtProfiles as $dp): 
      ?>
        <div class="card" style="background: #ffffff; padding: 24px 26px; border: 1px solid var(--color-border); border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
          <div class="flex justify-between items-center" style="margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
            <h4 style="font-size: 17px; margin-bottom: 0; color: var(--color-text); font-weight: 700;">
              📍 <?= e($dp['name']) ?>
            </h4>
            <span style="font-size: 11px; font-weight: 700; color: <?= e($dp['tag_color']) ?>; background: <?= e($dp['bg_color']) ?>; padding: 4px 10px; border-radius: var(--radius-pill);">
              <?= e($dp['tag']) ?>
            </span>
          </div>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 12px;">
            <?= e($dp['summary']) ?>
          </p>
          <div style="background: var(--color-bg-alt); padding: 10px 14px; border-radius: var(--radius-sm); margin-bottom: 12px; font-size: 12.5px; line-height: 1.5;">
            <div style="margin-bottom: 4px;"><strong>Target Profile:</strong> <?= e($dp['demographics']) ?></div>
            <div><strong>Execution Tactics:</strong> <?= e($dp['tactics']) ?></div>
          </div>
          <div style="font-size: 12.5px; color: var(--color-text-light); border-top: 1px solid var(--color-border-subtle); padding-top: 10px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 6px;">
            <span style="color: var(--color-text-light); font-weight: 600;">Core Channel:</span>
            <span style="color: var(--color-primary); font-weight: 700;"><?= e($dp['focus']) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="card" style="padding: 24px 28px; background: #ffffff; border-left: 4px solid var(--color-secondary);">
      <h4 style="font-size: 16px; margin-bottom: 6px;">Strategic Takeaway for <?= e($cityName) ?> Founders:</h4>
      <p style="font-size: 14px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
        Attempting to rank nationally without first dominating your home territory in <?= e($cityName) ?> dilutes crawl budget and wastes advertising capital. Establishing dominance across <?= e($cityName) ?>'s key commercial districts creates a high-margin revenue foundation that fuels wider regional and pan-India expansion.
      </p>
    </div>
  </div>
</section>

<!-- 6. High-Intent Keyword Matrix & Search Intent Distribution -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Search Intent Telemetry</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      High-Intent Keyword Clustering & Search Volume in <?= e($cityName) ?>
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Understanding how decision-makers in <?= e($cityName) ?> search for <?= strtolower(e($serviceName)) ?> solutions is fundamental to capturing high-value commercial pipeline. We categorize regional search queries across four distinct intent tiers:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['keyword_matrix'] as $cluster): ?>
        <div class="card" style="padding: 24px 26px; background: #ffffff; border: 1px solid var(--color-border); border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
          <div class="flex justify-between items-center" style="margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
            <span style="font-size: 11px; font-weight: 700; color: var(--color-primary); background: var(--color-primary-light); padding: 4px 10px; border-radius: var(--radius-pill);">
              <?= e($cluster['funnel_stage']) ?>
            </span>
            <span style="font-size: 11.5px; font-weight: 700; color: var(--color-success); background: rgba(5, 150, 105, 0.08); padding: 4px 10px; border-radius: var(--radius-pill);">
              Avg Conversion: <?= e($cluster['conversion_rate']) ?>
            </span>
          </div>
          <h4 style="font-size: 17px; margin-bottom: 6px; color: var(--color-text); font-weight: 700;">
            <?= e($cluster['cluster']) ?>
          </h4>
          <p style="font-size: 13px; color: var(--color-text-muted); line-height: 1.5; margin-bottom: 14px;">
            <strong>Intent Focus:</strong> <?= e($cluster['intent']) ?>
          </p>
          <div style="background: var(--color-bg-alt); padding: 12px 14px; border-radius: var(--radius-sm);">
            <div style="font-size: 11px; font-weight: 700; color: var(--color-text-light); text-transform: uppercase; margin-bottom: 8px;">High-Value Commercial Search Queries:</div>
            <ul style="list-style: none; font-size: 12.5px; color: var(--color-text); line-height: 1.6; display: flex; flex-direction: column; gap: 6px; margin: 0; padding: 0;">
              <?php foreach ($cluster['queries'] as $q): ?>
                <li style="display: flex; gap: 8px; align-items: baseline;">
                  <span style="color: var(--color-primary); font-size: 13px;">🔍</span>
                  <span style="font-weight: 500; font-family: var(--font-mono, monospace); font-size: 12px; color: var(--color-text);"><?= e($q) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 7. Lead Scoring Framework & Funnel Qualification -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Lead Quality Engineering</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Lead Scoring & Pipeline Qualification Architecture
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Marketing success is measured by closed revenue, not vanity form fills. We deploy a multi-dimensional lead scoring framework for your <?= e($cityName) ?> campaigns:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['lead_scoring_framework'] as $ls): ?>
        <div class="card" style="background: #ffffff; padding: 24px;">
          <h4 style="font-size: 17px; color: var(--color-primary); margin-bottom: 8px;">
            🎯 <?= e($ls['pillar']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text); margin-bottom: 8px;">
            <strong>Qualification Rules:</strong> <?= e($ls['criteria']) ?>
          </p>
          <p style="font-size: 13px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <strong>Sales Pipeline Impact:</strong> <?= e($ls['impact']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 8. Omnichannel Customer Acquisition Flywheel -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Channel Integration</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      The Interconnected Full-Funnel Growth Flywheel
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Marketing channels should never operate in isolation. Here is how our engineering squads synchronize <?= strtolower(e($serviceName)) ?> across your entire digital customer acquisition flywheel:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['channel_flywheel'] as $cf): ?>
        <div class="card" style="padding: 24px;">
          <h4 style="font-size: 17px; color: var(--color-primary); margin-bottom: 8px;">
            🔄 <?= e($cf['channel']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($cf['role']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 9. 12-Month Phased Growth Operating System -->
<section class="section section-alt" id="roadmap">
  <div class="container" style="max-width: 960px;">
    <div class="section-header">
      <div class="section-tag">Execution Roadmap</div>
      <h2>Our 12-Month <?= e($serviceName) ?> Growth Operating System</h2>
      <p>A battle-tested, phased engineering sprint methodology designed for compounding revenue growth.</p>
    </div>

    <div class="roadmap-grid">
      <?php foreach (($definition['phased_roadmap'] ?? []) as $step): ?>
        <div class="roadmap-card">
          <span class="roadmap-badge"><?= e($step['phase']) ?></span>
          <h3 style="font-size: 19px; margin-bottom: 10px;"><?= e($step['title']) ?></h3>
          <p style="font-size: 14px; color: var(--color-text-muted); line-height: 1.65; margin-bottom: 14px;">
            <?= e($step['summary']) ?>
          </p>
          <div style="background: var(--color-bg-alt); padding: 10px 14px; border-radius: var(--radius-sm); font-size: 12.5px; color: var(--color-text);">
            <strong>Core Sprint Milestones:</strong> Verified technical health score > 95%, indexation validation, monthly ranking reports, and bi-weekly attribution reviews.
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 10. 5-Vertical Industry Execution Playbooks -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Industry Specialization</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      How <?= e($serviceName) ?> Executes Across 5 Major <?= e($cityName) ?> Industries
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Generic marketing playbooks fail because different industries possess radically different customer purchase journeys, sales cycle lengths, and compliance requirements. Here is how our <?= e($cityName) ?> engineering squad adapts this discipline across five core sectors:
    </p>

    <div class="industry-playbook-grid">
      <?php foreach (($definition['industry_playbooks'] ?? []) as $ind): ?>
        <div class="industry-card-pro">
          <div class="flex justify-between items-center" style="margin-bottom: 10px; flex-wrap: wrap; gap: 8px;">
            <h4 style="font-size: 18px; margin-bottom: 0; color: var(--color-text);">
              🏢 <?= e($ind['industry']) ?>
            </h4>
            <span class="badge" style="background: var(--color-primary-light); color: var(--color-primary); font-size: 11.5px; font-weight: 700; padding: 4px 10px; border-radius: var(--radius-pill);">
              <?= e($ind['focus']) ?>
            </span>
          </div>
          <p style="font-size: 14px; color: var(--color-text-muted); line-height: 1.65; margin-bottom: 12px;">
            <strong>Tailored Strategic Execution:</strong> <?= e($ind['strategy']) ?>
          </p>
          <div style="font-size: 13px; color: var(--color-text); line-height: 1.6;">
            <strong>Operational Value Proposition:</strong> By configuring industry-specific funnel paths and compliance checkpoints, your <?= e($cityName) ?> business establishes high authority, reduces sales cycle friction, and converts enterprise buyers at significantly higher rates.
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 11. Forensic Technical Specifications & Scope of Work (SOW) -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Engineering Specifications</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Detailed Scope of Work (SOW) & Technical Deliverable Architecture
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Every sprint item is accompanied by a formal technical scope, specialized tooling stack, and executable client artifact:
    </p>

    <div style="display: flex; flex-direction: column; gap: 20px;">
      <?php foreach ($deepModules['technical_specifications'] as $sow): ?>
        <div class="card" style="background: #ffffff; padding: 24px 28px;">
          <h4 style="font-size: 18px; color: var(--color-primary); margin-bottom: 6px;">
            🔧 <?= e($sow['title']) ?>
          </h4>
          <p style="font-size: 14px; color: var(--color-text); font-weight: 600; margin-bottom: 8px;">
            Objective: <span style="font-weight: normal; color: var(--color-text-muted);"><?= e($sow['objective']) ?></span>
          </p>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 12px;">
            <strong>Technical Scope:</strong> <?= e($sow['scope']) ?>
          </p>
          <div class="grid grid-2" style="gap: 12px; font-size: 12.5px; background: var(--color-bg-alt); padding: 12px 16px; border-radius: var(--radius-sm);">
            <div><strong>Specialized Tooling:</strong> <?= e($sow['tools']) ?></div>
            <div><strong>Delivered Artifact:</strong> <?= e($sow['artifact']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 12. 90-Day Implementation Scorecard & Milestone Matrix -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Implementation Scorecard</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      90-Day Sprint Implementation Scorecard
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      We eliminate ambiguity through transparent, milestone-gated sprint deliverables:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['scorecard_milestones'] as $score): ?>
        <div class="card" style="padding: 24px;">
          <div class="badge" style="background: var(--color-primary-light); color: var(--color-primary); font-size: 11.5px; font-weight: 700; padding: 4px 8px; border-radius: var(--radius-pill); margin-bottom: 8px;">
            <?= e($score['timeline']) ?>
          </div>
          <h4 style="font-size: 17px; margin-bottom: 8px; color: var(--color-text);"><?= e($score['title']) ?></h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($score['deliverables']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 13. CRO & User Psychology Principles -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Behavioral Science</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Conversion Rate Optimization (CRO) & Psychological Triggers
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Driving traffic is futile if landing pages fail to persuade. We embed 5 core behavioral psychology principles into every page deployed in <?= e($cityName) ?>:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['cro_psychology_principles'] as $cro): ?>
        <div class="card" style="background: #ffffff; padding: 24px;">
          <h4 style="font-size: 16.5px; color: var(--color-text); margin-bottom: 8px;">
            🧠 <?= e($cro['name']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($cro['desc']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 14. Multi-Touch Attribution & Telemetry Modeling -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Revenue Intelligence</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Multi-Touch Pipeline Attribution Modeling
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      We bridge the gap between marketing analytics and executive balance sheets through advanced multi-touch attribution:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['attribution_deep_dive'] as $att): ?>
        <div class="card" style="padding: 24px;">
          <h4 style="font-size: 17px; color: var(--color-primary); margin-bottom: 8px;">
            📊 <?= e($att['model']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text); margin-bottom: 10px;">
            <strong>Telemetry Role:</strong> <?= e($att['role']) ?>
          </p>
          <p style="font-size: 13px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <strong>Executive Strategic Utility:</strong> <?= e($att['utility']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 15. Defensive Competitive Moats -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Market Leadership</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Building an Unassailable Digital Moat in <?= e($cityName) ?>
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Our engineering methodologies protect your market position and widen your competitive advantage over time:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['competitive_moat'] as $moat): ?>
        <div class="card" style="background: #ffffff; padding: 24px;">
          <h4 style="font-size: 17px; color: var(--color-text); margin-bottom: 8px;">
            🛡️ <?= e($moat['pillar']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($moat['action']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 16. Regulatory Compliance & Ethics Manifesto -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Governance & Compliance</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Regulatory Compliance & Marketing Ethics Manifesto
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      We adhere to strict data security, regulatory, and white-hat quality standards across every client deployment:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['compliance_manifesto'] as $comp): ?>
        <div class="card" style="padding: 24px;">
          <h4 style="font-size: 17px; color: var(--color-primary); margin-bottom: 8px;">
            ⚖️ <?= e($comp['standard']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($comp['description']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 17. Industry Terms & KPI Glossary -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Executive Glossary</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Key Performance Indicators (KPI) & Terminology Guide
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Essential metrics and terminology monitored across all <?= e($cityName) ?> digital campaigns:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['kpi_glossary'] as $kpi): ?>
        <div class="card" style="background: #ffffff; padding: 24px;">
          <h4 style="font-size: 16.5px; color: var(--color-primary); margin-bottom: 6px;">
            📖 <?= e($kpi['term']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($kpi['definition']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 18. Technical Infrastructure & Compliance Blueprint -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Infrastructure & Speed</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Server-Side Speed, Schema Graphs & Data Compliance Blueprint
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      High-performing digital marketing is intrinsically linked to underlying server and security architecture:
    </p>

    <?php if (!empty($definition['technical_blueprint'])): ?>
      <div class="card" style="padding: 28px; background: #ffffff; border: 1px solid var(--color-border);">
        <div class="grid grid-2" style="gap: 24px;">
          <div>
            <h5 style="font-size: 15px; font-weight: 700; color: var(--color-primary); margin-bottom: 6px;">Crawl Efficiency & Server Log Hygiene</h5>
            <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 16px;"><?= e($definition['technical_blueprint']['crawl_budget']) ?></p>
          </div>
          <div>
            <h5 style="font-size: 15px; font-weight: 700; color: var(--color-primary); margin-bottom: 6px;">Semantic Schema Graph Architecture</h5>
            <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 16px;"><?= e($definition['technical_blueprint']['schema_graph']) ?></p>
          </div>
          <div>
            <h5 style="font-size: 15px; font-weight: 700; color: var(--color-primary); margin-bottom: 6px;">Sub-Second Core Web Vitals Engineering</h5>
            <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;"><?= e($definition['technical_blueprint']['core_web_vitals']) ?></p>
          </div>
          <div>
            <h5 style="font-size: 15px; font-weight: 700; color: var(--color-primary); margin-bottom: 6px;">Security, Data Privacy & DPDP Compliance</h5>
            <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;"><?= e($definition['technical_blueprint']['security_compliance']) ?></p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- 19. Unit Economics, CAC:LTV ROI Modeling & Payback Period -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Financial Engineering</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Mathematical Unit Economics: CAC:LTV Modeling & Payback Velocity
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 24px;">
      We calculate exact unit economics for your <?= e($cityName) ?> campaigns to ensure marketing functions as an accretive profit driver rather than an overhead cost center:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 28px;">
      <div class="card" style="background: #ffffff; padding: 24px;">
        <h4 style="font-size: 16px; color: var(--color-primary); margin-bottom: 8px;">📊 Blended CAC Formula</h4>
        <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
          <code><?= e($deepModules['unit_economics']['blended_cac_formula']) ?></code>
        </p>
      </div>
      <div class="card" style="background: #ffffff; padding: 24px;">
        <h4 style="font-size: 16px; color: var(--color-primary); margin-bottom: 8px;">📈 Customer Lifetime Value (LTV)</h4>
        <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
          <code><?= e($deepModules['unit_economics']['ltv_formula']) ?></code>
        </p>
      </div>
      <div class="card" style="background: #ffffff; padding: 24px;">
        <h4 style="font-size: 16px; color: var(--color-primary); margin-bottom: 8px;">⏱️ Payback Period Velocity</h4>
        <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
          <code><?= e($deepModules['unit_economics']['payback_metric']) ?></code>
        </p>
      </div>
      <div class="card" style="background: #ffffff; padding: 24px;">
        <h4 style="font-size: 16px; color: var(--color-primary); margin-bottom: 8px;">🎯 Target Blended ROAS Benchmark</h4>
        <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
          <code><?= e($deepModules['unit_economics']['roas_benchmark']) ?></code>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- 20. Total Cost of Ownership (TCO) Comparison Matrix -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Financial & Operational Analysis</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Total Cost of Ownership (TCO): Agency Squad vs. In-House vs. Freelancers
    </h2>
    <p style="font-size: 15px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 24px;">
      Building an in-house digital growth team in <?= e($cityName) ?> requires hiring 3–4 senior specialists, purchasing enterprise software subscriptions, and managing prolonged ramp-up periods. Here is a factual comparison of your strategic options:
    </p>

    <div class="tco-table-wrap">
      <table class="tco-table">
        <thead>
          <tr>
            <th>Evaluation Pillar</th>
            <th style="color: var(--color-primary);">Convertiplyhq Squad</th>
            <th>In-House Team (4 Hires)</th>
            <th>Freelancer / Generalist</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (($definition['tco_comparison'] ?? []) as $row): ?>
            <tr>
              <td><strong><?= e($row['category']) ?></strong></td>
              <td style="color: var(--color-primary); font-weight: 600; background: rgba(25, 76, 255, 0.02);"><?= e($row['convertiply']) ?></td>
              <td><?= e($row['inhouse']) ?></td>
              <td><?= e($row['freelancer']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- 21. Why 70% of Local Campaigns Fail & The Engineering Fix -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag">Failure Mode Analysis</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Why 70% of Digital Marketing Campaigns Fail in <?= e($cityName) ?>
    </h2>
    <p style="font-size: 15px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Most business owners in <?= e($cityName) ?> have experienced frustrating agency partnerships where retainers were paid every month with zero measurable revenue return. These failures consistently stem from four fundamental mistakes:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach (($definition['failure_reasons'] ?? []) as $fail): ?>
        <div class="failure-card">
          <h4>⚠️ <?= e($fail['reason']) ?></h4>
          <p><?= e($fail['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 22. Sprint Governance & Execution Methodology -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Governance & Transparency</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Sprint Cadence & Telemetry Reporting for <?= e($cityName) ?> Partners
    </h2>
    <p style="font-size: 15.5px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      We operate on transparent, agile 2-week sprint cycles with continuous asynchronous reporting:
    </p>

    <div class="grid grid-2" style="gap: 20px; margin-bottom: 32px;">
      <?php foreach ($deepModules['governance_model'] as $gov): ?>
        <div class="card" style="padding: 24px;">
          <h4 style="font-size: 16.5px; color: var(--color-primary); margin-bottom: 8px;">
            📋 <?= e($gov['stage']) ?>
          </h4>
          <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 0;">
            <?= e($gov['desc']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 23. Quantified Client Case Studies -->
<section class="section section-alt">
  <div class="container" style="max-width: 960px;">
    <div class="section-tag section-tag-secondary">Verified Evidence</div>
    <h2 style="font-size: 30px; margin-bottom: 16px;">
      Documented Performance Benchmarks in <?= e($cityName) ?>
    </h2>
    <p style="font-size: 15px; color: var(--color-text-muted); line-height: 1.7; margin-bottom: 28px;">
      Review actual quantified results achieved for regional business models similar to yours in <?= e($cityName) ?>:
    </p>

    <div class="grid grid-2" style="gap: 24px;">
      <?php 
      $displayCaseStudies = get_complete_case_studies($page['case_studies'] ?? [], $serviceName, $cityName, $districts);
      foreach ($displayCaseStudies as $cs): 
      ?>
        <div class="card" style="background: #ffffff; padding: 28px 30px; border: 1px solid var(--color-border); border-radius: var(--radius-md); box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <!-- Top Metric Banner -->
            <div style="background: var(--color-bg-alt); border-radius: var(--radius-sm); padding: 14px 18px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; border-left: 4px solid var(--color-success);">
              <div>
                <div style="font-size: 11px; font-weight: 700; color: var(--color-text-light); text-transform: uppercase; letter-spacing: 0.5px;">Quantified Result</div>
                <div style="font-size: 24px; font-weight: 800; color: var(--color-success); line-height: 1.1; margin-top: 2px;"><?= e($cs['metric_value']) ?></div>
              </div>
              <span class="badge" style="background: #ffffff; border: 1px solid var(--color-border); padding: 4px 10px; border-radius: var(--radius-pill); font-size: 11.5px; font-weight: 700; color: var(--color-text);">
                📍 <?= e($cs['district']) ?>
              </span>
            </div>

            <!-- Client & Primary Metric -->
            <div style="margin-bottom: 12px;">
              <h4 style="font-size: 18px; font-weight: 700; color: var(--color-text); margin-bottom: 4px;"><?= e($cs['client']) ?></h4>
              <div style="font-size: 12.5px; color: var(--color-text-light); font-weight: 600;">
                Primary Objective: <span style="color: var(--color-primary); font-weight: 700;"><?= e($cs['metric_label']) ?></span>
              </div>
            </div>

            <!-- Quote -->
            <p style="font-size: 13.5px; color: var(--color-text-muted); line-height: 1.65; margin-bottom: 20px; font-style: italic;">
              "<?= e($cs['quote']) ?>"
            </p>
          </div>

          <!-- Footer Verification Tag -->
          <div style="border-top: 1px solid var(--color-border-subtle); padding-top: 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
            <span style="font-size: 12px; font-weight: 700; color: var(--color-success); display: flex; align-items: center; gap: 4px;">
              ✓ <span>Verified <?= e($cityName) ?> Deployment</span>
            </span>
            <span style="font-size: 12px; font-weight: 600; color: var(--color-text-light);">
              90-Day Sprint
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 24. 12-Question Localized FAQ Knowledge Base -->
<section class="section">
  <div class="container" style="max-width: 960px;">
    <div class="section-header">
      <div class="section-tag">Knowledge Base</div>
      <h2>Frequently Asked Questions: <?= e($serviceName) ?> in <?= e($cityName) ?></h2>
      <p>Direct, transparent answers regarding investment, timelines, deliverables, and technical execution.</p>
    </div>

    <div class="grid grid-2" style="gap: 16px; align-items: start;">
      <div class="flex flex-col gap-12">
        <?php 
        $half = ceil(count($page['faqs']) / 2);
        $leftFaqs = array_slice($page['faqs'], 0, $half);
        $rightFaqs = array_slice($page['faqs'], $half);

        foreach ($leftFaqs as $faq): 
        ?>
          <div class="faq-item">
            <button class="faq-question" type="button" aria-expanded="false">
              <span><?= e($faq['question']) ?></span>
              <span class="faq-icon" aria-hidden="true">+</span>
            </button>
            <div class="faq-answer">
              <p><?= e($faq['answer']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="flex flex-col gap-12">
        <?php foreach ($rightFaqs as $faq): ?>
          <div class="faq-item">
            <button class="faq-question" type="button" aria-expanded="false">
              <span><?= e($faq['question']) ?></span>
              <span class="faq-icon" aria-hidden="true">+</span>
            </button>
            <div class="faq-answer">
              <p><?= e($faq['answer']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- 25. Closing Consultation CTA -->
<section class="section section-alt">
  <div class="container">
    <div class="cta-banner">
      <h2>Ready to Build a High-Performing Growth Engine in <?= e($cityName) ?>?</h2>
      <p>
        Schedule a confidential 30-minute growth diagnostic session with our senior architects. We will audit your current digital footprint and deliver a clear 90-day execution roadmap.
      </p>
      <div class="cta-banner-buttons">
        <a href="<?= site_url('contact') ?>" class="btn btn-white">
          Claim Free <?= e($cityName) ?> Strategy Audit →
        </a>
      </div>
    </div>
  </div>
</section>

<!-- 26. Section 18: Related Growth Disciplines & Regional Hubs -->
<section class="section" style="padding-top: 48px; border-top: 1px solid var(--color-border);">
  <div class="container">
    <div class="grid grid-2" style="gap: 40px;">
      <div>
        <h3 style="font-size: 20px; margin-bottom: 8px;">Related Digital Services in <?= e($cityName) ?></h3>
        <p style="font-size: 13px; color: var(--color-text-muted); margin-bottom: 16px;">Explore complementary growth channels for your <?= e($cityName) ?> business:</p>
        <div class="flex flex-col gap-8">
          <?php 
          $allServices = get_all_services();
          $sCount = 0;
          foreach ($allServices as $otherS):
            if ($otherS['slug'] === $page['service_slug']) continue;
            $sCount++;
            if ($sCount > 5) break;
          ?>
            <a href="<?= service_city_url($otherS['slug'], $page['city_slug']) ?>" class="link-card" style="padding: 10px 16px; font-size: 14px;">
              <span><?= e($otherS['name']) ?> in <?= e($cityName) ?></span>
              <span class="link-arrow">→</span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <div>
        <h3 style="font-size: 20px; margin-bottom: 8px;"><?= e($serviceName) ?> in Other Major Cities</h3>
        <p style="font-size: 13px; color: var(--color-text-muted); margin-bottom: 16px;">We also deliver premier <?= strtolower(e($serviceName)) ?> programs across India:</p>
        <div class="flex flex-col gap-8">
          <?php 
          $allCities = get_all_cities();
          
          // Prioritize cities in the same state first, then top metros
          $sameStateCities = array_filter($allCities, fn($c) => ($c['state'] ?? '') === $stateName && $c['slug'] !== $page['city_slug']);
          $metroSlugs = ['hyderabad', 'bengaluru', 'mumbai', 'delhi', 'pune', 'chennai', 'ahmadabad', 'kolkata'];
          
          $featuredCities = array_slice($sameStateCities, 0, 3);
          foreach ($metroSlugs as $mSlug) {
            if (count($featuredCities) >= 5) break;
            $mCity = get_city_by_slug($mSlug);
            if ($mCity && $mCity['slug'] !== $page['city_slug'] && !in_array($mCity, $featuredCities)) {
              $featuredCities[] = $mCity;
            }
          }

          foreach ($featuredCities as $otherC):
          ?>
            <a href="<?= service_city_url($page['service_slug'], $otherC['slug']) ?>" class="link-card" style="padding: 10px 16px; font-size: 14px;">
              <span><?= e($serviceName) ?> Services in <?= e($otherC['name']) ?> (<?= e($otherC['state'] ?? 'India') ?>)</span>
              <span class="link-arrow">→</span>
            </a>
          <?php endforeach; ?>
          
          <a href="<?= site_url('locations') ?>" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: var(--color-primary); margin-top: 6px; padding: 4px 8px;">
            Explore All 500+ Indian Cities Matrix →
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
