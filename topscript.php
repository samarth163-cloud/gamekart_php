<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome & Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ==========================================================================
   GAMEKART DESIGN SYSTEM - Clean Premium Purple/Violet Theme
   ========================================================================== */
:root {
  --theme-primary: #CE5CFF;           /* Vivid Gaming Neon Purple */
  --theme-primary-dark: #B838EE;      /* Deep Purple Hover State */
  --theme-primary-rgb: 206, 92, 255;
  --theme-secondary: #CE5CFF;
  --theme-accent: #CE5CFF;
  --theme-light-pink: #F6EBFF;        /* Soft Lavender Background Tint */
  
  --theme-bg: #FFFFFF;                /* Crisp White Main Canvas */
  --theme-bg-start: #FFFFFF;
  --theme-surface: #FCF8FF;           /* Ultra-Light Lavender Card Surface */
  --theme-surface-soft: #F6EBFF;      /* Soft Highlight Surface */
  --theme-surface-elevated: #FCF8FF;
  
  --theme-ink: #17121A;               /* Dark Charcoal */
  --theme-text: #665A68;              /* Slate Purple-Gray */
  --theme-muted: #8E7F91;             /* Muted Gray */
  --theme-white: #FFFFFF;
  
  --theme-border: #E5C7F7;            /* Soft Violet Border */
  --theme-border-accent: #CE5CFF;     /* Highlighted Violet Border */
  
  --theme-danger: #DC2626;
  --theme-danger-bg: rgba(220, 38, 38, 0.08);
  --theme-success: #16A34A;
  --theme-warning: #D97706;
  
  --theme-sidebar: #FCF8FF;
  --theme-sidebar-dark: #FFFFFF;
  --theme-sidebar-text: #17121A;
  --theme-sidebar-muted: #665A68;
  --theme-table-header: #F6EBFF;
  --theme-footer: #FCF8FF;
  --theme-footer-text: #665A68;
  
  --font-display: "Rajdhani", "Space Grotesk", sans-serif;
  --font-logo: "Orbitron", sans-serif;
  --font-body: "Plus Jakarta Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
  font-family: var(--font-body);
  background: var(--theme-bg);
  color: var(--theme-ink);
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
}

::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
::-webkit-scrollbar-track {
  background: #FFFFFF;
}
::-webkit-scrollbar-thumb {
  background: var(--theme-border);
  border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
  background: #D5A6EE;
}

img {
  max-width: 100%;
  height: auto;
  display: block;
}

a {
  color: var(--theme-primary-dark);
  text-decoration: none;
  transition: all 0.2s ease;
}
a:hover {
  color: var(--theme-primary);
}

h1, h2, h3, h4, h5, h6,
.section-title, .brand-title, .card-title {
  font-family: var(--font-display);
  font-weight: 700;
  letter-spacing: 0.5px;
  color: var(--theme-ink);
  margin-top: 0;
}

/* ==========================================================================
   BUTTONS & BADGES
   ========================================================================== */
.btn-primary, .btn-theme {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: var(--theme-primary) !important;
  color: #FFFFFF !important;
  border: 1px solid var(--theme-primary) !important;
  padding: 10px 22px;
  font-family: var(--font-display);
  font-size: 15px;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  border-radius: 6px;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.2s ease;
}
.btn-primary:hover, .btn-theme:hover {
  background: var(--theme-primary-dark) !important;
  border-color: var(--theme-primary-dark) !important;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(206, 92, 255, 0.3);
}

.btn-secondary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: var(--theme-surface-soft) !important;
  color: var(--theme-ink) !important;
  border: 1px solid var(--theme-border) !important;
  padding: 10px 20px;
  font-family: var(--font-display);
  font-size: 14px;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.2s ease;
}
.btn-secondary:hover {
  background: #E5C7F7 !important;
  border-color: var(--theme-primary) !important;
  color: var(--theme-ink) !important;
}

.btn-danger {
  background: var(--theme-danger) !important;
  color: #FFFFFF !important;
  border: 1px solid var(--theme-danger) !important;
  padding: 8px 16px;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  font-family: var(--font-display);
}
.btn-danger:hover {
  background: #B91C1C !important;
}

