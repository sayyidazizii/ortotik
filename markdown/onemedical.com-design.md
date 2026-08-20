---
version: alpha
name: One Medical Calm
description: A bright, editorial healthcare system with warm neutrals, confident blue accents, and an approachable premium tone.
colors:
  primary: "#0578FF"
  primary-contrast: "#004D49"
  secondary: "#2A2927"
  tertiary: "#FFC776"
  neutral: "#FFEDCE"
  surface: "#FFFFFF"
  on-surface: "#2A2927"
  border: "#E5E7EB"
  accent: "#00A08A"
  error: "#D64545"
typography:
  headline-display:
    fontFamily: "GT Super Display"
    fontSize: "72px"
    fontWeight: 500
    lineHeight: 1
    letterSpacing: "0px"
  headline-lg:
    fontFamily: "GT Super Display"
    fontSize: "60px"
    fontWeight: 500
    lineHeight: "64px"
    letterSpacing: "0px"
  headline-md:
    fontFamily: "GT Super Display"
    fontSize: "24px"
    fontWeight: 500
    lineHeight: "32px"
    letterSpacing: "0px"
  headline-sm:
    fontFamily: "Ginto"
    fontSize: "18px"
    fontWeight: 500
    lineHeight: "22px"
    letterSpacing: "0px"
  body-lg:
    fontFamily: "Ginto"
    fontSize: "18px"
    fontWeight: 200
    lineHeight: 1.7
    letterSpacing: "0px"
  body-md:
    fontFamily: "Ginto"
    fontSize: "16px"
    fontWeight: 200
    lineHeight: "31.5px"
    letterSpacing: "0px"
  body-sm:
    fontFamily: "Ginto"
    fontSize: "14px"
    fontWeight: 300
    lineHeight: 1.5
    letterSpacing: "0px"
  label-lg:
    fontFamily: "Ginto"
    fontSize: "16px"
    fontWeight: 600
    lineHeight: 1.2
    letterSpacing: "0px"
  label-md:
    fontFamily: "Ginto"
    fontSize: "14px"
    fontWeight: 600
    lineHeight: 1.2
    letterSpacing: "0px"
  label-sm:
    fontFamily: "Ginto"
    fontSize: "12px"
    fontWeight: 600
    lineHeight: 1.2
    letterSpacing: "0.08em"
  caption:
    fontFamily: "Ginto"
    fontSize: "12px"
    fontWeight: 300
    lineHeight: 1.4
    letterSpacing: "0px"
rounded:
  none: 0px
  sm: 4px
  md: 8px
  lg: 18px
  xl: 36px
  full: 9999px
spacing:
  xs: 6px
  sm: 18px
  md: 32px
  lg: 56px
  xl: 80px
components:
  button-primary:
    backgroundColor: "{colors.tertiary}"
    textColor: "{colors.primary-contrast}"
    typography: "{typography.label-lg}"
    rounded: "{rounded.full}"
    padding: "16px 40px"
    height: "56px"
  button-secondary:
    backgroundColor: "transparent"
    textColor: "{colors.surface}"
    typography: "{typography.label-lg}"
    rounded: "{rounded.none}"
    padding: "16px 40px"
    height: "56px"
  button-link:
    backgroundColor: "transparent"
    textColor: "{colors.secondary}"
    typography: "{typography.body-sm}"
    rounded: "{rounded.none}"
    padding: "0px"
  card:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.primary}"
    rounded: "{rounded.md}"
    padding: "16px"
  input:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.on-surface}"
    typography: "{typography.body-md}"
    rounded: "{rounded.md}"
    padding: "12px 16px"
  chip:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.accent}"
    typography: "{typography.label-sm}"
    rounded: "{rounded.full}"
    padding: "6px 12px"
---

# One Medical Calm

## Overview
One Medical presents as premium, reassuring, and quietly energetic. The experience is airy and editorial rather than clinical, with a strong health-and-wellness focus aimed at adults who want convenience and trust without feeling institutional. The tone balances seriousness with warmth: bold typography and crisp blue accents create clarity, while soft cream backgrounds keep the interface approachable and calm.

