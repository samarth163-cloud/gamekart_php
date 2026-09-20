<?php
include_once("conn.php");

$msg = "";
if (isset($_POST['btnUpdateProfile'])) {
    $msg = "Administrator security profile updated successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile & Settings - GameKart</title>
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
                <li><a href="dashboard.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-graph-up-arrow" style="color: #8E7F91;"></i> <span>Dashboard</span></a></li>
                <li><a href="products.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-controller" style="color: #8E7F91;"></i> <span>Products Inventory</span></a></li>
                <li><a href="aorder.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-receipt-cutoff" style="color: #8E7F91;"></i> <span>Manage Orders</span></a></li>
                <li><a href="users.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-people-fill" style="color: #8E7F91;"></i> <span>Customer Accounts</span></a></li>

                <div style="height: 1px; background: #F0E6F6; margin: 14px 0;"></div>

                <li><a href="chome.php" target="_blank" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-shop" style="color: #8E7F91;"></i> <span>View Storefront</span></a></li>
                <li><a href="index.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #665A68; text-decoration: none;"><i class="bi bi-door-open" style="color: #8E7F91;"></i> <span>Portal Gateway</span></a></li>
                <li><a href="logout.php" class="sidebar-item" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 600; color: #DC2626; text-decoration: none;"><i class="bi bi-power" style="color: #DC2626;"></i> <span>Logout</span></a></li>
            </ul>
        </div>
    </aside>

    <!-- Admin Main Body -->
    <main class="admin-main">
        <div class="admin-header">
            <div>
                <h1 style="font-size: 28px; margin: 0;">Administrator Profile</h1>
                <p style="color: var(--theme-muted); margin: 0; font-size: 14px;">Manage system administrator credentials and security settings.</p>
            </div>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="background: #DCFCE7; border-color: #BBF7D0; color: #15803D; font-weight: 600; border-radius: 8px;">
                <i class="bi bi-check-circle-fill me-2"></i><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
            <!-- Profile Card -->
            <div style="background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 12px; padding: 30px;">
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="width: 90px; height: 90px; border-radius: 50%; background: var(--theme-surface-soft); color: var(--theme-primary-dark); display: flex; align-items: center; justify-content: center; font-size: 44px; margin: 0 auto 14px; border: 2px solid var(--theme-border);">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h2 style="font-size: 22px; margin-bottom: 4px;">System Administrator</h2>
                    <span class="badge badge-purple"><i class="bi bi-patch-check-fill me-1"></i> Super Admin</span>
                </div>

                <div style="display: flex; flex-direction: column; gap: 14px; font-size: 14px; border-top: 1px solid var(--theme-border); padding-top: 18px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--theme-muted); font-weight: 600;">Username:</span>
                        <strong style="color: var(--theme-ink);">admin</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--theme-muted); font-weight: 600;">Email:</span>
                        <strong style="color: var(--theme-ink);">admin@gamekart.gg</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--theme-muted); font-weight: 600;">System Access:</span>
                        <span class="badge badge-success" style="font-size: 11px;">Full Root Privileges</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--theme-muted); font-weight: 600;">Platform Engine:</span>
                        <strong style="color: var(--theme-ink);">GameKart Core PHP 8.x</strong>
                    </div>
                </div>
            </div>

            <!-- Security & Update Form -->
            <div style="background: var(--theme-surface); border: 1px solid var(--theme-border); border-radius: 12px; padding: 30px;">
                <h3 style="font-size: 20px; margin-bottom: 18px; border-bottom: 1px solid var(--theme-border); padding-bottom: 10px;">
                    <i class="bi bi-key text-primary me-2"></i> Update Security Credentials
                </h3>

                <form method="post" action="profile.php">
                    <div class="form-group">
                        <label class="form-label">Admin Username</label>
                        <input type="text" class="form-control" value="admin" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact / Recovery Email</label>
                        <input type="email" class="form-control" value="admin@gamekart.gg" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" placeholder="Enter new strong password">
                    </div>

                    <button type="submit" name="btnUpdateProfile" class="btn-primary" style="width: 100%; padding: 11px;">
                        Save Security Settings
                    </button>
                </form>
            </div>
        </div>

    </main>
</div>

</body>
</html>
