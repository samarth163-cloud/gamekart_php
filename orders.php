<?php
include_once("conn.php");

if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
    header("Location: clogin.php?msg=login_required");
    exit;
}
$uid = (int)$_SESSION['uid'];

$msg = "";
// CANCEL / DELETE ORDER
if (isset($_POST['delete_order'])) {
    $orderid = (int)$_POST['orderid'];
    mysqli_query($con, "DELETE FROM tblorderdetails WHERE orderid=$orderid");
    mysqli_query($con, "DELETE FROM tblorder WHERE orderid=$orderid AND userid=$uid");
    $msg = "Order #$orderid cancelled successfully.";
}

// FETCH USER ORDERS
$q = "SELECT * FROM tblorder WHERE userid=$uid ORDER BY orderdate DESC";
$ordersRes = mysqli_query($con, $q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - GameKart</title>
    <?php include("topscript.php"); ?>
    <style>
        .orders-wrapper {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .order-card {
            background: var(--theme-surface);
            border: 1px solid var(--theme-border);
            border-radius: 14px;
            margin-bottom: 28px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(206, 92, 255, 0.05);
            transition: all 0.25s ease;
        }
        .order-card:hover {
            border-color: var(--theme-primary);
            box-shadow: 0 8px 24px rgba(206, 92, 255, 0.12);
        }
        .order-card-header {
            background: var(--theme-surface-soft);
            border-bottom: 1px solid var(--theme-border);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .order-meta-item {
            display: flex;
            flex-direction: column;
        }
        .order-meta-lbl {
            font-size: 12px;
            color: var(--theme-muted);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .order-meta-val {
            font-weight: 700;
            font-size: 15px;
            color: var(--theme-ink);
        }
        .order-card-body {
            padding: 20px 24px;
        }
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <main class="orders-wrapper">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; flex-wrap: wrap; gap: 12px;">
            <div>
                <span class="badge badge-purple" style="margin-bottom: 8px;">Purchase History</span>
                <h1 style="font-size: 34px; margin: 0;">My Gaming Orders</h1>
            </div>
            <a href="cviewproduct.php" class="btn-secondary" style="font-size: 13.5px;">
                <i class="bi bi-cart-plus me-1"></i> Continue Shopping
            </a>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert" style="background: var(--theme-surface-soft); border-color: var(--theme-border); color: var(--theme-primary-dark); font-weight: 600;">
                <i class="bi bi-info-circle-fill me-2"></i><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($ordersRes && mysqli_num_rows($ordersRes) > 0): ?>
            <?php while ($order = mysqli_fetch_assoc($ordersRes)): ?>
                <?php 
                    $oid = (int)$order['orderid'];
                    $itemsQry = mysqli_query($con, "SELECT d.*, p.title, p.img, p.des 
                                                   FROM tblorderdetails d 
                                                   LEFT JOIN tblpro p ON d.productid = p.productid 
                                                   WHERE d.orderid = $oid");
                ?>
                <div class="order-card">
                    <div class="order-card-header">
                        <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                            <div class="order-meta-item">
                                <span class="order-meta-lbl">Order Placed</span>
                                <span class="order-meta-val"><?php echo date("d M Y, h:i A", strtotime($order['orderdate'])); ?></span>
                            </div>
                            <div class="order-meta-item">
                                <span class="order-meta-lbl">Order Number</span>
                                <span class="order-meta-val" style="font-family: var(--font-logo); color: var(--theme-primary-dark);">#GK-<?php echo str_pad($oid, 5, '0', STR_PAD_LEFT); ?></span>
                            </div>
                            <div class="order-meta-item">
                                <span class="order-meta-lbl">Total Amount</span>
                                <span class="order-meta-val" style="font-family: var(--font-display); font-size: 18px; color: var(--theme-primary-dark);">₹<?php echo number_format($order['totalamout']); ?></span>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px;">
                            <span class="badge badge-success"><i class="bi bi-box-seam me-1"></i> Dispatched & Confirmed</span>
                            
                            <form method="post" onsubmit="return confirm('Are you sure you want to cancel Order #GK-<?php echo $oid; ?>?');" style="margin: 0;">
                                <input type="hidden" name="orderid" value="<?php echo $oid; ?>">
                                <button type="submit" name="delete_order" class="btn-danger" style="padding: 5px 12px; font-size: 12px;">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="order-card-body">
                        <div class="table-container" style="border: none; box-shadow: none;">
                            <table class="gamekart-table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th style="text-align: center;">Quantity</th>
                                        <th style="text-align: right;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($itemsQry && mysqli_num_rows($itemsQry) > 0): ?>
                                        <?php while ($item = mysqli_fetch_assoc($itemsQry)): ?>
                                            <?php 
                                                $imgName = !empty($item['img']) ? $item['img'] : 'demo.jpg';
                                                $imgPath = "images/" . $imgName;
                                            ?>
                                            <tr>
                                                <td>
                                                    <div style="display: flex; align-items: center; gap: 12px;">
                                                        <img src="<?php echo htmlspecialchars($imgPath); ?>" class="table-thumb" alt="Product" onerror="this.src='https://placehold.co/100x100/F6EBFF/CE5CFF?text=Gear'">
                                                        <div>
                                                            <div style="font-weight: 700; color: var(--theme-ink);">
                                                                <?php echo htmlspecialchars($item['title'] ?? 'Gaming Gear'); ?>
                                                            </div>
                                                            <div style="font-size: 12px; color: var(--theme-muted); max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                                <?php echo htmlspecialchars($item['des'] ?? ''); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="font-family: var(--font-display); font-weight: 600;">
                                                    ₹<?php echo number_format($item['price']); ?>
                                                </td>
                                                <td style="text-align: center; font-weight: 600;">
                                                    <?php echo $item['qty']; ?>
                                                </td>
                                                <td style="text-align: right; font-family: var(--font-display); font-weight: 700; color: var(--theme-primary-dark);">
                                                    ₹<?php echo number_format($item['subtotal']); ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center; color: var(--theme-muted);">Order details not found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 70px 20px; background: var(--theme-surface); border: 1.5px dashed var(--theme-border); border-radius: 16px; max-width: 680px; margin: 0 auto;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--theme-surface-soft); color: var(--theme-primary-dark); display: flex; align-items: center; justify-content: center; font-size: 38px; margin: 0 auto 20px;">
                    <i class="bi bi-bag-x"></i>
                </div>
                <h2 style="font-size: 28px; margin-bottom: 8px;">No Orders Placed Yet</h2>
                <p style="color: var(--theme-text); max-width: 440px; margin: 0 auto 24px;">
                    You haven't ordered any gaming gear yet. Level up your setup today with high-performance gaming keyboards, mice, and headsets!
                </p>
                <a href="cviewproduct.php" class="btn-primary" style="padding: 12px 28px; font-size: 15px;">
                    <i class="bi bi-grid-fill me-1"></i> Browse Gaming Gear
                </a>
            </div>
        <?php endif; ?>
    </main>

    <?php include("footer.php"); ?>

</body>
</html>