## Colors
- **Primary (#0578FF):** A vivid medical blue used for the main brand voice, prominent headlines, and high-clarity interactive emphasis. It feels fresh and trustworthy rather than sterile.
- **Primary Contrast (#004D49):** A deep teal-green used in button text and dark utility moments. It grounds the brighter palette and signals premium healthcare confidence.
- **Secondary (#2A2927):** A near-black charcoal for body copy, navigation, and subtle UI text. It maintains strong readability without the harshness of pure black.
- **Tertiary (#FFC776):** A warm golden sand used as the main call-to-action background color. It adds optimism and softness while keeping the interface light.
- **Neutral (#FFEDCE):** A pale cream backdrop that gives the site its airy, sunlit feel. It supports large imagery and generous whitespace.
- **Surface (#FFFFFF):** Clean white for top-level surfaces, cards, and areas that need maximum clarity.
- **On Surface (#2A2927):** The default readable text color on light surfaces, aligned with the site’s restrained editorial feel.
- **Border (#E5E7EB):** A quiet neutral border used sparingly for structure where needed, without making the interface feel boxed in.
- **Accent (#00A08A):** A wellness-inflected teal accent that can support sub-brands, tags, or secondary highlights. It fits the healthcare palette without competing with the primary blue.
- **Error (#D64545):** A restrained alert red reserved for validation and error messaging so it remains legible but not emotionally loud.

## Typography
The system combines a serif display face, GT Super Display, with the sans-serif Ginto for supporting text and UI. GT Super Display carries the brand’s editorial personality in large headlines, using medium weight and tight vertical rhythm for a luxurious, magazine-like presence. Ginto handles body copy, labels, and controls with light-to-semibold weights, keeping the interface readable and contemporary.

Headlines are expressive and large, with the largest hero treatment at 72px and a slightly smaller 60px display level for secondary page headings. Body text is comparatively light in weight, creating a calm reading experience even when paragraphs are dense. Labels and buttons use stronger weights and, in the smallest size, modest letter spacing for crisp navigation and utility text.

## Layout
The layout is spacious and left-aligned, with a strong editorial grid that lets imagery and type breathe. Sections use generous vertical separation, with spacing rhythm centered on 6px, 18px, 32px, 56px, and 80px increments. The hero uses a wide two-column composition: large text content on the left and a high-impact image treatment on the right.

Containers feel full-bleed at the page level, but inner content aligns to a consistent comfortable max-width with wide side padding. Cards and content tiles are separated by substantial gaps, reinforcing the premium, uncluttered reading experience. Button and link spacing stays restrained, keeping the page airy rather than dense.

## Elevation & Depth
The interface is intentionally flat and tonal instead of shadow-heavy. Hierarchy is created mostly through color contrast, scale, whitespace, and image framing rather than deep elevation. Where depth appears, it is subtle and minimal, with shadows used sparingly or not at all.

Borders are light and neutral, mainly for structural definition in components that need separation. This keeps the visual language calm and trustworthy, which suits a healthcare brand better than dramatic elevation effects.

## Shapes
The shape language is soft and approachable. Primary buttons use very large pill radii, creating friendly, touchable actions that feel modern and accessible. Cards and image containers use modest rounding, typically around 8px, so the layout stays polished without becoming overly playful.

Overall, the system favors rounded geometry over sharp corners, but it avoids excessive decoration. The result is human, premium, and easy to scan.

## Components
Buttons are the most expressive controls in the system. The `button-primary` variant is the main CTA: warm gold background, dark teal text, pill shape, and a comfortable 56px height with 16px/40px padding. It should feel inviting and clearly actionable. `button-secondary` is cleaner and more neutral, suitable for dark or image-backed contexts where white text is needed. `button-link` is lightweight and understated, used for informational or tertiary actions with underlined text and no container chrome.

Cards should be simple, calm, and content-first. Use `card` with the cream neutral background, subtle 8px rounding, and 16px padding. Keep shadows minimal or absent; rely on spacing and image composition to create separation. Content cards should feel like curated editorial modules rather than heavy containers.

Inputs should remain unobtrusive and highly legible. Use white backgrounds, medium rounding, and generous internal padding so fields feel touch-friendly and trustworthy. Focus states should be clear through color or border contrast rather than decorative effects.

Chips and small tags should be compact and pill-shaped, using the accent or primary family sparingly. They work best for category labels, service tags, and supporting metadata. Navigation links and utility actions should remain text-first, with weight and spacing doing the visual work instead of borders or fills.

## Do's and Don'ts
- Do keep large headlines in GT Super Display and reserve Ginto for supporting copy and controls.
- Do use warm neutrals and lots of whitespace to preserve the calm, premium healthcare feel.
- Do make primary calls to action pill-shaped and highly legible.
- Do keep shadows minimal; let contrast, scale, and spacing define hierarchy.
- Don't introduce harsh black fills or saturated secondary colors that fight the soft palette.
- Don't over-round cards or images to the point that the layout feels whimsical.
- Don't compress spacing around hero content or content tiles; the system depends on airiness.
- Don't make buttons visually noisy with borders, gradients, or heavy elevation.