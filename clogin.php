<?php 
include_once("conn.php");

$error = "";

if (isset($_REQUEST['btnlogin'])) {
    $uname = mysqli_real_escape_string($con, trim($_REQUEST['txtuname']));
    $pwd   = mysqli_real_escape_string($con, trim($_REQUEST['txtpwd']));

    $x = mysqli_query($con, "SELECT * FROM tbluser WHERE username='$uname' AND password='$pwd'");

    if ($x && mysqli_num_rows($x) > 0) {
        $unifo = mysqli_fetch_array($x);
        $_SESSION['uid']   = $unifo['userid'];
        $_SESSION['uname'] = $unifo['username'];
        $_SESSION['email'] = $unifo['email'];
        header("location:chome.php");
        exit;
    } else {
        $error = "Invalid Username or Password! Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gamer Login - GameKart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("topscript.php"); ?>
</head>
<body style="background: radial-gradient(circle at top center, #FCF8FF 0%, #F6EBFF 40%, #FFFFFF 100%);">

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <a href="chome.php" class="navbar-logo" style="justify-content: center; font-size: 26px; margin-bottom: 12px;">
                <i class="bi bi-controller" style="color: var(--theme-primary);"></i> GAME<span>KART</span>
            </a>
            <h2 class="auth-title">Gamer Sign In</h2>
            <p style="color: var(--theme-muted); font-size: 14px; margin: 0;">Enter your credentials to access your gaming cart & orders</p>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'logged_out'): ?>
            <div class="alert alert-success" role="alert" style="background: #DCFCE7; border-color: #BBF7D0; color: #15803D; padding: 10px 14px; font-size: 13.5px; border-radius: 8px;">
                <i class="bi bi-check-circle-fill me-2"></i> You have logged out successfully.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'login_required'): ?>
            <div class="alert alert-info" role="alert" style="background: var(--theme-surface-soft); border-color: var(--theme-border); color: var(--theme-primary-dark); padding: 10px 14px; font-size: 13.5px; border-radius: 8px;">
                <i class="bi bi-info-circle-fill me-2"></i> Please sign in to access your cart, place orders, and manage gaming gear.
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert" style="padding: 10px 14px; font-size: 13.5px; border-radius: 8px;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="clogin.php">
            <div class="form-group">
                <label for="txtuname" class="form-label">Username</label>
                <div style="position: relative;">
                    <input type="text" name="txtuname" id="txtuname" class="form-control" placeholder="Enter your gamer handle" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <label for="txtpwd" class="form-label" style="margin: 0;">Password</label>
                </div>
                <input type="password" name="txtpwd" id="txtpwd" class="form-control" placeholder="••••••••" required>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" name="btnlogin" class="btn-primary" style="width: 100%; padding: 12px; font-size: 15px;">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to GameKart
                </button>
            </div>

            <div style="text-align: center; margin-top: 20px; font-size: 14px; color: var(--theme-text);">
                New to GameKart? <a href="cregister.php" style="font-weight: 700; color: var(--theme-primary-dark);">Create Gamer Account</a>
            </div>

            <div style="text-align: center; margin-top: 14px; border-top: 1px solid var(--theme-border); padding-top: 14px;">
                <a href="chome.php" style="font-size: 13px; color: var(--theme-muted);">
                    <i class="bi bi-arrow-left me-1"></i> Return to Storefront
                </a>
                <span style="margin: 0 8px; color: var(--theme-border);">|</span>
                <a href="aLogin.php" style="font-size: 13px; color: var(--theme-muted);">
                    <i class="bi bi-shield-lock me-1"></i> Admin Portal
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
