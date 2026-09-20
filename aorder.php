<?php
include_once("conn.php");

$msg = "";
// Delete order if requested
if (isset($_GET['deleteid'])) {
    $oid = intval($_GET['deleteid']);
    mysqli_query($con, "DELETE FROM tblorderdetails WHERE orderid=$oid");
    mysqli_query($con, "DELETE FROM tblorder WHERE orderid=$oid");
    $msg = "Order #GK-$oid deleted successfully.";
}

// Fetch orders with user info
$query = "
    SELECT o.orderid, o.orderdate, o.totalamout, u.username, u.email, u.gender 
    FROM tblorder o
    LEFT JOIN tbluser u ON o.userid = u.userid
    ORDER BY o.orderdate DESC
";
$res = mysqli_query($con, $query);
$totalOrdersCount = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders Management - GameKart Admin</title>
    <?php include("topscript.php"); ?>
    <style>
        body {
            background-color: #FAFAFF;
            font-family: var(--font-body);
            color: #17121A;
            margin: 0;
            padding: 0;
        }

        /* Layout Structure */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: 250px;
            background: #FFFFFF;
            border-right: 1px solid #F0E6F6;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 24px 16px;
            justify-content: space-between;
        }

        .sidebar-brand-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 8px 24px;
            text-decoration: none;
        }

        .brand-logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #CE5CFF 0%, #A824E3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(206, 92, 255, 0.35);
        }

        .brand-text {
            font-family: var(--font-logo);
            font-size: 19px;
            font-weight: 800;
            letter-spacing: 0.8px;
            color: #17121A;
        }

        .brand-text span {
            color: #CE5CFF;
            margin-left: 2px;
        }

        .admin-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            font-family: var(--font-body);
            font-size: 14.5px;
            font-weight: 600;
            color: #665A68;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .sidebar-item i {
            font-size: 17px;
            color: #8E7F91;
            transition: color 0.2s ease;
        }

        .sidebar-item:hover {
            background: #FDF9FF;
            color: #CE5CFF;
        }

        .sidebar-item:hover i {
            color: #CE5CFF;
        }

        .sidebar-item.active {
            background: #F6EBFF;
            color: #B838EE;
            font-weight: 700;
        }

        .sidebar-item.active i {
            color: #CE5CFF;
        }

        .sidebar-item.logout {
            color: #DC2626 !important;
        }

        .sidebar-item.logout i {
            color: #DC2626 !important;
        }

        .sidebar-item.logout:hover {
            background: #FEE2E2;
        }

        .sidebar-divider {
            height: 1px;
            background: #F0E6F6;
            margin: 14px 0;
        }

        /* Main Content Container */
        .admin-main-content {
            flex-grow: 1;
            padding: 36px 40px;
            overflow-y: auto;
            max-width: 1360px;
        }

        /* Top Header */
        .page-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        .page-title {
            font-family: var(--font-display);
            font-size: 30px;
            font-weight: 700;
            color: #17121A;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .page-title i {
            color: #CE5CFF;
            font-size: 28px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #665A68;
            margin: 4px 0 0 0;
        }

        /* Order Card Styling */
        .order-card-wrapper {
            background: #FFFFFF;
            border: 1px solid #E5C7F7;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 2px 12px rgba(206, 92, 255, 0.04);
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .order-card-wrapper:hover {
            box-shadow: 0 6px 20px rgba(206, 92, 255, 0.08);
            border-color: #D5A6EE;
        }

        /* Card Top Header */
        .order-card-top {
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            border-bottom: 1px solid #F0E6F6;
        }

        .order-meta-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .order-id-tag {
            font-family: var(--font-logo);
            font-size: 16px;
            font-weight: 800;
            color: #17121A;
            letter-spacing: 0.5px;
        }

        .order-user-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #F6EBFF;
            color: #B838EE;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 13px;
            font-weight: 700;
        }

        .order-info-text {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #8E7F91;
            font-size: 13.5px;
            font-weight: 500;
        }

        .order-meta-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .order-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #DCFCE7;
            color: #15803D;
            border: 1px solid #BBF7D0;
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .order-total-display {
            font-family: var(--font-display);
            font-size: 20px;
            font-weight: 800;
            color: #B838EE;
            letter-spacing: 0.5px;
        }

        .btn-delete-order {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #DC2626;
            color: #FFFFFF !important;
            border: 1px solid #DC2626;
            padding: 6px 14px;
            border-radius: 6px;
            font-family: var(--font-display);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-delete-order:hover {
            background: #B91C1C;
            border-color: #B91C1C;
        }

        /* Card Inner Table */
        .order-card-body {
            padding: 16px 24px 20px;
        }

        .order-items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-items-table th {
            background: #FBF5FF;
            color: #17121A;
            font-family: var(--font-display);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            padding: 11px 16px;
            text-transform: uppercase;
            border: none;
        }

        .order-items-table th:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .order-items-table th:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .order-items-table td {
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 14px;
            border-bottom: 1px solid #F6EBFF;
        }

        .order-items-table tr:last-child td {
            border-bottom: none;
        }

        .item-thumb-preview {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: contain;
            background: #FCF8FF;
            border: 1px solid #E5C7F7;
            padding: 2px;
        }

        .item-title-text {
            font-weight: 600;
            color: #17121A;
            font-size: 14.5px;
        }

        .item-qty-text {
            font-weight: 600;
            color: #17121A;
            font-size: 14.5px;
        }

        .item-price-text {
            color: #8E7F91;
            font-size: 14px;
            font-weight: 500;
        }

        .item-subtotal-text {
            font-family: var(--font-display);
            font-weight: 700;
            color: #B838EE;
            font-size: 15px;
        }

        @media (max-width: 992px) {
            .admin-layout {
                flex-direction: column;
            }
            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .admin-main-content {
                padding: 20px;
            }
            .order-card-top {
                flex-direction: column;
                align-items: flex-start;
            }
            .order-meta-right {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar">
        <div>
            <a href="dashboard.php" class="sidebar-brand-wrap">
                <div class="brand-logo-icon">
                    <i class="bi bi-controller"></i>
                </div>
                <div class="brand-text">
                    GAME<span>KART</span>
                </div>
            </a>

            <ul class="admin-nav-list">
                <li>
                    <a href="dashboard.php" class="sidebar-item">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="products.php" class="sidebar-item">
                        <i class="bi bi-controller"></i>
                        <span>Products Inventory</span>
                    </a>
                </li>
                <li>
                    <a href="aorder.php" class="sidebar-item active">
                        <i class="bi bi-receipt-cutoff"></i>
                        <span>Manage Orders</span>
                    </a>
                </li>
                <li>
                    <a href="users.php" class="sidebar-item">
                        <i class="bi bi-people-fill"></i>
                        <span>Customer Accounts</span>
                    </a>
                </li>

                <div class="sidebar-divider"></div>

                <li>
                    <a href="chome.php" target="_blank" class="sidebar-item">
                        <i class="bi bi-shop"></i>
                        <span>View Storefront</span>
                    </a>
                </li>
                <li>
                    <a href="index.php" class="sidebar-item">
                        <i class="bi bi-door-open"></i>
                        <span>Portal Gateway</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="sidebar-item logout">
                        <i class="bi bi-power"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main-content">
        
        <!-- Header Row -->
        <div class="page-header-row">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-receipt-cutoff"></i> Customer Orders
                </h1>
                <p class="page-subtitle">
                    Review ordered gaming gear, buyer contact details, payment receipts, and fulfill orders.
                </p>
            </div>
            <div>
                <span class="badge badge-purple" style="font-size: 13px; padding: 7px 16px;">
                    Total: <?php echo $totalOrdersCount; ?> Orders
                </span>
            </div>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px;">
                <i class="bi bi-info-circle-fill me-2"></i><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Orders Cards List -->
        <?php if ($res && mysqli_num_rows($res) > 0): ?>
            <?php while ($ord = mysqli_fetch_assoc($res)): ?>
                <?php 
                    $oid = (int)$ord['orderid'];
                    $itemsQry = mysqli_query($con, "
                        SELECT d.*, p.title, p.img 
                        FROM tblorderdetails d 
                        LEFT JOIN tblpro p ON d.productid = p.productid 
                        WHERE d.orderid = $oid
                    ");
                    $hasItems = ($itemsQry && mysqli_num_rows($itemsQry) > 0);
                ?>
                <div class="order-card-wrapper">
                    <!-- Top Bar of Order Card -->
                    <div class="order-card-top">
                        <div class="order-meta-left">
                            <span class="order-id-tag">#GK-<?php echo $oid; ?></span>
                            <span class="order-user-pill">
                                <i class="bi bi-person"></i> <?php echo htmlspecialchars($ord['username'] ?? 'user'); ?>
                            </span>
                            <span class="order-info-text">
                                <i class="bi bi-envelope"></i> <?php echo htmlspecialchars($ord['email'] ?? 'user@gmail.com'); ?>
                            </span>
                            <span class="order-info-text">
                                <i class="bi bi-clock"></i> <?php echo date("d M Y, h:i A", strtotime($ord['orderdate'])); ?>
                            </span>
                        </div>

                        <div class="order-meta-right">
                            <span class="order-status-badge">
                                <i class="bi bi-check-circle-fill"></i> CONFIRMED & PAID
                            </span>
                            <span class="order-total-display">
                                ₹<?php echo number_format($ord['totalamout']); ?>
                            </span>
                            <a href="aorder.php?deleteid=<?php echo $oid; ?>" class="btn-delete-order" onclick="return confirm('Are you sure you want to delete order #GK-<?php echo $oid; ?>?');">
                                <i class="bi bi-trash-fill"></i> Delete
                            </a>
                        </div>
                    </div>

                    <!-- Inner Table of Order Items -->
                    <div class="order-card-body">
                        <table class="order-items-table">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">PHOTO</th>
                                    <th>GAMING ITEM</th>
                                    <th style="width: 90px; text-align: center;">QTY</th>
                                    <th style="width: 140px; text-align: right;">UNIT PRICE</th>
                                    <th style="width: 140px; text-align: right;">SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($hasItems): ?>
                                    <?php while ($item = mysqli_fetch_assoc($itemsQry)): ?>
                                        <?php 
                                            $imgName = !empty($item['img']) ? $item['img'] : 'demo.jpg';
                                            $imgPath = "images/" . $imgName;
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo htmlspecialchars($imgPath); ?>" class="item-thumb-preview" alt="Gear" onerror="this.src='https://placehold.co/100x100/F6EBFF/CE5CFF?text=Gear'">
                                            </td>
                                            <td>
                                                <div class="item-title-text">
                                                    <?php echo htmlspecialchars($item['title'] ?? 'Gaming Gear'); ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                <span class="item-qty-text"><?php echo $item['qty']; ?></span>
                                            </td>
                                            <td style="text-align: right;">
                                                <span class="item-price-text">₹<?php echo number_format($item['price']); ?></span>
                                            </td>
                                            <td style="text-align: right;">
                                                <span class="item-subtotal-text">₹<?php echo number_format($item['subtotal']); ?></span>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 26px 16px; color: #8E7F91; font-size: 14px;">
                                            Line items details not recorded.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 60px 20px; background: #FFFFFF; border: 1.5px dashed #E5C7F7; border-radius: 16px;">
                <i class="bi bi-receipt" style="font-size: 48px; color: #CE5CFF;"></i>
                <h3 style="margin-top: 14px; font-size: 22px;">No Orders Recorded Yet</h3>
                <p style="color: #665A68;">Customer purchases placed on the storefront will be listed here.</p>
            </div>
        <?php endif; ?>

    </main>
</div>

</body>
</html>
