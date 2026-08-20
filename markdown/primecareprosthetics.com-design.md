---
version: alpha
name: PrimeCare Prosthetics
description: A calm, trust-first healthcare system with strong navy accents, generous white space, and clear informational hierarchy.
colors:
  primary: "#163F6C"
  secondary: "#374151"
  tertiary: "#6B7280"
  neutral: "#FFFFFF"
  surface: "#F8FAFC"
  on-surface: "#121212"
  background: "#121212"
  text: "#FFFFFF"
  border: "#D1D5DB"
  error: "#B91C1C"
typography:
  headline-display:
    fontFamily: Poppins
    fontSize: 48px
    fontWeight: 500
    lineHeight: 58px
    letterSpacing: 0px
  headline-lg:
    fontFamily: Poppins
    fontSize: 38px
    fontWeight: 500
    lineHeight: 58px
    letterSpacing: 0px
  headline-md:
    fontFamily: Poppins
    fontSize: 29px
    fontWeight: 500
    lineHeight: 50px
    letterSpacing: 0px
  headline-sm:
    fontFamily: Poppins
    fontSize: 23px
    fontWeight: 500
    lineHeight: 32px
    letterSpacing: 0px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: 400
    lineHeight: 28px
    letterSpacing: 0px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: 400
    lineHeight: 24px
    letterSpacing: 0px
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: 400
    lineHeight: 22px
    letterSpacing: 0px
  label-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: 500
    lineHeight: 24px
    letterSpacing: 0px
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: 500
    lineHeight: 20px
    letterSpacing: 0px
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: 500
    lineHeight: 16px
    letterSpacing: 0.04em
  nav-link:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: 500
    lineHeight: 24px
    letterSpacing: 0px
  stat-value:
    fontFamily: Poppins
    fontSize: 64px
    fontWeight: 500
    lineHeight: 1.0
    letterSpacing: 0px
rounded:
  none: 0px
  sm: 4px
  md: 8px
  lg: 12px
  xl: 16px
  full: 9999px
spacing:
  xs: 6px
  sm: 16px
  md: 32px
  lg: 48px
  xl: 100px
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.neutral}"
    typography: "{typography.label-lg}"
    rounded: "{rounded.md}"
    padding: "20px 66px"
    height: "61px"
    width: "221px"
  button-secondary:
    backgroundColor: "transparent"
    textColor: "{colors.neutral}"
    typography: "{typography.label-lg}"
    rounded: "{rounded.md}"
    padding: "20px 66px"
    height: "61px"
    width: "221px"
  button-tertiary:
    backgroundColor: "transparent"
    textColor: "{colors.text}"
    typography: "{typography.label-lg}"
    rounded: "{rounded.none}"
    padding: "0px"
  card:
    backgroundColor: "{colors.background}"
    textColor: "{colors.neutral}"
    typography: "{typography.body-md}"
    rounded: "{rounded.md}"
    padding: "16px"
  input:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.on-surface}"
    typography: "{typography.body-md}"
    rounded: "{rounded.md}"
    padding: "16px"
  chip:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.on-surface}"
    typography: "{typography.label-md}"
    rounded: "{rounded.full}"
    padding: "8px 12px"
---

# PrimeCare Prosthetics

## Overview
PrimeCare Prosthetics feels clinical, dependable, and reassuring rather than expressive or playful. The visual language supports a healthcare audience that needs clarity, trust, and easy navigation, with strong headline hierarchy and restrained use of color. Layouts are spacious and structured, with hero imagery and bold statistics used to communicate confidence and scale.

