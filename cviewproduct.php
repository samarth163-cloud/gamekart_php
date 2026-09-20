<?php
include_once("conn.php");

$msg = "";
$msgType = "success";

// ADD TO CART HANDLER
if (isset($_POST['btnCart'])) {
    if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
        header("Location: clogin.php?msg=login_required");
        exit;
    }
    $uid = (int)$_SESSION['uid'];
    $pid = (int)$_POST['pid'];

    $chk = mysqli_query($con, "SELECT * FROM tblcart WHERE userid=$uid AND productid=$pid");
    if (mysqli_num_rows($chk) > 0) {
        mysqli_query($con, "UPDATE tblcart SET qty = qty + 1 WHERE userid=$uid AND productid=$pid");
        $msg = "Product quantity updated in your cart.";
        $msgType = "info";
    } else {
        mysqli_query($con, "INSERT INTO tblcart(userid, productid, qty) VALUES($uid, $pid, 1)");
        $msg = "Gaming item added to cart successfully!";
        $msgType = "success";
    }
}

// SEARCH & FILTER LOGIC
$search = isset($_GET['q']) ? trim(mysqli_real_escape_string($con, $_GET['q'])) : '';
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';

$whereClause = "";
if ($search !== '') {
    $whereClause = "WHERE title LIKE '%$search%' OR des LIKE '%$search%' OR price LIKE '%$search%'";
}

$orderClause = "ORDER BY productid DESC";
if ($sort === 'price_asc') {
    $orderClause = "ORDER BY price ASC";
} elseif ($sort === 'price_desc') {
    $orderClause = "ORDER BY price DESC";
} elseif ($sort === 'name') {
    $orderClause = "ORDER BY title ASC";
}

