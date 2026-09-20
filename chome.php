<?php
include_once("conn.php");

// Handle Quick Add to Cart from Home
$msg = "";
if (isset($_POST['btnQuickCart'])) {
    if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
        header("Location: clogin.php?msg=login_required");
        exit;
    }
    $uid = (int)$_SESSION['uid'];
    $pid = (int)$_POST['pid'];

    $chk = mysqli_query($con, "SELECT * FROM tblcart WHERE userid=$uid AND productid=$pid");
    if (mysqli_num_rows($chk) > 0) {
        mysqli_query($con, "UPDATE tblcart SET qty = qty + 1 WHERE userid=$uid AND productid=$pid");
        $msg = "Item quantity increased in your cart!";
    } else {
        mysqli_query($con, "INSERT INTO tblcart(userid, productid, qty) VALUES($uid, $pid, 1)");
        $msg = "Item added to your cart successfully!";
    }
}

// Fetch Featured Products from DB
$featQry = mysqli_query($con, "SELECT * FROM tblpro ORDER BY productid DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameKart - Next-Gen Gaming Gear & Accessories Store</title>
  <?php include("topscript.php"); ?>
  <style>
    /* Hero Banner Card Styling */
    .hero-banner-container {
      max-width: 1240px;
      margin: 32px auto 36px;
      padding: 0 20px;
    }

    .hero-card-banner {
      background: linear-gradient(90deg, #FFFFFF 0%, #FFFFFF 34%, rgba(255, 255, 255, 0.95) 46%, rgba(255, 255, 255, 0.45) 62%, rgba(255, 255, 255, 0) 80%),
                  url('images/gamekart_hero_banner.jpg') no-repeat right center / cover;
      border: 1px solid #E5C7F7;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(206, 92, 255, 0.08);
      overflow: hidden;
      min-height: 450px;
      display: flex;
      align-items: center;
    }

    .hero-card-content {
      max-width: 530px;
      padding: 50px 48px;
    }

    .hero-tag-badge {
      display: inline-block;
      background: #F6EBFF;
      color: #B838EE;
      font-family: var(--font-display);
      font-size: 12.5px;
      font-weight: 700;
      letter-spacing: 1.2px;
      padding: 6px 14px;
      border-radius: 6px;
      margin-bottom: 20px;
      text-transform: uppercase;
    }

    .hero-card-title {
      font-family: var(--font-display);
      font-size: 44px;
      font-weight: 800;
      line-height: 1.1;
      color: #17121A;
      margin-bottom: 16px;
      letter-spacing: 0.5px;
    }

    .hero-card-desc {
      font-size: 14.5px;
      color: #665A68;
      line-height: 1.6;
      margin-bottom: 26px;
    }

    .btn-browse-gear {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #CE5CFF;
      color: #FFFFFF !important;
      font-family: var(--font-display);
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 1px;
      padding: 12px 28px;
      border-radius: 8px;
      text-transform: uppercase;
      text-decoration: none;
      box-shadow: 0 4px 18px rgba(206, 92, 255, 0.4);
      transition: all 0.2s ease;
      margin-bottom: 28px;
    }

    .btn-browse-gear:hover {
      background: #B838EE;
      transform: translateY(-2px);
      box-shadow: 0 6px 22px rgba(206, 92, 255, 0.5);
    }

    .hero-pills-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .hero-pill-badge {
      background: #FFFFFF;
      border: 1px solid #E5C7F7;
      color: #17121A;
      font-family: var(--font-display);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.8px;
      padding: 6px 12px;
      border-radius: 6px;
      text-transform: uppercase;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
    }

    /* Features Strip */
    .features-strip {
      background: var(--theme-surface);
      border-top: 1px solid var(--theme-border);
      border-bottom: 1px solid var(--theme-border);
      padding: 30px 20px;
    }
    .features-grid {
      max-width: 1240px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 24px;
    }
    .feature-box {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 12px 16px;
      background: #FFFFFF;
      border: 1px solid var(--theme-border);
      border-radius: 10px;
    }
    .feature-icon {
      width: 48px;
      height: 48px;
      border-radius: 10px;
      background: var(--theme-surface-soft);
      color: var(--theme-primary-dark);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
    }
    .feature-title {
      font-family: var(--font-display);
      font-size: 16px;
      font-weight: 700;
      color: var(--theme-ink);
      margin-bottom: 2px;
    }
    .feature-desc {
      font-size: 12.5px;
      color: var(--theme-muted);
      margin: 0;
    }

    .promo-banner {
      max-width: 1240px;
      margin: 60px auto;
      padding: 48px 40px;
      background: linear-gradient(135deg, #17121A 0%, #2A1D33 100%);
      border: 1px solid var(--theme-border-accent);
      border-radius: 18px;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 30px;
      box-shadow: 0 10px 30px rgba(206, 92, 255, 0.2);
    }
    .promo-text h2 {
      color: #FFFFFF;
      font-size: 34px;
      margin-bottom: 8px;
    }
    .promo-text p {
      color: #D5A6EE;
      margin: 0;
      font-size: 16px;
    }

    @media (max-width: 900px) {
      .hero-card-banner {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.96) 0%, rgba(255, 255, 255, 0.88) 60%, rgba(255, 255, 255, 0.96) 100%),
                    url('images/gamekart_hero_banner.jpg') no-repeat center center / cover;
      }
      .hero-card-content {
        padding: 36px 24px;
        max-width: 100%;
      }
      .hero-card-title {
        font-size: 32px;
      }
    }
  </style>
</head>
<body>

  <?php include("nav.php"); ?>

  <?php if (!empty($msg)): ?>
    <div style="max-width: 1240px; margin: 20px auto 0; padding: 0 20px;">
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #DCFCE7; border-color: #BBF7D0; color: #15803D; font-weight: 600;">
        <i class="bi bi-check-circle-fill me-2"></i><?php echo $msg; ?>
        <a href="cart.php" class="btn btn-sm btn-primary ms-3" style="padding: 4px 12px; font-size: 12px;">View Cart</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  <?php endif; ?>

  <!-- HERO BANNER CARD (Exact Match to Reference Screenshot) -->
  <div class="hero-banner-container">
    <div class="hero-card-banner">
      <div class="hero-card-content">
        <span class="hero-tag-badge">NEXT-GEN GAMING STORE</span>
        <h1 class="hero-card-title">LEVEL UP YOUR<br>GAMING EXPERIENCE.</h1>
        <p class="hero-card-desc">
          Explore next-gen consoles, pro controllers, high-performance accessories, and top-tier games in one seamless store.
        </p>
        <div>
          <a href="cviewproduct.php" class="btn-browse-gear">
            BROWSE GEAR
          </a>
        </div>
        <div class="hero-pills-row">
          <span class="hero-pill-badge">NEXT-GEN GEAR</span>
          <span class="hero-pill-badge">FAST DISPATCH</span>
          <span class="hero-pill-badge">PRO GAMER CHOICE</span>
        </div>
      </div>
    </div>
  </div>

  <!-- FEATURES STRIP -->
  <section class="features-strip">
    <div class="features-grid">
      <div class="feature-box">
        <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
        <div>
          <div class="feature-title">Ultra-Low 1ms Latency</div>
          <p class="feature-desc">Esports tournament grade speed</p>
        </div>
      </div>
      <div class="feature-box">
        <div class="feature-icon"><i class="bi bi-keyboard"></i></div>
        <div>
          <div class="feature-title">Optical & Mechanical</div>
          <p class="feature-desc">Hot-swappable custom switches</p>
        </div>
      </div>
      <div class="feature-box">
        <div class="feature-icon"><i class="bi bi-headset"></i></div>
        <div>
          <div class="feature-title">7.1 Spatial Audio</div>
          <p class="feature-desc">Pinpoint directional footsteps</p>
        </div>
      </div>
      <div class="feature-box">
        <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
        <div>
          <div class="feature-title">100% Genuine Gear</div>
          <p class="feature-desc">Official warranty on all products</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURED PRODUCTS -->
  <main class="products-wrapper">
    <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 28px; flex-wrap: wrap; gap: 12px;">
      <div>
        <span class="badge badge-purple" style="margin-bottom: 6px;">Hot Picks</span>
        <h2 style="font-size: 32px; margin: 0;">Featured Gaming Hardware</h2>
      </div>
      <a href="cviewproduct.php" class="btn-secondary" style="font-size: 13.5px; padding: 8px 18px;">
        View All Products <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>

    <div class="products-grid">
      <?php if ($featQry && mysqli_num_rows($featQry) > 0): ?>
        <?php while ($pro = mysqli_fetch_assoc($featQry)): ?>
          <div class="product-card">
            <div class="product-thumb">
              <?php 
                $imgName = !empty($pro['img']) ? $pro['img'] : 'demo.jpg';
                $imgPath = "images/" . $imgName;
              ?>
              <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($pro['title']); ?>" onerror="this.src='https://placehold.co/400x300/F6EBFF/CE5CFF?text=GameKart+Gear'">
            </div>
            <div class="product-body">
              <span class="badge badge-purple" style="align-self: flex-start; margin-bottom: 8px; font-size: 11px;">In Stock</span>
              <h3 class="product-title"><?php echo htmlspecialchars($pro['title']); ?></h3>
              <p class="product-desc"><?php echo htmlspecialchars($pro['des']); ?></p>
              
              <?php if (isset($pro['mrp']) && $pro['mrp'] > $pro['price']): ?>
                <div style="font-size: 12.5px; color: var(--theme-muted); text-decoration: line-through;">
                  MRP: ₹<?php echo number_format($pro['mrp']); ?>
                </div>
              <?php endif; ?>

              <div class="product-footer">
                <div class="product-price">₹<?php echo number_format($pro['price']); ?></div>
                <form method="post" style="margin: 0;">
                  <input type="hidden" name="pid" value="<?php echo $pro['productid']; ?>">
                  <button type="submit" name="btnQuickCart" class="btn-primary" style="padding: 7px 16px; font-size: 13px;">
                    <i class="bi bi-cart-plus me-1"></i> Add to Cart
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: var(--theme-surface); border: 1px dashed var(--theme-border); border-radius: 12px;">
          <i class="bi bi-box-seam" style="font-size: 48px; color: var(--theme-primary);"></i>
          <h3 style="margin-top: 12px;">No Products Found</h3>
          <p style="color: var(--theme-text);">Products added via Admin will show up here.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- PROMO BANNER -->
    <div class="promo-banner">
      <div class="promo-text">
        <span class="badge badge-purple" style="background: rgba(206, 92, 255, 0.2); color: #FFFFFF; border-color: var(--theme-primary); margin-bottom: 10px;">Exclusive Deal</span>
        <h2>Upgrade to Pro Esports Level</h2>
        <p>Get instant gaming performance boost with precision sensors and lightning switches.</p>
      </div>
      <div>
        <a href="cviewproduct.php" class="btn-primary" style="background: var(--theme-primary); border-color: var(--theme-primary); padding: 12px 28px; font-size: 16px;">
          Shop Collection Now
        </a>
      </div>
    </div>
  </main>

  <?php include("footer.php"); ?>

</body>
</html>