.badge {
  display: inline-block;
  padding: 5px 12px;
  font-size: 12px;
  font-weight: 700;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.badge-purple {
  background: var(--theme-surface-soft);
  color: var(--theme-primary-dark);
  border: 1px solid var(--theme-border);
}
.badge-success {
  background: #DCFCE7;
  color: #15803D;
  border: 1px solid #BBF7D0;
}
.badge-danger {
  background: #FEE2E2;
  color: #B91C1C;
  border: 1px solid #FECACA;
}

/* ==========================================================================
   CLIENT NAVIGATION BAR
   ========================================================================== */
.client-navbar {
  position: sticky;
  top: 0;
  z-index: 1000;
  background: var(--theme-surface);
  border-bottom: 1px solid var(--theme-border);
  padding: 14px 28px;
  box-shadow: 0 2px 10px rgba(206, 92, 255, 0.05);
}
.navbar-container {
  max-width: 1240px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.navbar-logo {
  font-family: var(--font-logo);
  font-size: 22px;
  font-weight: 900;
  letter-spacing: 1.5px;
  color: var(--theme-ink) !important;
  display: flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
}
.navbar-logo span {
  color: var(--theme-primary);
}
.navbar-links {
  display: flex;
  align-items: center;
  gap: 24px;
  list-style: none;
  margin: 0;
  padding: 0;
}
.nav-item a {
  font-family: var(--font-display);
  font-size: 16px;
  font-weight: 600;
  color: var(--theme-ink) !important;
  letter-spacing: 0.4px;
  text-decoration: none;
  transition: color 0.2s ease;
}
.nav-item a:hover,
.nav-item.active a {
  color: var(--theme-primary) !important;
}
.nav-actions {
  display: flex;
  align-items: center;
  gap: 14px;
}

/* ==========================================================================
   HERO BANNER SECTION
   ========================================================================== */
.hero-section {
  background: linear-gradient(135deg, #FCF8FF 0%, #F6EBFF 100%);
  border-bottom: 1px solid var(--theme-border);
  padding: 64px 20px;
  text-align: center;
}
.hero-content {
  max-width: 800px;
  margin: 0 auto;
}
.hero-tag {
  display: inline-block;
  background: #FFFFFF;
  border: 1px solid var(--theme-border);
  color: var(--theme-primary-dark);
  font-family: var(--font-display);
  font-weight: 700;
  padding: 6px 16px;
  border-radius: 30px;
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 16px;
}
.hero-title {
  font-size: 44px;
  line-height: 1.15;
  color: var(--theme-ink);
  margin-bottom: 14px;
}
.hero-subtitle {
  font-size: 17px;
  color: var(--theme-text);
  margin-bottom: 28px;
}

/* ==========================================================================
   SEARCH BAR & FILTERS
   ========================================================================== */
.search-container {
  max-width: 680px;
  margin: 0 auto 36px;
  position: relative;
}
.search-input {
  width: 100%;
  padding: 14px 20px 14px 46px;
  font-size: 15px;
  font-family: var(--font-body);
  border: 1.5px solid var(--theme-border);
  border-radius: 8px;
  background: #FFFFFF;
  color: var(--theme-ink);
  outline: none;
  transition: border-color 0.2s ease;
}
.search-input:focus {
  border-color: var(--theme-primary);
  box-shadow: 0 0 0 3px rgba(206, 92, 255, 0.15);
}
.search-icon {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--theme-muted);
}

/* ==========================================================================
   PRODUCT CATALOG GRID & CARDS
   ========================================================================== */
.products-wrapper {
  max-width: 1240px;
  margin: 40px auto;
  padding: 0 20px;
}
.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 28px;
}
.product-card {
  background: var(--theme-surface);
  border: 1px solid var(--theme-border);
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  height: 100%;
  transition: all 0.25s ease;
}
.product-card:hover {
  border-color: var(--theme-primary);
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(206, 92, 255, 0.15);
}
.product-thumb {
  height: 220px;
  background: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  border-bottom: 1px solid var(--theme-border);
  overflow: hidden;
}
.product-thumb img {
  max-height: 100%;
  max-width: 100%;
  object-fit: contain;
  transition: transform 0.3s ease;
}
.product-card:hover .product-thumb img {
  transform: scale(1.05);
}
.product-body {
  padding: 18px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.product-title {
  font-size: 18px;
  margin-bottom: 8px;
  color: var(--theme-ink);
}
.product-desc {
  font-size: 13.5px;
  color: var(--theme-text);
  margin-bottom: 16px;
  flex-grow: 1;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.product-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 14px;
  border-top: 1px dashed var(--theme-border);
}
.product-price {
  font-family: var(--font-display);
  font-size: 22px;
  font-weight: 700;
  color: var(--theme-primary-dark);
}

/* ==========================================================================
   AUTHENTICATION FORM CARDS (Login & Register)
   ========================================================================== */
.auth-wrapper {
  min-height: 85vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
  background: var(--theme-bg);
}
.auth-card {
  width: 100%;
  max-width: 460px;
  background: var(--theme-surface);
  border: 1px solid var(--theme-border);
  border-radius: 12px;
  padding: 36px;
  box-shadow: 0 8px 30px rgba(206, 92, 255, 0.08);
}
.auth-header {
  text-align: center;
  margin-bottom: 24px;
}
.auth-title {
  font-size: 28px;
  color: var(--theme-ink);
  margin-bottom: 6px;
}
.form-group {
  margin-bottom: 18px;
}
.form-label {
  display: block;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--theme-ink);
  margin-bottom: 6px;
  font-family: var(--font-display);
}
.form-control, select.form-select {
  width: 100%;
  padding: 11px 14px;
  border: 1px solid var(--theme-border);
  border-radius: 6px;
  background: #FFFFFF;
  color: var(--theme-ink);
  font-size: 14px;
  outline: none;
  transition: border-color 0.2s ease;
}
.form-control:focus, select.form-select:focus {
  border-color: var(--theme-primary);
  box-shadow: 0 0 0 3px rgba(206, 92, 255, 0.15);
}

/* ==========================================================================
   TABLES & ORDER VIEWS
   ========================================================================== */
.table-container {
  width: 100%;
  overflow-x: auto;
  border: 1px solid var(--theme-border);
  border-radius: 8px;
  background: #FFFFFF;
  box-shadow: 0 2px 10px rgba(206, 92, 255, 0.04);
}
.gamekart-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}
.gamekart-table th {
  background: var(--theme-table-header);
  color: var(--theme-ink);
  font-family: var(--font-display);
  font-size: 14px;
  font-weight: 700;
  padding: 14px 16px;
  border-bottom: 1px solid var(--theme-border);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.gamekart-table td {
  padding: 14px 16px;
  border-bottom: 1px solid var(--theme-border);
  font-size: 14px;
  color: var(--theme-text);
  vertical-align: middle;
}
.gamekart-table tr:nth-child(even) {
  background: #FCF8FF;
}
.gamekart-table tr:hover {
  background: #F6EBFF;
}
.table-thumb {
  width: 54px;
  height: 54px;
  border-radius: 6px;
  object-fit: contain;
  background: #FFFFFF;
  border: 1px solid var(--theme-border);
  padding: 2px;
}

/* ==========================================================================
   ADMIN DASHBOARD & SIDEBAR LAYOUT
   ========================================================================== */
.admin-layout {
  display: flex;
  min-height: 100vh;
  background: #FFFFFF;
}
.admin-sidebar {
  width: 260px;
  background: var(--theme-surface);
  border-right: 1px solid var(--theme-border);
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  position: sticky;
  top: 0;
  height: 100vh;
}
.admin-brand {
  padding: 22px 20px;
  border-bottom: 1px solid var(--theme-border);
  font-family: var(--font-logo);
  font-size: 18px;
  font-weight: 800;
  color: var(--theme-ink);
}
.admin-brand span {
  color: var(--theme-primary);
}
.admin-nav {
  list-style: none;
  padding: 16px 12px;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.admin-nav-link {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 6px;
  font-family: var(--font-display);
  font-size: 15px;
  font-weight: 600;
  color: var(--theme-text) !important;
  text-decoration: none;
  transition: all 0.2s ease;
}
.admin-nav-link:hover,
.admin-nav-link.active {
  background: var(--theme-surface-soft);
  color: var(--theme-primary-dark) !important;
  font-weight: 700;
}
.admin-main {
  flex-grow: 1;
  padding: 32px;
  background: #FFFFFF;
  overflow-y: auto;
}
.admin-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 28px;
  padding-bottom: 16px;
  border-bottom: 1px solid var(--theme-border);
}

/* Stat Cards */
.stat-card {
  background: var(--theme-surface);
  border: 1px solid var(--theme-border);
  border-radius: 10px;
  padding: 22px;
  display: flex;
  align-items: center;
  gap: 18px;
  transition: all 0.2s ease;
}
.stat-card:hover {
  border-color: var(--theme-primary);
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(206, 92, 255, 0.1);
}
.stat-icon {
  width: 52px;
  height: 52px;
  border-radius: 10px;
  background: var(--theme-surface-soft);
  color: var(--theme-primary-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}
.stat-val {
  font-family: var(--font-display);
  font-size: 28px;
  font-weight: 700;
  color: var(--theme-ink);
  line-height: 1.1;
}
.stat-lbl {
  font-size: 13px;
  color: var(--theme-muted);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
}

/* ==========================================================================
   FOOTER
   ========================================================================== */
.client-footer {
  background: var(--theme-footer);
  border-top: 1px solid var(--theme-border);
  padding: 40px 20px;
  text-align: center;
  color: var(--theme-footer-text);
  font-size: 14px;
  margin-top: 60px;
}

/* ==========================================================================
   RESPONSIVE DESIGN (MEDIA QUERIES)
   ========================================================================== */
@media (max-width: 992px) {
  .admin-layout {
    flex-direction: column;
  }
  .admin-sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 32px;
  }
  .navbar-container {
    flex-direction: column;
    gap: 14px;
  }
  .products-grid {
    grid-template-columns: 1fr;
  }
  .admin-main {
    padding: 18px;
  }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
