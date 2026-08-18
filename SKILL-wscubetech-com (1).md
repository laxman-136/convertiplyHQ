---
name: design-wscubetech-com
description: Design system extracted from WsCube Tech (https://www.wscubetech.com/marketing). Use when building UI that should match this brand's visual identity.
triggers:
  - "WsCube Tech"
  - "wscubetech-com"
  - "design like WsCube Tech"
  - "WsCube Tech風"
source: https://www.wscubetech.com/marketing
extractedAt: 2026-08-17T16:32:32.799Z
tags: ["light", "rounded", "colorful", "sans-serif"]
---
# Design System Inspired by WsCube Tech

> Auto-extracted from `https://www.wscubetech.com/marketing` on 2026-08-17

## 1. Visual Theme & Atmosphere

Friendly, approachable design with rounded shapes and generous whitespace.

The hero section leads with "Get Job-ready for Digital Marketing Roles".

**Key Characteristics:**
- Inter as the heading font
- Inter as the body font for all running text
- Heading weight 600
- Light/white background (#ffffff) as the primary canvas
- Primary accent `#194cff` used for CTAs and brand highlights
- 3 shadow level(s) detected — standard shadows
- Rounded corners (8px+) creating a friendly, approachable feel
- Tags: light, rounded, colorful, sans-serif

## 2. Color Palette & Roles

### Primary
- **Primary Accent** (`#194cff`) · `--color-primary`: Brand color, CTA backgrounds, link text, interactive highlights.
- **Secondary Accent** (`#0d6efd`) · `--color-secondary`: Secondary brand, hover states, complementary highlights.
- **Background** (`#ffffff`) · `--color-bg`: Page background, primary canvas.
- **Background Secondary** (`#fff5e6`) · `--color-bg-secondary`: Cards, surfaces, alternating sections.

### Text
- **Text Primary** (`#212529`) · `--color-text`: Headings and body text.
- **Text Secondary** (`#374151`) · `--color-text-secondary`: Muted text, captions, placeholders.

### Borders & Surfaces
- **Border** (`#f3f4f6`) · `--color-border`: Dividers, outlines, input borders.

### Full Extracted Palette

| # | Hex | CSS Variable | Role | Area | Contrast |
|---|---|---|---|---|---|
| 1 | `#ffffff` | `--palette-1` | section | large | text-dark |
| 2 | `#fff5e6` | `--palette-2` | button | medium | text-dark |
| 3 | `#f3f4f6` | `--palette-3` | button | medium | text-dark |
| 4 | `#194cff` | `--palette-4` | text-accent | medium | text-light |
| 5 | `#fdbd56` | `--palette-5` | button | small | text-dark |
| 6 | `#0d6efd` | `--palette-6` | text-accent | small | text-light |
| 7 | `#fc9c03` | `--palette-7` | button | small | text-dark |
| 8 | `#2f2f27` | `--palette-8` | badge | small | text-light |
| 9 | `#f65555` | `--palette-9` | badge | small | text-dark |
| 10 | `#374151` | `--palette-10` | text-accent | small | text-light |
| 11 | `#96acf6` | `--palette-11` | text-accent | small | text-dark |

## 3. Typography Rules

- **Heading Font:** `Inter`, sans-serif
- **Body Font:** `Inter`, sans-serif

### Type Hierarchy

| Role | Font | Size | Weight | Line Height | Letter Spacing |
|---|---|---|---|---|---|
| H1 | Inter | 40px | 600 | 48px | normal |
| H2 | Inter | 32px | 700 | 48px | normal |
| H3 | Inter | 20px | 600 | 30px | normal |
| Body | Inter | 18px | 400 | 24px | normal |

### Type Scale

| Token | Size | Suggested Usage |
|---|---|---|
| Display | `40px` | headings |
| H1 | `32px` | headings |
| H2 | `25px` | headings |
| H3 | `22px` | headings |
| H4 | `20px` | headings |
| Body L | `18px` | body / supporting text |
| Body | `16px` | body / supporting text |
| Small | `15px` | body / supporting text |
| XS | `14px` | body / supporting text |
| Caption | `12px` | body / supporting text |

## 4. Component Stylings

### Primary Button

```css
.btn-primary {
  background: transparent;
  color: #111827;
  border-radius: 8px;
  padding: 8px 15px;
  font-size: 14px;
  font-weight: 400;
  border: 1px solid rgba(107, 114, 128, 0.4);
  cursor: pointer;
}
```

### Ghost Button

```css
.btn-ghost {
  background: transparent;
  color: #0d6efd;
  border-radius: 0px;
  padding: 0px 0px;
  font-size: 16px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

### Ghost Button 2

```css
.btn-ghost-2 {
  background: transparent;
  color: #212529;
  border-radius: 6px;
  padding: 0px 0px;
  font-size: 16px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

### Filled Button

```css
.btn-filled {
  background: #194cff;
  color: #ffffff;
  border-radius: 8px;
  padding: 1px 6px;
  font-size: 14px;
  font-weight: 600;
  border: 1px solid rgb(25, 76, 255);
  cursor: pointer;
}
```

### Filled Button 2

```css
.btn-filled-2 {
  background: #ffffff;
  color: #111827;
  border-radius: 8px;
  padding: 1px 6px;
  font-size: 14px;
  font-weight: 600;
  border: 1px solid rgb(209, 213, 219);
  cursor: pointer;
}
```

### Ghost Button 3

```css
.btn-ghost-3 {
  background: transparent;
  color: #ffffff;
  border-radius: 0px;
  padding: 0px 0px;
  font-size: 20px;
  font-weight: 600;
  border: none;
  cursor: pointer;
}
```

### Card

```css
.card {
  background: #000000;
  border-radius: 12px;
  padding: 12px;
}
```

## 5. Layout Principles

- **Base spacing unit:** `12px` — use multiples (24px, 36px, 48px, etc.)

### Spacing Scale (extracted from real elements)

| Token | Value | Role |
|---|---|---|
| spacing-1 | `12px` | element |
| spacing-2 | `16px` | element |
| spacing-3 | `8px` | element |
| spacing-4 | `1px` | element |
| spacing-5 | `20px` | element |
| spacing-6 | `80px` | section |
| spacing-7 | `2px` | element |
| spacing-8 | `32px` | card |

### Border Radius Scale

| Token | Value | Element |
|---|---|---|
| radius-button | `8px` | button |
| radius-button | `12px` | button |
| radius-card | `50px` | card |
| radius-card | `40px` | card |
| radius-card | `16px` | card |
| radius-card | `20px` | card |

## 6. Depth & Elevation

| Level | Shadow | Usage |
|---|---|---|
| Low | `rgb(255, 255, 255) 0px 2px 3px 0px inset` | Cards, subtle elevation |
| Low | `rgb(17, 24, 39) 4px 4px 0px 0px` | Cards, subtle elevation |
| Mid | `rgba(0, 0, 0, 0.09) 0px 4px 9px 0px` | Dropdowns, popovers |


## 7. Do's and Don'ts

### Do
- Use `#ffffff` as the primary background color
- Use `Inter` for all headings and `Inter` for body text
- Use `#194cff` as the single dominant accent/CTA color
- Maintain `12px` as the base spacing unit — all gaps should be multiples
- Use rounded corners (`8px`+) consistently for all interactive elements
- Embrace bold color combinations — playful energy is the point
- Apply the shadow system for elevation — use the extracted shadow values
- Use weight 600 for headings to match the brand's typographic voice

### Don't
- Don't use colors outside the extracted palette without justification
- Don't substitute Inter/Inter with generic alternatives
- Don't use irregular spacing — stick to 12px grid
- Don't use dark/black backgrounds — this is a light-themed design
- Don't use sharp corners — they feel hostile in this rounded design language
- Don't use pure black (#000000) for text — use `#212529` instead
- Don't add decorative elements not present in the original design — no badges, ribbons, banners, or ornaments unless the source site uses them
- Don't invent UI patterns the source site doesn't have — if the original has no NEW badge, don't add one just because a red is in the palette

## 8. Responsive Behavior

| Breakpoint | Width | Notes |
|---|---|---|
| Mobile | < 640px | Single column, stack sections, reduce font sizes ~80% |
| Tablet | 640–1024px | 2-column where appropriate, maintain spacing ratios |
| Desktop | 1024–1440px | Full layout as designed |
| Wide | > 1440px | Max-width container, center content |

- Touch targets: minimum 44×44px on mobile
- Maintain 12px base unit across breakpoints — only scale multipliers

## 9. Agent Prompt Guide

### Quick Color Reference

```
Background:  #ffffff
Text:        #212529
Accent:      #194cff
Secondary:   #0d6efd
Border:      #f3f4f6
```

### Example Prompts

1. "Build a hero section with a `#ffffff` background, `Inter` heading in `#212529`, and a `#194cff` CTA button with 8px radius."
2. "Create a pricing card using background `#fff5e6`, border `#f3f4f6`, `Inter` for text, and 36px padding."
3. "Design a navigation bar — `#ffffff` background, `#212529` links, `#194cff` for active state."
4. "Build a feature grid with 3 columns, 36px gap, each card using the card component style."
5. "Create a footer with `#212529` background, `#ffffff` text, and 24px padding."

### Iteration Guide

1. Start with layout structure (sections, grid, spacing)
2. Apply colors from the palette — background first, then text, then accents
3. Set typography — font families, sizes from the type scale, weights
4. Add components — buttons, cards, inputs using the specs above
5. Apply border-radius consistently across all elements
6. Add shadows for depth — use the extracted shadow values, not defaults
7. Check responsive behavior — test mobile and tablet layouts
8. Final pass — verify all colors match, spacing is consistent, fonts are correct

## 10. CSS Custom Properties

> 130 custom properties extracted from `:root` / `html` stylesheets.

### Color Variables

| Variable | Value |
|---|---|
| `--label-color-1` | `#111827` |
| `--label-color-2` | `#fff` |
| `--label-color-3` | `#194cff` |
| `--label-color-4` | `#1e88e5` |
| `--label-color-5` | `#ffffd6` |
| `--label-color-6` | `#ffedea` |
| `--label-color-7` | `#4b5563` |
| `--label-color-8` | `#e3e0f3` |
| `--label-color-9` | `#dbf5f0` |
| `--label-color-10` | `#6b7280` |
| `--label-color-11` | `#f65555` |
| `--label-color-12` | `#e5ffff` |
| `--label-color-13` | `#ffedfd` |
| `--label-color-14` | `#fef9f5` |
| `--label-color-15` | `#667085` |
| `--label-color-16` | `#101828` |
| `--label-color-17` | `#1f2937` |
| `--label-color-18` | `#f8db46` |
| `--label-color-19` | `#f5f7ff` |
| `--label-color-20` | `#18181b` |
| `--label-color-21` | `#faf3e4` |
| `--label-color-22` | `#ffffff33` |
| `--label-color-23` | `#0c1e5e` |
| `--label-color-24` | `#fc9c03` |
| `--label-color-25` | `#fdb035` |
| `--label-color-27` | `#ff9b26` |
| `--label-color-28` | `#9ca3af` |
| `--label-color-29` | `#f3f4f6` |
| `--label-color-30` | `#a7b9ff` |
| `--label-color-31` | `#fff5e6` |
| ... | *(68 more)* |

### Spacing Variables

| Variable | Value |
|---|---|
| `--bs-breakpoint-xs` | `0` |
| `--bs-breakpoint-sm` | `576px` |
| `--bs-breakpoint-md` | `768px` |
| `--bs-breakpoint-lg` | `992px` |
| `--bs-breakpoint-xl` | `1200px` |
| `--bs-breakpoint-xxl` | `1400px` |
| `--toastify-toast-width` | `320px` |
| `--toastify-toast-offset` | `16px` |
| `--toastify-toast-min-height` | `64px` |
| `--toastify-toast-max-height` | `800px` |
| `--toastify-toast-bd-radius` | `6px` |
| `--toastify-z-index` | `9999` |
| `--toastify-color-progress-bgo` | `0.2` |
| `--apollo-sidebar-button-size` | `40px` |
| `--apollo-sidebar-icon-size` | `20px` |
| `--apollo-sidebar-hover-opacity` | `0.8` |
| `--apollo-sidebar-z-input` | `2` |
| `--apollo-sidebar-z-icon` | `1` |

### Typography Variables

| Variable | Value |
|---|---|
| `--toastify-font-family` | `sans-serif` |

### Other Variables

| Variable | Value |
|---|---|
| `--toastify-icon-color-info` | `var(--toastify-color-info)` |
| `--toastify-icon-color-success` | `var(--toastify-color-success)` |
| `--toastify-icon-color-warning` | `var(--toastify-color-warning)` |
| `--toastify-icon-color-error` | `var(--toastify-color-error)` |
| `--toastify-toast-top` | `max(var(--toastify-toast-offset),env(safe-area-inset-top))` |
| `--toastify-toast-right` | `max(var(--toastify-toast-offset),env(safe-area-inset-right))` |
| `--toastify-toast-left` | `max(var(--toastify-toast-offset),env(safe-area-inset-left))` |
| `--toastify-toast-bottom` | `max(var(--toastify-toast-offset),env(safe-area-inset-bottom))` |
| `--toastify-color-progress-info` | `var(--toastify-color-info)` |
| `--toastify-color-progress-success` | `var(--toastify-color-success)` |
| `--toastify-color-progress-warning` | `var(--toastify-color-warning)` |
| `--toastify-color-progress-error` | `var(--toastify-color-error)` |
| `--apollo-sidebar-transition` | `all 0.2s ease` |
