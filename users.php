<?php
include_once("conn.php");

$msg = "";
// Delete user if requested
if (isset($_GET['deleteid'])) {
    $uid = intval($_GET['deleteid']);
    mysqli_query($con, "DELETE FROM tbluser WHERE userid = $uid");
    $msg = "Gamer account #$uid deleted successfully.";
}

// Search functionality
$search = isset($_GET['txtsname']) ? trim(mysqli_real_escape_string($con, $_GET['txtsname'])) : '';
if (!empty($search)) {
    $res = mysqli_query($con, "SELECT * FROM tbluser WHERE username LIKE '%$search%' OR email LIKE '%$search%' ORDER BY userid DESC"); 
} else {
    $res = mysqli_query($con, "SELECT * FROM tbluser ORDER BY userid DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Gamers - GameKart Admin</title>
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
                <li><a href="users.php" class="sidebar-item active" style="display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; font-size: 14.5px; font-weight: 700; background: #F6EBFF; color: #B838EE; text-decoration: none;"><i class="bi bi-people-fill" style="color: #CE5CFF;"></i> <span>Customer Accounts</span></a></li>

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
                <h1 style="font-size: 28px; margin: 0;">Registered Gamers & Customers</h1>
                <p style="color: var(--theme-muted); margin: 0; font-size: 14px;">Manage user accounts, view gamer profiles, and maintain platform security.</p>
            </div>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert" style="border-radius: 8px;">
                <i class="bi bi-info-circle-fill me-2"></i><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Search Bar -->
        <div style="margin-bottom: 24px; max-width: 480px;">
            <form method="get" action="users.php" style="display: flex; gap: 10px;">
                <input type="text" name="txtsname" class="form-control" placeholder="Search by gamer username or email..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn-primary" style="padding: 0 18px; font-size: 13.5px;">
                    Search
                </button>
                <?php if (!empty($search)): ?>
                    <a href="users.php" class="btn-secondary" style="padding: 0 14px; font-size: 13.5px;">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Users Table -->
        <div class="table-container">
            <table class="gamekart-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Gamer Handle</th>
                        <th>Email Address</th>
                        <th>Gender</th>
                        <th>Gaming Interests / Preferences</th>
                        <th style="text-align: right; width: 120px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($res && mysqli_num_rows($res) > 0): ?>
                        <?php while ($u = mysqli_fetch_assoc($res)): ?>
                            <tr>
                                <td style="font-family: var(--font-logo); font-weight: 700; color: var(--theme-muted);">
                                    #<?php echo $u['userid']; ?>
                                </td>
                                <td style="font-weight: 700; color: var(--theme-ink);">
                                    <i class="bi bi-person-badge text-primary me-2"></i>
                                    <?php echo htmlspecialchars($u['username']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($u['email']); ?>
                                </td>
                                <td>
                                    <span class="badge badge-purple" style="font-size: 11px;">
                                        <?php echo htmlspecialchars($u['gender']); ?>
                                    </span>
                                </td>
                                <td style="font-size: 13px; color: var(--theme-text);">
                                    <?php echo htmlspecialchars($u['hobbies'] ?? 'Gaming Gear'); ?>
                                </td>
                                <td style="text-align: right;">
                                    <a href="users.php?deleteid=<?php echo $u['userid']; ?>" class="btn-danger" style="padding: 5px 12px; font-size: 12px;" onclick="return confirm('Permanently delete gamer account <?php echo htmlspecialchars($u['username']); ?>?');">
                                        <i class="bi bi-person-x me-1"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--theme-muted);">
                                No registered users found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>
</div>

</body>
</html>
