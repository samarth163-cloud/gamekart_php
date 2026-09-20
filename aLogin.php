<?php 
include_once("conn.php");

$error = "";

if (isset($_REQUEST['btnlogin'])) {
    $uname = trim($_REQUEST['txtuname']);
    $pwd   = trim($_REQUEST['txtpwd']);

    if (($uname === 'admin' && $pwd === 'admin123') || ($uname === 'admin' && $pwd === 'admin')) {
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_user'] = 'Administrator';
        header("location:dashboard.php");
        exit;
    } else {
        $error = "Invalid Administrator credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Control Center Login - GameKart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php include("topscript.php"); ?>
</head>
<body style="background: radial-gradient(circle at top center, #FCF8FF 0%, #F6EBFF 40%, #FFFFFF 100%);">

<div class="auth-wrapper">
    <div class="auth-card" style="max-width: 440px;">
        <div class="auth-header">
            <div class="navbar-logo" style="justify-content: center; font-size: 26px; margin-bottom: 12px;">
                <i class="bi bi-shield-lock" style="color: var(--theme-primary);"></i> GAME<span>KART</span>
            </div>
            <span class="badge badge-purple" style="margin-bottom: 8px;">Restricted Access</span>
            <h2 class="auth-title">Admin Control Center</h2>
            <p style="color: var(--theme-muted); font-size: 13.5px; margin: 0;">Sign in to manage gaming inventory, orders & users</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert" style="padding: 10px 14px; font-size: 13.5px; border-radius: 8px;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="aLogin.php">
            <div class="form-group">
                <label for="txtuname" class="form-label">Admin Username</label>
                <input type="text" name="txtuname" id="txtuname" class="form-control" placeholder="admin" value="admin" required autofocus>
            </div>

            <div class="form-group">
                <label for="txtpwd" class="form-label">Password</label>
                <input type="password" name="txtpwd" id="txtpwd" class="form-control" placeholder="••••••••" required>
                <small style="color: var(--theme-muted); font-size: 12px; margin-top: 4px; display: block;">Default password: <code>admin123</code></small>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" name="btnlogin" class="btn-primary" style="width: 100%; padding: 12px; font-size: 15px;">
                    <i class="bi bi-shield-check me-1"></i> Access Admin Dashboard
                </button>
            </div>

            <div style="text-align: center; margin-top: 20px; border-top: 1px solid var(--theme-border); padding-top: 14px;">
                <a href="chome.php" style="font-size: 13px; color: var(--theme-muted);">
                    <i class="bi bi-arrow-left me-1"></i> Return to Customer Storefront
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
