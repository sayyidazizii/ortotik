---
name: Precision Compassion
colors:
  surface: '#f8f9ff'
  surface-dim: '#ccdbf4'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e6eeff'
  surface-container-high: '#dde9ff'
  surface-container-highest: '#d5e3fd'
  on-surface: '#0d1c2f'
  on-surface-variant: '#3d4947'
  inverse-surface: '#233144'
  inverse-on-surface: '#ebf1ff'
  outline: '#6d7a77'
  outline-variant: '#bcc9c6'
  surface-tint: '#006a61'
  primary: '#00685f'
  on-primary: '#ffffff'
  primary-container: '#008378'
  on-primary-container: '#f4fffc'
  inverse-primary: '#6bd8cb'
  secondary: '#006a63'
  on-secondary: '#ffffff'
  secondary-container: '#99efe5'
  on-secondary-container: '#006f67'
  tertiary: '#825100'
  on-tertiary: '#ffffff'
  tertiary-container: '#a36700'
  on-tertiary-container: '#fffbff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#89f5e7'
  primary-fixed-dim: '#6bd8cb'
  on-primary-fixed: '#00201d'
  on-primary-fixed-variant: '#005049'
  secondary-fixed: '#9cf2e8'
  secondary-fixed-dim: '#80d5cb'
  on-secondary-fixed: '#00201d'
  on-secondary-fixed-variant: '#00504a'
  tertiary-fixed: '#ffddb8'
  tertiary-fixed-dim: '#ffb95f'
  on-tertiary-fixed: '#2a1700'
  on-tertiary-fixed-variant: '#653e00'
  background: '#f8f9ff'
  on-background: '#0d1c2f'
  surface-variant: '#d5e3fd'
  background-subtle: '#F8FAFC'
  surface-white: '#FFFFFF'
  success-emerald: '#147901'
  deep-forest: '#1C4F40'
typography:
  headline-xl:
    fontFamily: Plus Jakarta Sans
    fontSize: 40px
    fontWeight: '700'
    lineHeight: 48px
    letterSpacing: -0.02em
  headline-xl-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
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
    letterSpacing: 0.01em
  label-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 12px
    fontWeight: '500'
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
  container-max: 1280px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 32px
  unit: 8px
---

## Brand & Style

The design system is engineered for **Ortho Care Indonesia** to bridge the gap between advanced orthopedic technology and human-centric care. The aesthetic is **High-Tech Professionalism mixed with Clinical Warmth**, ensuring that patients feel they are in the hands of experts who value their comfort.

The visual direction follows a **Corporate / Modern** movement with a focus on high-density information presented with clarity. It prioritizes:
- **Trustworthiness:** Through structured layouts and a stable color palette.
- **Precision:** Utilizing sharp typography and disciplined spacing.
- **Accessibility:** Ensuring high contrast ratios and clear navigational paths for users who may be experiencing physical discomfort or mobility issues.
- **Innovation:** Using subtle glassmorphism and soft elevation to suggest a modern, state-of-the-art facility.

## Colors

The palette is anchored by **Medical Teal (#0D9488)**, a color that evokes both the sterility of a modern clinic and the vitality of healing. 

- **Primary & Secondary:** Used for brand identity, primary actions, and active states. Teal provides a calming effect compared to traditional clinical blues.
- **Tertiary (Warm Amber):** Reserved exclusively for high-priority calls to action (e.g., "Book Appointment") and critical alerts. It provides a human warmth to the otherwise cool palette.
- **Neutral (Slate Gray):** Employed for text and iconography to ensure maximum legibility without the harshness of pure black.
- **Backgrounds:** A tiered system of `#F8FAFC` for page backgrounds and `#FFFFFF` for elevated cards to create clear visual depth.

## Typography

This design system utilizes **Plus Jakarta Sans** for all levels. Its slightly wider apertures and friendly terminals provide the "compassionate" feel required for medical services while maintaining a professional, geometric structure.

- **Headlines:** Use Bold (700) or SemiBold (600) weights with negative letter spacing on larger sizes to create a modern, "locked-in" appearance.
- **Body:** Standardized at 16px for optimal readability. For medical disclaimers or secondary info, 14px is acceptable.
- **Mobile Scaling:** Headlines downscale significantly on mobile to prevent awkward word breaks in long medical terms.

## Layout & Spacing

The design system employs a **12-column fluid grid** for desktop and a **4-column grid** for mobile. 

- **The 8px Rule:** All spacing (padding, margins, gaps) must be multiples of 8px to maintain a rhythmic vertical flow.
- **Mobile-First Responsiveness:** Prioritize vertical stacking for medical service lists. Sticky elements (headers/CTAs) are mandatory on mobile to keep "Book Appointment" reachable at all times.
- **Safe Areas:** Maintain a minimum 16px margin on mobile devices to ensure interactive elements are not obscured by device hardware or rounded screen corners.

## Elevation & Depth

To convey a sense of modern technology, depth is achieved through **Tonal Layering** and **Soft Ambient Shadows**:

- **Level 0 (Base):** Background color (`#F8FAFC`).
- **Level 1 (Cards):** White background with a very soft, large-radius shadow (Blur: 16px, Y: 4px, Opacity: 4% Black). This is used for service cards and patient testimonials.
- **Level 2 (Interaction):** Hover states and dropdowns use a more defined shadow (Blur: 24px, Y: 8px, Opacity: 8% Teal) to suggest physical lift.
- **Glassmorphism:** Navigation headers use a semi-transparent white background (90% opacity) with a `blur(12px)` backdrop filter to maintain context of the content beneath while scrolling.

## Shapes

A **Rounded (0.5rem)** approach is standard across the system. This level of curvature strikes a balance: it is softer and more approachable than sharp corners (which can feel clinical and cold) but more professional than pill-shapes (which can feel overly casual or "app-like").

- **Inputs & Buttons:** Use the standard 0.5rem (8px) radius.
- **Large Cards:** May scale up to 1rem (16px) to emphasize the containerized nature of the information.
- **Icons:** Should feature slightly rounded terminals to match the typography.

## Components

### Sticky Mobile Header
The header must remain fixed at the top, containing the logo and a "Quick Action" hamburger menu. Use a glassmorphic blur to keep the UI light.

### Navigation Drawer
On mobile, the navigation drawer should emerge from the right. It must include a prominent "Emergency Contact" button at the bottom and clear categorizations for Medical Services, Doctors, and Patient Portal.

### Medical Service Cards
Cards should feature a subtle 1px border (`#E2E8F0`) and the Level 1 shadow. 
- **Header:** Icon in Primary Teal.
- **Content:** Headline-md and 3 lines of Body-sm text.
- **Footer:** A "Learn More" text link with a chevron.

### Patient Journey Flow
A vertical "Stepper" component for mobile and horizontal for desktop.
- **Active Step:** Filled Primary Teal circle with a white number.
- **Inactive Step:** Outlined Slate Gray circle.
- **Connector Line:** 2px solid line representing progress.

### Trust Badges
Small, monochromatic or Primary-tinted badges (e.g., "KEMENKES Certified," "ISO 9001"). These should be placed in the footer and directly below hero CTAs to reinforce credibility.

### Buttons
- **Primary:** Medical Teal background, white text.
- **Secondary:** Outlined Teal, transparent background.
- **Urgent:** Warm Amber background, white text (for Appointments).