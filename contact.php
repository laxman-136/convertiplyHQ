<?php
/**
 * Convertiplyhq - Contact & Growth Audit Request Page
 * Simple, secure PHP form handler with input sanitization and validation.
 */
require_once __DIR__ . '/includes/config.php';

session_start();

$feedback = null;
$feedbackType = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $budget = trim($_POST['budget'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || !$email || empty($phone)) {
        $feedback = 'Please provide your Name, a valid Work Email, and your Phone Number.';
        $feedbackType = 'error';
    } else {
        // Prepare lead notification (mail fallback or local recording)
        $to = SITE_EMAIL;
        $subject = "New Growth Audit Request: {$name} (" . ($website ?: 'No Domain') . ")";
        $body = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\nService: $service\nCity: $city\nBudget: $budget\nMessage: $message\nIP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown');
        $headers = "From: no-reply@convertiplyhq.com\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

        // Optional standard mail() execution
        @mail($to, $subject, $body, $headers);

        $feedback = "Thank you, {$name}! Your growth audit request has been received. One of our lead engineers will analyze your site and contact you within 24 hours.";
        $feedbackType = 'success';
    }
}

// Read query params for pre-filling
$preService = $_GET['service'] ?? '';
$preCity = $_GET['city'] ?? '';
$preWebsite = $_GET['website'] ?? '';
$preEmail = $_GET['email'] ?? '';
$preTier = $_GET['tier'] ?? '';

$pageSeo = [
    'title' => 'Contact & Free Growth Audit | Convertiplyhq',
    'description' => 'Book your free 30-minute digital marketing strategy and SEO audit with Convertiplyhq. Headquartered in HITEC City, Hyderabad with hubs across India.',
    'canonical' => site_url('contact'),
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => site_url()],
        ['name' => 'Contact & Growth Audit', 'url' => site_url('contact')]
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
      <li class="breadcrumb-item active">Contact & Growth Audit</li>
    </ul>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag section-tag-secondary">Let's Connect</div>
      <h1>Request Your Free 30-Minute Growth Audit</h1>
      <p class="lead">
        Tell us about your business. We will analyze your search rankings, ad spend efficiency, and conversion funnels to deliver an actionable 90-day roadmap.
      </p>
    </div>

    <div class="grid grid-2" style="gap: 48px; align-items: start;">
      <!-- Contact Form Card -->
      <div class="card">
        <?php if ($feedback): ?>
          <div class="form-feedback <?= $feedbackType ?>">
            <?= e($feedback) ?>
          </div>
        <?php endif; ?>

        <?php if ($feedbackType !== 'success'): ?>
          <form action="<?= site_url('contact') ?>" method="POST" id="contactForm">
            <div class="grid grid-2" style="gap: 16px;">
              <div class="form-group">
                <label class="form-label" for="name">Your Name *</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Alex Morgan" required>
              </div>

              <div class="form-group">
                <label class="form-label" for="email">Work Email *</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= e($preEmail) ?>" placeholder="alex@company.com" required>
              </div>
            </div>

            <div class="grid grid-2" style="gap: 16px;">
              <div class="form-group">
                <label class="form-label" for="phone">Phone / WhatsApp *</label>
                <input type="tel" id="phone" name="phone" class="form-control" placeholder="+91 98765 43210" required>
              </div>

              <div class="form-group">
                <label class="form-label" for="website">Company Website / Domain</label>
                <input type="text" id="website" name="website" class="form-control" value="<?= e($preWebsite) ?>" placeholder="yourcompany.com">
              </div>
            </div>

            <div class="grid grid-2" style="gap: 16px;">
              <div class="form-group">
                <label class="form-label" for="service">Interested Service</label>
                <select id="service" name="service" class="form-control">
                  <option value="">Select Service Category...</option>
                  <?php foreach (get_all_services() as $s): ?>
                    <option value="<?= e($s['slug']) ?>" <?= ($preService === $s['slug']) ? 'selected' : '' ?>>
                      <?= e($s['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label" for="city">Target Region / City</label>
                <select id="city" name="city" class="form-control">
                  <option value="">Select Target City...</option>
                  <?php foreach (get_all_cities() as $c): ?>
                    <option value="<?= e($c['slug']) ?>" <?= ($preCity === $c['slug']) ? 'selected' : '' ?>>
                      <?= e($c['name']) ?> (<?= e($c['state']) ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="budget">Estimated Monthly Marketing Budget</label>
              <select id="budget" name="budget" class="form-control">
                <option value="under-50k">Under ₹50,000 / month</option>
                <option value="50k-150k" selected>₹50,000 - ₹1,50,000 / month</option>
                <option value="150k-500k">₹1,50,000 - ₹5,00,000 / month</option>
                <option value="500k-plus">₹5,00,000+ / month (Enterprise)</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="message">What is your primary growth bottleneck?</label>
              <textarea id="message" name="message" class="form-control" placeholder="Describe your current challenge (e.g. rising ad costs, ranking drops, landing page conversion drop-offs)..."><?= $preTier ? "Interested in {$preTier} package." : "" ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="padding: 14px 32px; font-size: 17px;">
              Submit Audit Request →
            </button>
            <p style="font-size: 12px; color: var(--color-text-light); text-align: center; margin-top: 12px; margin-bottom: 0;">
              🔒 100% Confidential. NDA available on request. No hard sell.
            </p>
          </form>
        <?php endif; ?>
      </div>

      <!-- Agency Contact Details & Hubs -->
      <div>
        <div class="card card-tint" style="margin-bottom: 24px;">
          <h3 style="font-size: 20px; margin-bottom: 16px;">Direct Agency Access</h3>
          
          <div style="display: flex; flex-direction: column; gap: 16px; font-size: 15px;">
            <div>
              <strong>📍 Main Headquarters:</strong>
              <p style="margin-bottom: 0; margin-top: 4px;"><?= e(SITE_ADDRESS) ?></p>
            </div>

            <div>
              <strong>📞 Direct Phone:</strong>
              <p style="margin-bottom: 0; margin-top: 4px;">
                <a href="tel:<?= urlencode(SITE_PHONE) ?>" style="font-weight: 600; color: var(--color-primary);"><?= e(SITE_PHONE) ?></a>
                <span style="font-size: 13px; color: var(--color-text-light);"> (Mon - Fri, 9:30 AM - 6:30 PM IST)</span>
              </p>
            </div>

            <div>
              <strong>✉️ Strategy Inquiries:</strong>
              <p style="margin-bottom: 0; margin-top: 4px;">
                <a href="mailto:<?= e(SITE_EMAIL) ?>" style="font-weight: 600; color: var(--color-primary);"><?= e(SITE_EMAIL) ?></a>
              </p>
            </div>
          </div>
        </div>

        <div class="card">
          <h3 style="font-size: 18px; margin-bottom: 12px;">Our Key Regional Hubs</h3>
          <p style="font-size: 14px; margin-bottom: 16px;">We operate distributed squads across major tech and enterprise corridors:</p>
          
          <div class="grid grid-2" style="gap: 10px;">
            <div class="district-badge">🏢 Hyderabad (HITEC City)</div>
            <div class="district-badge">🏢 Bengaluru (HSR Layout)</div>
            <div class="district-badge">🏢 Mumbai (BKC)</div>
            <div class="district-badge">🏢 Delhi NCR (Cyber City)</div>
            <div class="district-badge">🏢 Pune (Hinjawadi)</div>
            <div class="district-badge">🏢 Chennai (OMR)</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