$qry = "SELECT * FROM tblpro $whereClause $orderClause";
$res = mysqli_query($con, $qry);
$totalFound = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Products Catalog - GameKart</title>
    <?php include("topscript.php"); ?>
    <style>
        .catalog-header {
            background: linear-gradient(135deg, #FCF8FF 0%, #F6EBFF 100%);
            border-bottom: 1px solid var(--theme-border);
            padding: 40px 20px 30px;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <!-- Header Section with Title & Search -->
    <div class="catalog-header">
        <div class="navbar-container" style="flex-direction: column; gap: 16px;">
            <span class="badge badge-purple">
                <i class="bi bi-controller me-1"></i> Official Gaming Gear Store
            </span>
            <h1 style="font-size: 38px; margin: 0;">Explore Pro Gaming Gear</h1>
            <p style="color: var(--theme-text); max-width: 600px; margin: 0 auto 12px;">
                Find the ultimate mechanical keyboards, ultra-lightweight gaming mice, spatial sound headsets, and streaming accessories.
            </p>

            <!-- Search Bar -->
            <div class="search-container" style="width: 100%; max-width: 600px; margin-bottom: 0;">
                <form method="get" action="cviewproduct.php" style="margin: 0; position: relative;">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="q" class="search-input" placeholder="Search gaming gear (e.g. RGB Keyboard, Wireless Mouse, Headset)..." value="<?php echo htmlspecialchars($search); ?>">
                    <?php if (!empty($search)): ?>
                        <a href="cviewproduct.php" style="position: absolute; right: 90px; top: 50%; transform: translateY(-50%); color: var(--theme-muted); font-size: 13px;">Clear</a>
                    <?php endif; ?>
                    <button type="submit" class="btn-primary" style="position: absolute; right: 6px; top: 6px; bottom: 6px; padding: 0 16px; border-radius: 6px; font-size: 13px;">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Catalog View -->
    <main class="products-wrapper">
        
        <?php if (!empty($msg)): ?>
            <div class="alert alert-<?php echo ($msgType === 'info') ? 'primary' : 'success'; ?> alert-dismissible fade show mb-4" role="alert" style="background: var(--theme-surface-soft); border-color: var(--theme-border); color: var(--theme-primary-dark); font-weight: 600;">
                <i class="bi bi-check2-circle me-2"></i><?php echo $msg; ?>
                <a href="cart.php" class="btn btn-sm btn-primary ms-3" style="padding: 4px 12px; font-size: 12px;">Go to Cart <i class="bi bi-arrow-right ms-1"></i></a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Filter / Result summary bar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px; padding: 12px 18px; background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 8px;">
            <div style="font-size: 14.5px; color: var(--theme-text);">
                Showing <strong><?php echo $totalFound; ?></strong> <?php echo ($totalFound == 1) ? 'product' : 'products'; ?>
                <?php if ($search !== ''): ?>
                    for "<strong><?php echo htmlspecialchars($search); ?></strong>"
                <?php endif; ?>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <label style="font-size: 13.5px; font-weight: 600; color: var(--theme-ink);">Sort By:</label>
                <form method="get" id="sortForm" style="margin: 0;">
                    <?php if (!empty($search)): ?>
                        <input type="hidden" name="q" value="<?php echo htmlspecialchars($search); ?>">
                    <?php endif; ?>
                    <select name="sort" class="form-select" style="width: auto; padding: 6px 30px 6px 12px; font-size: 13px;" onchange="document.getElementById('sortForm').submit();">
                        <option value="" <?php if($sort=='') echo 'selected'; ?>>Newest Arrivals</option>
                        <option value="price_asc" <?php if($sort=='price_asc') echo 'selected'; ?>>Price: Low to High</option>
                        <option value="price_desc" <?php if($sort=='price_desc') echo 'selected'; ?>>Price: High to Low</option>
                        <option value="name" <?php if($sort=='name') echo 'selected'; ?>>Name (A-Z)</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            <?php if ($res && mysqli_num_rows($res) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($res)): ?>
                    <div class="product-card">
                        <div class="product-thumb">
                            <?php 
                                $imgName = !empty($row['img']) ? $row['img'] : 'demo.jpg';
                                $imgPath = "images/" . $imgName;
                            ?>
                            <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" onerror="this.src='https://placehold.co/400x300/F6EBFF/CE5CFF?text=GameKart+Gear'">
                        </div>
                        <div class="product-body">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span class="badge badge-purple" style="font-size: 11px;">In Stock</span>
                                <span style="font-size: 12px; color: var(--theme-muted);"><i class="bi bi-shield-check text-success me-1"></i>1 Yr Warranty</span>
                            </div>

                            <h3 class="product-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p class="product-desc"><?php echo htmlspecialchars($row['des']); ?></p>

                            <?php if (isset($row['mrp']) && $row['mrp'] > $row['price']): ?>
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                    <span style="font-size: 13px; color: var(--theme-muted); text-decoration: line-through;">
                                        MRP: ₹<?php echo number_format($row['mrp']); ?>
                                    </span>
                                    <?php 
                                        $discount = round((($row['mrp'] - $row['price']) / $row['mrp']) * 100);
                                    ?>
                                    <span class="badge badge-success" style="font-size: 10px; padding: 2px 6px;"><?php echo $discount; ?>% OFF</span>
                                </div>
                            <?php endif; ?>

                            <div class="product-footer">
                                <div class="product-price">
                                    ₹<?php echo number_format($row['price']); ?>
                                </div>
                                <form method="post" style="margin: 0;">
                                    <input type="hidden" name="pid" value="<?php echo $row['productid']; ?>">
                                    <button type="submit" name="btnCart" class="btn-primary" style="padding: 8px 16px; font-size: 13px;">
                                        <i class="bi bi-cart-plus me-1"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: var(--theme-surface); border: 1.5px dashed var(--theme-border); border-radius: 12px;">
                    <i class="bi bi-search" style="font-size: 48px; color: var(--theme-primary);"></i>
                    <h3 style="margin-top: 16px;">No Gaming Gear Found</h3>
                    <p style="color: var(--theme-text); max-width: 460px; margin: 0 auto 20px;">
                        We couldn't find any products matching your search "<strong><?php echo htmlspecialchars($search); ?></strong>". Try searching for different keywords or view all products.
                    </p>
                    <a href="cviewproduct.php" class="btn-primary">View All Products</a>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <?php include("footer.php"); ?>

</body>
</html>
