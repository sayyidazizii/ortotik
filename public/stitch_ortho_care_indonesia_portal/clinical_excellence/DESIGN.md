---
name: Clinical Excellence
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#42474f'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#727780'
  outline-variant: '#c2c7d1'
  surface-tint: '#2d6197'
  primary: '#00355f'
  on-primary: '#ffffff'
  primary-container: '#0f4c81'
  on-primary-container: '#8ebdf9'
  inverse-primary: '#a0c9ff'
  secondary: '#006a61'
  on-secondary: '#ffffff'
  secondary-container: '#86f2e4'
  on-secondary-container: '#006f66'
  tertiary: '#532800'
  on-tertiary: '#ffffff'
  tertiary-container: '#743b00'
  on-tertiary-container: '#f9a767'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d2e4ff'
  primary-fixed-dim: '#a0c9ff'
  on-primary-fixed: '#001c37'
  on-primary-fixed-variant: '#07497d'
  secondary-fixed: '#89f5e7'
  secondary-fixed-dim: '#6bd8cb'
  on-secondary-fixed: '#00201d'
  on-secondary-fixed-variant: '#005049'
  tertiary-fixed: '#ffdcc4'
  tertiary-fixed-dim: '#ffb780'
  on-tertiary-fixed: '#2f1400'
  on-tertiary-fixed-variant: '#6f3800'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
  slate-50: '#F8FAFC'
  slate-900: '#0F172A'
  whatsapp-emerald: '#25D366'
typography:
  headline-xl:
    fontFamily: Plus Jakarta Sans
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-xl-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.04em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  container-max: 1280px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 40px
  section-gap-lg: 80px
  section-gap-sm: 48px
---

## Brand & Style

The design system is engineered to project **Medical-Grade Professionalism** with a modern, high-tech edge. It serves a dual purpose: establishing clinical authority for orthopedic specialists while providing a frictionless, reassuring experience for patients. The tone is precise, dependable, and sophisticated.

The visual direction follows a **Corporate / Modern** aesthetic, utilizing a disciplined structure that emphasizes clarity and hygiene. It leverages:
- **Clinical Precision:** Crisp borders, generous whitespace, and a high-contrast palette.
- **Modern Reliability:** A blend of deep navy tones with vibrant teal accents to signify both tradition and innovation.
- **Technological Sophistication:** Subtle use of depth and refined typography to suggest a state-of-the-art medical environment.
- **Calm Authority:** A layout philosophy that reduces cognitive load through clear information hierarchy.

## Colors

The color palette is anchored in **Medical Navy (#0F4C81)**, a stable and authoritative hue that forms the backbone of the clinical identity.

- **Primary (Medical Navy):** Used for headers, primary navigation, and core branding elements to establish trust.
- **Secondary (Teal):** Applied to interactive elements, progress indicators, and supportive medical icons to provide a sense of vitality and healing.
- **Accent/CTA (Emerald Green):** A dedicated color role for WhatsApp integrations and specific high-conversion contact points, ensuring immediate recognition.
- **Neutral (Slate Gray):** A sophisticated gray scale. `Slate-50` is the primary background surface, while `Slate-900` is reserved for high-contrast typography to ensure AAA accessibility.

## Typography

**Plus Jakarta Sans** is the exclusive typeface for this design system. Its geometric foundation provides a clean, systematic look, while its modern apertures maintain a friendly, approachable feel.

- **Headlines:** Use Bold (700) weights for primary hero sections to project strength. SemiBold (600) is preferred for section headers to maintain a professional balance.
- **Body Text:** Optimized at 16px (`body-md`) for standard reading. The 18px (`body-lg`) variant should be used for introductory paragraphs or patient instructions.
- **Labels:** Always use SemiBold or Bold weights. All-caps styling with increased letter spacing is recommended for small category labels or utility links.

## Layout & Spacing

This design system utilizes a **12-column fixed grid** for desktop environments to maintain a "contained" and controlled clinical feel. 

- **Grid Logic:** On desktop (1024px+), the content is centered with a max-width of 1280px. On tablet and mobile, the layout transitions to a fluid model with 16px margins.
- **The 8px Rhythm:** All spatial relationships are governed by an 8px base unit. Component heights, internal padding, and vertical stacking must adhere to this scale.
- **Sectioning:** Use large vertical gaps (80px) between major content blocks on desktop to ensure a high-end, uncluttered presentation. On mobile, these gaps compress to 48px.

## Elevation & Depth

To maintain a professional, medical-grade appearance, depth is used sparingly and with high precision. The system avoids heavy shadows in favor of **Tonal Layers** and **Low-Contrast Outlines**.

- **Surface Tiering:** The background is `Slate-50`. Primary content containers (cards, modals) use pure white backgrounds to create a "clean-room" effect.
- **Ghost Borders:** Elements are primarily defined by 1px solid borders using `Slate-200` (or similar low-opacity neutrals) rather than shadows.
- **Soft Ambient Elevation:** Where shadows are necessary (e.g., floating action buttons or active dropdowns), use a multi-layered, ultra-soft shadow: `0px 4px 20px rgba(15, 23, 42, 0.05)`.
- **Glassmorphism:** Reserved strictly for the Global Navigation Bar. A 95% white opacity with a `blur(16px)` allows the content to feel integrated as the user scrolls through medical services.

## Shapes

The shape language is **Rounded (0.5rem)**. This provides a balance between the rigid "sharp" corners of industrial software and the overly "soft" pill shapes of consumer social apps.

- **Standard Components:** Buttons, input fields, and small cards use the `0.5rem` (8px) radius.
- **Large Containers:** Hero sections or large feature cards may use `rounded-lg` (16px) to appear more like modern physical medical devices.
- **Iconography:** Use linear icons with a 2px stroke and slightly rounded caps to echo the terminal shapes of the Plus Jakarta Sans typeface.

## Components

### Buttons
- **Primary:** Medical Navy background with White text. High-contrast, sharp, and authoritative.
- **Secondary/Ghost:** 1px Teal border with Teal text. Used for less urgent navigation.
- **WhatsApp CTA:** Emerald Green background with White text, featuring the WhatsApp icon. This should be treated as a "Global Action" component.

### Input Fields
Inputs should feature a `Slate-200` border, `Slate-50` background on focus, and 16px horizontal padding. Labels must be `label-md` in `Slate-900` positioned above the field.

### Medical Service Cards
Designed with a "High-Tech Clinic" aesthetic: 
- White background, 1px `Slate-100` border.
- 24px internal padding.
- Teal icon at the top left.
- Subtle hover state: Border color shifts to `Teal` and a very light `Teal` tint is applied to the background.

### Checkboxes & Radio Buttons
Use the `Secondary (Teal)` color for active states. Checkboxes should have a slightly rounded corners (2px) to match the system-wide shape language.

### Data Lists
For patient records or service lists, use a clean row-based layout with `Slate-50` zebra-striping and 16px vertical padding per row. Use `Slate-900` for primary data and `Slate-500` for secondary metadata.

### Breadcrumbs
Small, `label-sm` links in `Slate-500` with a simple chevron separator, ensuring users can always navigate back through complex medical categories.