<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/deep-content-engine.php';

$page = get_programmatic_page('seo', 'hyderabad');
$serviceName = $page['service'];
$serviceFullName = $page['service_full_name'];
$cityName = $page['city'];
$stateName = $page['state'];

$definition = get_service_definition($page['service_slug']);
$districts = $page['city_data']['keyDistricts'] ?? ['HITEC City', 'Gachibowli', 'Madhapur', 'Banjara Hills'];
$districtProfiles = get_district_profiles($districts, $cityName);
$deepModules = get_deep_content_modules($page['service_slug'], $page['city_slug'], $serviceName, $cityName, $stateName);
$industryPlaybooks = get_tailored_industry_playbooks($page['service_slug'], $cityName, $serviceName);
$caseStudies = get_complete_case_studies($page['case_studies'] ?? [], $serviceName, $cityName, $districts);

$md = "# Data-Driven {$serviceName} Services in {$cityName}\n\n";
$md .= "**Location:** {$cityName}, {$stateName} | **Active Market SMEs:** " . ($page['city_data']['activeSMEs'] ?? '140,000+') . " | **Typical Investment:** {$page['avg_price_range']} | **Growth Horizon:** 90-Day Sprint\n\n";

$md .= "## Executive Summary\n";
$md .= "We build revenue-focused " . strtolower($serviceName) . " engines tailored to {$cityName}'s commercial landscape. We combine clean code, sub-second mobile page speeds, and direct CRM pipeline attribution so you know exactly which keywords turn into closed customer contracts.\n\n";

$md .= "## Core Technical Framework & Engineering Philosophy\n";
$md .= ($definition['philosophy'] ?? "Most agencies sell vanity metrics like rankings and impressions. We don't. We care about pipeline, cost-per-acquisition (CAC), and customer lifetime value (LTV). If your digital marketing doesn't generate qualified sales opportunities, it isn't working.") . "\n\n";
$md .= "For growing companies in {$cityName}, winning commercial search traffic takes more than basic keyword insertion. You need technical site speed that satisfies Google's Core Web Vitals, deep subject coverage that answers every buyer question, and clear conversion paths that turn visitors into booked meetings.\n\n";
$md .= "Instead of guessing, we connect Google Analytics directly to your CRM. You get full visibility into every sales lead, where they came from, and what it cost to win them.\n\n";

$md .= "## 7 Critical Algorithmic Ranking & Performance Mechanics\n";
foreach (($definition['algorithmic_mechanics'] ?? []) as $mech) {
    $md .= "### " . $mech['name'] . "\n";
    $md .= $mech['desc'] . "\n\n";
}

$md .= "## Commercial District & Micro-Market Dynamics in {$cityName}\n";
$md .= "{$cityName} represents a dynamic commercial landscape with over " . ($page['city_data']['activeSMEs'] ?? '140,000+') . " active registered businesses competing across key regional sectors. Effective digital execution must account for the distinct commercial characteristics of {$cityName}'s primary business hubs:\n\n";
foreach ($districtProfiles as $dp) {
    $md .= "### " . $dp['name'] . " (" . $dp['tag'] . ")\n";
    $md .= $dp['summary'] . "\n";
    $md .= "- **Target Demographics:** " . $dp['demographics'] . "\n";
    $md .= "- **Execution Tactics:** " . $dp['tactics'] . "\n";
    $md .= "- **Priority Focus:** " . $dp['focus'] . "\n\n";
}

$md .= "## High-Intent Keyword Clustering & Search Volume in {$cityName}\n";
$md .= "Understanding how decision-makers in {$cityName} search for " . strtolower($serviceName) . " solutions is fundamental to capturing high-value commercial pipeline. We categorize regional search queries across four distinct intent tiers:\n\n";
foreach ($deepModules['keyword_matrix'] as $cluster) {
    $md .= "### " . $cluster['cluster'] . " (" . $cluster['funnel_stage'] . " | Avg Conversion: " . $cluster['conversion_rate'] . ")\n";
    $md .= "**Intent Profile:** " . $cluster['intent'] . "\n";
    $md .= "**Target Search Queries:**\n";
    foreach ($cluster['queries'] as $q) {
        $md .= "- `{$q}`\n";
    }
    $md .= "\n";
}

$md .= "## Lead Scoring & Pipeline Qualification Architecture\n";
$md .= "Marketing success is measured by closed revenue, not vanity form fills. We deploy a multi-dimensional lead scoring framework for your {$cityName} campaigns:\n\n";
foreach ($deepModules['lead_scoring_framework'] as $ls) {
    $md .= "### " . $ls['pillar'] . "\n";
    $md .= "- **Qualification Rules:** " . $ls['criteria'] . "\n";
    $md .= "- **Sales Pipeline Impact:** " . $ls['impact'] . "\n\n";
}

$md .= "## Interconnected Omnichannel Growth Flywheel\n";
foreach ($deepModules['channel_flywheel'] as $cf) {
    $md .= "### " . $cf['channel'] . "\n";
    $md .= $cf['role'] . "\n\n";
}

$md .= "## 12-Month Phased Growth Operating System\n";
foreach (($definition['phased_roadmap'] ?? []) as $step) {
    $md .= "### " . $step['phase'] . ": " . $step['title'] . "\n";
    $md .= $step['summary'] . "\n";
    $md .= "- **Core Sprint Milestones:** Verified technical health score > 95%, indexation validation, monthly ranking reports, and bi-weekly attribution reviews.\n\n";
}

