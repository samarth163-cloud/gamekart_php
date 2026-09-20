<?php
include_once("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameKart - Online Gaming Shopping & Portal Select</title>
  <?php include("topscript.php"); ?>
  <style>
    body {
      min-height: 100vh;
      background: radial-gradient(circle at top center, #FCF8FF 0%, #F6EBFF 40%, #FFFFFF 100%);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      color: var(--theme-ink);
    }

    .portal-container {
      max-width: 960px;
      margin: auto;
      padding: 60px 20px;
      text-align: center;
    }

    .brand-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #FFFFFF;
      border: 1px solid var(--theme-border);
      color: var(--theme-primary-dark);
      padding: 6px 18px;
      border-radius: 30px;
      font-family: var(--font-display);
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(206, 92, 255, 0.1);
    }

    .portal-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 28px;
      margin-top: 40px;
    }

    .portal-card {
      background: var(--theme-surface);
      border: 1.5px solid var(--theme-border);
      border-radius: 16px;
      padding: 40px 30px;
      text-align: center;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      color: inherit;
    }

    .portal-card:hover {
      border-color: var(--theme-primary);
      transform: translateY(-8px);
      box-shadow: 0 16px 36px rgba(206, 92, 255, 0.18);
      background: #FFFFFF;
    }

    .card-icon-wrap {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      background: var(--theme-surface-soft);
      border: 1px solid var(--theme-border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 38px;
      color: var(--theme-primary-dark);
      margin-bottom: 22px;
      transition: all 0.3s ease;
    }

    .portal-card:hover .card-icon-wrap {
      background: var(--theme-primary);
      color: #FFFFFF;
      transform: scale(1.1) rotate(5deg);
    }

    .portal-card h2 {
      font-family: var(--font-display);
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 10px;
      color: var(--theme-ink);
    }

    .portal-card p {
      font-size: 14.5px;
      color: var(--theme-text);
      margin-bottom: 24px;
      line-height: 1.5;
    }
  </style>
</head>
<body>

  <div class="portal-container">
    <div class="brand-badge">
      <i class="bi bi-controller"></i> Next-Gen Gaming Gear & Accessories Store
    </div>
    
    <div class="navbar-logo" style="justify-content: center; font-size: 38px; margin-bottom: 12px;">
      GAME<span>KART</span>
    </div>

    <p style="font-size: 18px; color: var(--theme-text); max-width: 580px; margin: 0 auto;">
      Welcome to GameKart. Select your portal below to enter the gaming storefront or access administrative management.
    </p>

    <div class="portal-cards">
      <!-- Client Card -->
      <a href="clogin.php" class="portal-card">
        <div class="card-icon-wrap">
          <i class="bi bi-joystick"></i>
        </div>
        <h2>Gamer Storefront</h2>
        <p>Explore high-performance mechanical keyboards, pro gaming mice, RGB headsets, and gaming hardware.</p>
        <span class="btn-primary" style="width: 100%;">Enter Store <i class="bi bi-arrow-right ms-1"></i></span>
      </a>

      <!-- Admin Card -->
      <a href="aLogin.php" class="portal-card">
        <div class="card-icon-wrap">
          <i class="bi bi-shield-lock"></i>
        </div>
        <h2>Admin Control Center</h2>
        <p>Manage product inventories, oversee gaming gear catalog, fulfill customer orders, and view users.</p>
        <span class="btn-secondary" style="width: 100%;">Admin Login <i class="bi bi-box-arrow-in-right ms-1"></i></span>
      </a>
    </div>
  </div>

  <?php include("footer.php"); ?>

</body>
</html>