## Colors
- **Primary (#163F6C):** The signature navy accent used for key calls to action, prominent numbers, and brand emphasis. It reads as professional, stable, and medically trustworthy.
- **Secondary (#374151):** A dark gray used for supporting text and section labeling when the design needs a softer contrast than pure black.
- **Tertiary (#6B7280):** A muted gray for less prominent metadata, utility text, and secondary navigation details.
- **Neutral (#FFFFFF):** The primary light text and surface color, especially effective over the dark hero image and in the top utility bar.
- **Surface (#F8FAFC):** A light neutral surface for content areas that need separation from the darker hero treatment without feeling heavy.
- **On-surface (#121212):** The near-black base tone for dark backgrounds and strong readable text contrast in standard UI containers.
- **Background (#121212):** The foundational dark field used for cards, overlays, and other grounded components when the UI shifts to a darker treatment.
- **Border (#D1D5DB):** A subtle divider color for lines, card edges, and structural separators.
- **Error (#B91C1C):** Reserved for validation and failure states; it should remain sparingly used so it does not disrupt the calm brand tone.

## Typography
Headlines use Poppins at 500 weight, giving the site a modern but friendly healthcare feel with rounded geometry and clear letterforms. The largest heading style is used for hero statements and major page introductions, while the smaller headline steps support section titles and content-led marketing blocks.

Body copy uses Inter for clean readability at medium-large sizes, matching the site’s informational and service-oriented content. Labels and navigation also use Inter at 500 weight, which creates crisp hierarchy without looking loud.

Uppercase treatment appears in some data labels and utility text, where slightly increased letter-spacing helps small text feel structured and scannable. Overall, the typography is straightforward and highly legible, with minimal decorative styling.

## Layout
The layout is broad, centered, and content-forward, with a strong top utility bar, a full-width hero, and generous breathing room between sections. Content is arranged in clear horizontal bands rather than dense multi-column layouts, which helps the page feel accessible and calm.

Spacing follows a large, predictable rhythm: 6px for fine adjustments, 16px and 32px for most component spacing, 48px for section separation, and 100px for major vertical breaks. Cards and stat blocks should keep internal padding modest and structured, while overall sections should remain open and spacious.

The design favors fixed-width content clusters inside full-width visual areas, especially in the header and hero. This balance keeps the site feeling premium and organized while preserving enough flexibility for responsive behavior.

## Elevation & Depth
Elevation is intentionally flat. Shadows are effectively absent, so hierarchy comes from contrast, overlays, image treatment, and thin borders rather than depth effects.

Dark hero imagery with white text creates the strongest visual separation, while subtle dividers and bordered buttons provide enough definition for interactive elements. Cards should rely on border color, padding, and tonal contrast instead of blur or shadow-heavy styling.

## Shapes
The shape language is restrained and approachable, using an 8px radius as the default for buttons, cards, and other interactive containers. This keeps the interface soft enough for healthcare while avoiding overly rounded, playful geometry.

Full-pill shapes are appropriate for chips and compact status elements. Otherwise, forms and controls should remain simple, rectilinear, and consistent.

## Components
Buttons are the most prominent interactive element and should stay wide, legible, and high-contrast. `button-primary` uses the navy fill with white text for the main action, while `button-secondary` uses a transparent background with a white outline for use over dark imagery. `button-tertiary` is reserved for low-emphasis actions or text-style links. Buttons should keep generous padding, a 61px visual height, and an 8px radius.

Cards use a flat dark surface with a subtle border and no shadow. Keep padding at 16px for compact content blocks, and use borders to separate grouped information such as stats or resource tiles.

Inputs should feel clean and utilitarian: white or light surfaces, dark text, 8px rounding, and moderate internal padding. Avoid heavy decoration; clarity and accessibility matter more than visual novelty.

Chips can be used for categories, filters, or short labels. They should be compact, lightly padded, and pill-shaped so they read as supportive metadata rather than primary controls.

Navigation links and utility items should use the `label-lg` or `nav-link` styles with minimal ornamentation. The top bar and main nav depend on spacing and alignment more than visual chrome, so hover and active states should be subtle.

## Do's and Don'ts
- Do keep primary actions in navy with white text for strong hierarchy.
- Do use Poppins for headlines and Inter for everything functional and readable.
- Do preserve generous whitespace around hero text, statistics, and section breaks.
- Do rely on borders and contrast instead of shadows to separate surfaces.
- Don't introduce bright or saturated accent colors that compete with the calm medical tone.
- Don't use heavy corner rounding or playful shapes on core UI components.
- Don't compress navigation or content blocks into dense layouts that reduce readability.
- Don't add decorative effects like deep shadows, gradients, or ornate borders unless they are essential to clarity.