$md .= "## Industry Specialization: How {$serviceName} Executes Across 5 Major {$cityName} Industries\n";
foreach ($industryPlaybooks as $ind) {
    $md .= "### " . $ind['industry'] . " (" . $ind['badge'] . ")\n";
    $md .= "- **Sector Challenge:** " . $ind['challenge'] . "\n";
    $md .= "- **Growth Playbook:** " . $ind['strategy'] . "\n";
    $md .= "- **Benchmark Target:** " . $ind['kpi'] . "\n\n";
}

$md .= "## Forensic Technical Specifications & Scope of Work (SOW)\n";
foreach ($deepModules['technical_specifications'] as $sow) {
    $md .= "### " . $sow['title'] . "\n";
    $md .= "- **Objective:** " . $sow['objective'] . "\n";
    $md .= "- **Technical Scope:** " . $sow['scope'] . "\n";
    $md .= "- **Specialized Tooling:** " . $sow['tools'] . "\n";
    $md .= "- **Delivered Artifact:** " . $sow['artifact'] . "\n\n";
}

$md .= "## 90-Day Implementation Scorecard & Milestone Matrix\n";
foreach ($deepModules['scorecard_milestones'] as $score) {
    $md .= "### " . $score['timeline'] . ": " . $score['title'] . "\n";
    $md .= $score['deliverables'] . "\n\n";
}

$md .= "## Conversion Rate Optimization (CRO) & Psychological Persuasion Principles\n";
foreach ($deepModules['cro_psychology_principles'] as $cro) {
    $md .= "### " . $cro['name'] . "\n";
    $md .= $cro['desc'] . "\n\n";
}

$md .= "## Multi-Touch Pipeline Attribution Modeling\n";
foreach ($deepModules['attribution_deep_dive'] as $att) {
    $md .= "### " . $att['model'] . "\n";
    $md .= "- **Telemetry Role:** " . $att['role'] . "\n";
    $md .= "- **Executive Utility:** " . $att['utility'] . "\n\n";
}

$md .= "## Defensive Competitive Moats in {$cityName}\n";
foreach ($deepModules['competitive_moat'] as $moat) {
    $md .= "### " . $moat['pillar'] . "\n";
    $md .= $moat['action'] . "\n\n";
}

$md .= "## Regulatory Compliance & Marketing Ethics Manifesto\n";
foreach ($deepModules['compliance_manifesto'] as $comp) {
    $md .= "### " . $comp['standard'] . "\n";
    $md .= $comp['description'] . "\n\n";
}

$md .= "## Key Performance Indicators (KPI) & Terminology Guide\n";
foreach ($deepModules['kpi_glossary'] as $kpi) {
    $md .= "### " . $kpi['term'] . "\n";
    $md .= $kpi['definition'] . "\n\n";
}

$md .= "## Mathematical Unit Economics: CAC:LTV Modeling & Payback Velocity\n";
$md .= "- **Blended CAC Formula:** `" . $deepModules['unit_economics']['blended_cac_formula'] . "`\n";
$md .= "- **Customer Lifetime Value (LTV):** `" . $deepModules['unit_economics']['ltv_formula'] . "`\n";
$md .= "- **Payback Period Velocity:** `" . $deepModules['unit_economics']['payback_metric'] . "`\n";
$md .= "- **Target Blended ROAS Benchmark:** `" . $deepModules['unit_economics']['roas_benchmark'] . "`\n\n";

$md .= "## Total Cost of Ownership (TCO) Comparison Matrix\n\n";
$md .= "| Evaluation Pillar | Convertiplyhq Squad | In-House Team (4 Hires) | Freelancer / Generalist |\n";
$md .= "| :--- | :--- | :--- | :--- |\n";
foreach (($definition['tco_comparison'] ?? []) as $row) {
    $md .= "| " . $row['category'] . " | " . $row['convertiply'] . " | " . $row['inhouse'] . " | " . $row['freelancer'] . " |\n";
}
$md .= "\n";

$md .= "## Why 70% of Digital Marketing Campaigns Fail in {$cityName}\n";
foreach (($definition['failure_reasons'] ?? []) as $fail) {
    $md .= "### ⚠️ " . $fail['reason'] . "\n";
    $md .= $fail['desc'] . "\n\n";
}

$md .= "## Sprint Cadence & Telemetry Reporting\n";
foreach ($deepModules['governance_model'] as $gov) {
    $md .= "### " . $gov['stage'] . "\n";
    $md .= $gov['desc'] . "\n\n";
}

$md .= "## Documented Performance Benchmarks in {$cityName}\n";
foreach ($caseStudies as $cs) {
    $md .= "### " . $cs['client'] . " (" . $cs['district'] . ")\n";
    $md .= "- **Key Quantified Result:** " . $cs['metric_value'] . "\n";
    $md .= "- **Primary Objective:** " . $cs['metric_label'] . "\n";
    $md .= "- **Executive Quote:** \"" . $cs['quote'] . "\"\n\n";
}

$md .= "## Frequently Asked Questions: {$serviceName} in {$cityName}\n";
foreach ($page['faqs'] as $faq) {
    $md .= "### " . $faq['question'] . "\n";
    $md .= $faq['answer'] . "\n\n";
}

$outputPath = __DIR__ . '/../sample_page_content_hyderabad_seo.md';
file_put_contents($outputPath, $md);

$words = str_word_count(strip_tags($md));
echo "Generated editorial markdown file at sample_page_content_hyderabad_seo.md ({$words} words)\n";
