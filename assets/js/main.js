/**
 * Convertiplyhq - Lightweight Vanilla JS
 * Zero external frameworks, fast, accessible.
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Navigation Toggle
  const navToggle = document.getElementById('navToggle');
  const navMenu = document.getElementById('navMenu');

  if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('open');
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!navToggle.contains(e.target) && !navMenu.contains(e.target) && navMenu.classList.contains('open')) {
        navMenu.classList.remove('open');
        navToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // 1.1 Mega Menu Grace Period & Click Management
  const dropdownItem = document.querySelector('.has-dropdown');
  let hideTimeout = null;

  if (dropdownItem) {
    const navLink = dropdownItem.querySelector('.nav-link');

    dropdownItem.addEventListener('mouseenter', () => {
      clearTimeout(hideTimeout);
      dropdownItem.classList.add('is-open');
    });

    dropdownItem.addEventListener('mouseleave', () => {
      hideTimeout = setTimeout(() => {
        dropdownItem.classList.remove('is-open');
      }, 250);
    });

    if (navLink) {
      navLink.addEventListener('click', (e) => {
        if (window.innerWidth <= 1024) {
          e.preventDefault();
          dropdownItem.classList.toggle('open');
        }
      });
    }
  }

  // 2. FAQ Accordions
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach((item) => {
    const questionBtn = item.querySelector('.faq-question');
    if (questionBtn) {
      questionBtn.addEventListener('click', () => {
        const isActive = item.classList.contains('active');
        
        // Optional: close other open items in the same list
        faqItems.forEach((other) => {
          if (other !== item) other.classList.remove('active');
        });

        item.classList.toggle('active', !isActive);
      });
    }
  });

  // 3. Interactive Pricing & ROI Estimator (Modular block)
  const serviceSelect = document.getElementById('calcService');
  const spendSelect = document.getElementById('calcSpend');
  const calcOutput = document.getElementById('calcOutput');
  const calcDeliverables = document.getElementById('calcDeliverables');

  function updateCalculator() {
    if (!serviceSelect || !spendSelect || !calcOutput) return;

    const service = serviceSelect.value;
    const stage = spendSelect.value;

    let estimate = '₹35,000 / mo';
    let deliverables = 'Includes full strategy audit, conversion tracking, and monthly execution sprints.';

    if (stage === 'startup') {
      if (service === 'seo') {
        estimate = '₹35,000 / mo';
        deliverables = 'Target 15 commercial keywords, Google Business Profile optimization, 2 high-DR editorial backlinks/mo.';
      } else if (service === 'google-ads-ppc') {
        estimate = '₹30,000 / mo';
        deliverables = 'Search campaign build, negative keyword audit, 2 dedicated landing page variants, conversion tracking.';
      } else if (service === 'web-design') {
        estimate = '₹35,000 (one-time)';
        deliverables = 'High-converting custom landing page, sub-second speed optimization, CRM webhook integration.';
      } else {
        estimate = '₹30,000 / mo';
        deliverables = 'Core behavioral nurture sequences, audience segmentation, bi-weekly performance reporting.';
      }
    } else if (stage === 'growth') {
      if (service === 'seo') {
        estimate = '₹75,000 / mo';
        deliverables = 'Target 45 commercial keywords, Core Web Vitals remediation, Programmatic SEO, 6 editorial backlinks/mo.';
      } else if (service === 'google-ads-ppc') {
        estimate = '₹65,000 / mo';
        deliverables = 'Omni-channel Search, PMax & YouTube, 4 dedicated A/B landing pages, enhanced server-side tracking.';
      } else if (service === 'web-design') {
        estimate = '₹85,000 (one-time)';
        deliverables = 'Full 10-page modern business site, programmatic SEO template engine, interactive forms & GA4.';
      } else {
        estimate = '₹60,000 / mo';
        deliverables = 'Full multi-channel creative testing, 8 advanced behavioral flows, and custom lead routing.';
      }
    } else if (stage === 'enterprise') {
      if (service === 'seo') {
        estimate = '₹1,50,000 / mo';
        deliverables = 'Unlimited keyword clusters, dedicated technical SEO squad, GEO / AI search citations, 15+ Tier-1 links.';
      } else if (service === 'google-ads-ppc') {
        estimate = '10% Ad Spend (Min ₹1,20,000)';
        deliverables = 'Multi-account enterprise media buying, real-time CRM revenue sync, custom video creative pipeline.';
      } else if (service === 'web-design') {
        estimate = '₹1,80,000+ (custom)';
        deliverables = 'Bespoke web application UI/UX, advanced programmatic SEO matrix, CRM & payment API integrations.';
      } else {
        estimate = '₹1,20,000+ / mo';
        deliverables = 'Full omni-platform dominance, daily creative sprints, dedicated strategist and 24/7 Slack war room.';
      }
    }

    calcOutput.textContent = estimate;
    if (calcDeliverables) {
      calcDeliverables.textContent = deliverables;
    }
  }

  if (serviceSelect && spendSelect) {
    serviceSelect.addEventListener('change', updateCalculator);
    spendSelect.addEventListener('change', updateCalculator);
    updateCalculator();
  }

  // 4. Contact Form Validation and UX
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      const name = contactForm.querySelector('[name="name"]');
      const email = contactForm.querySelector('[name="email"]');
      const phone = contactForm.querySelector('[name="phone"]');

      if (!name.value.trim() || !email.value.trim() || !phone.value.trim()) {
        e.preventDefault();
        alert('Please fill in all required fields (Name, Email, and Phone) before submitting.');
        return;
      }
    });
  }
});
