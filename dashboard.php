<?php
include_once("conn.php");

// Fetch Dashboard Counts
$proCount = 0;
$userCount = 0;
$orderCount = 0;
$totalRevenue = 0;

$pRes = mysqli_query($con, "SELECT COUNT(*) as c FROM tblpro");
if ($pRes) { $proCount = mysqli_fetch_assoc($pRes)['c']; }

$uRes = mysqli_query($con, "SELECT COUNT(*) as c FROM tbluser");
if ($uRes) { $userCount = mysqli_fetch_assoc($uRes)['c']; }

$oRes = mysqli_query($con, "SELECT COUNT(*) as c, SUM(totalamout) as rev FROM tblorder");
if ($oRes) {
    $row = mysqli_fetch_assoc($oRes);
    $orderCount = $row['c'] ?? 0;
    $totalRevenue = $row['rev'] ?? 0;
}

// Fetch recent 5 orders
$recentOrders = mysqli_query($con, "
    SELECT o.orderid, o.orderdate, o.totalamout, u.username, u.email 
    FROM tblorder o 
    LEFT JOIN tbluser u ON o.userid = u.userid 
    ORDER BY o.orderdate DESC 
    LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GameKart</title>
    <?php include("topscript.php"); ?>
</head>
<body>

<div class="admin-layout">
    <!-- Admin Sidebar -->
    <aside class="admin-sidebar" style="width: 250px; background: #FFFFFF; border-right: 1px solid #F0E6F6; padding: 24px 16px;">
        <div>
            <a href="dashboard.php" class="sidebar-brand-wrap" style="display: flex; align-items: center; gap: 10px; padding: 0 8px 24px; text-decoration: none;">
                <div class="brand-logo-icon" style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #CE5CFF 0%, #A824E3 100%); display: flex; align-items: center; justify-content: center; color: #FFFFFF; font-size: 20px; box-shadow: 0 4px 12px rgba(206, 92, 255, 0.35);">
                    <i class="bi bi-controller"></i>
                </div>
                <div class="brand-text" style="font-family: var(--font-logo); font-size: 19px; font-weight: 800; letter-spacing: 0.8px; color: #17121A;">
                    GAME<span style="color: #CE5CFF;">KART</span>
                </div>
            </a>

            <ul class="admin-nav-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 6px;">
                <li><a href="dashboard.php" class="sidebar-item active" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 700; background: #F6EBFF; color: #B838EE; text-decoration: none;"><i class="bi bi-graph-up-arrow" style="color: #CE5CFF;"></i> <span>Dashboard</span></a></li>
                <li><a href="products.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-controller" style="color: #8E7F91;"></i> <span>Products Inventory</span></a></li>
                <li><a href="aorder.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-receipt-cutoff" style="color: #8E7F91;"></i> <span>Manage Orders</span></a></li>
                <li><a href="users.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-people-fill" style="color: #8E7F91;"></i> <span>Customer Accounts</span></a></li>

                <div style="height: 1px; background: #F0E6F6; margin: 14px 0;"></div>

                <li><a href="chome.php" target="_blank" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-shop" style="color: #8E7F91;"></i> <span>View Storefront</span></a></li>
                <li><a href="index.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-door-open" style="color: #8E7F91;"></i> <span>Portal Gateway</span></a></li>
                <li><a href="aLogin.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #DC2626; text-decoration: none;"><i class="bi bi-power" style="color: #DC2626;"></i> <span>Logout</span></a></li>
            </ul>
        </div>
    </aside>

    <!-- Admin Main Body -->
    <main class="admin-main">
        <div class="admin-header">
            <div>
                <h1 style="font-size: 28px; margin: 0;">System Overview</h1>
                <p style="color: var(--theme-muted); margin: 0; font-size: 14px;">Welcome back, Administrator. Here is today's GameKart performance report.</p>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="badge badge-purple"><i class="bi bi-shield-check me-1"></i> Admin Portal Active</span>
                <a href="products.php" class="btn-primary" style="padding: 8px 16px; font-size: 13.5px;">
                    <i class="bi bi-plus-circle me-1"></i> Add Product
                </a>
            </div>
        </div>

        <!-- KPI Stats Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 32px;">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-currency-rupee"></i></div>
                <div>
                    <div class="stat-val">₹<?php echo number_format($totalRevenue); ?></div>
                    <div class="stat-lbl">Total Revenue</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-receipt"></i></div>
                <div>
                    <div class="stat-val"><?php echo $orderCount; ?></div>
                    <div class="stat-lbl">Customer Orders</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-val"><?php echo $proCount; ?></div>
                    <div class="stat-lbl">Gaming Products</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <div>
                    <div class="stat-val"><?php echo $userCount; ?></div>
                    <div class="stat-lbl">Registered Gamers</div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div style="margin-bottom: 32px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h2 style="font-size: 20px; margin: 0;">Recent Customer Orders</h2>
                <a href="aorder.php" class="btn-secondary" style="padding: 6px 14px; font-size: 12.5px;">View All Orders <i class="bi bi-arrow-right ms-1"></i></a>
            </div>

            <div class="table-container">
                <table class="gamekart-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($recentOrders && mysqli_num_rows($recentOrders) > 0): ?>
                            <?php while ($ord = mysqli_fetch_assoc($recentOrders)): ?>
                                <tr>
                                    <td style="font-family: var(--font-logo); font-weight: 700; color: var(--theme-primary-dark);">
                                        #GK-<?php echo str_pad($ord['orderid'], 5, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td style="font-weight: 600; color: var(--theme-ink);">
                                        <?php echo htmlspecialchars($ord['username'] ?? 'Gamer'); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($ord['email'] ?? 'N/A'); ?></td>
                                    <td><?php echo date("d M Y, h:i A", strtotime($ord['orderdate'])); ?></td>
                                    <td style="font-family: var(--font-display); font-weight: 700; color: var(--theme-primary-dark); font-size: 15px;">
                                        ₹<?php echo number_format($ord['totalamout']); ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-success"><i class="bi bi-check2 me-1"></i> Completed</span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 24px; color: var(--theme-muted);">No orders recorded in system yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Shortcuts Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            <div style="background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 10px; padding: 22px;">
                <h3 style="font-size: 17px; margin-bottom: 8px;"><i class="bi bi-box-seam text-primary me-2"></i> Inventory Management</h3>
                <p style="font-size: 13.5px; color: var(--theme-text); margin-bottom: 16px;">Add new mechanical keyboards, mice, or update current inventory prices & descriptions.</p>
                <a href="products.php" class="btn-secondary" style="padding: 7px 16px; font-size: 13px;">Manage Inventory</a>
            </div>

            <div style="background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 10px; padding: 22px;">
                <h3 style="font-size: 17px; margin-bottom: 8px;"><i class="bi bi-people text-primary me-2"></i> Customer Accounts</h3>
                <p style="font-size: 13.5px; color: var(--theme-text); margin-bottom: 16px;">View registered customer gamer profiles, contact details, and account records.</p>
                <a href="users.php" class="btn-secondary" style="padding: 7px 16px; font-size: 13px;">Manage Users</a>
            </div>
        </div>

    </main>
</div>

</body>
</html>
