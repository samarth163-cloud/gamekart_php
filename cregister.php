<?php
include_once("conn.php");

$success = false;
$error = "";

if (isset($_POST['BtnReg'])) {
    $uname = mysqli_real_escape_string($con, trim($_POST['txtuname']));
    $pwd   = mysqli_real_escape_string($con, trim($_POST['txtpwd']));
    $mail  = mysqli_real_escape_string($con, trim($_POST['txtemail']));
    $gen   = isset($_POST['gender']) ? mysqli_real_escape_string($con, $_POST['gender']) : 'Male';
    $hbb   = isset($_POST['hbb']) && is_array($_POST['hbb']) ? mysqli_real_escape_string($con, implode(",", $_POST['hbb'])) : 'PC Gaming';

    // Check if username already exists
    $chk = mysqli_query($con, "SELECT userid FROM tbluser WHERE username='$uname' OR email='$mail'");
    if (mysqli_num_rows($chk) > 0) {
        $error = "Username or Email is already registered! Please choose another.";
    } else {
        $qry = "INSERT INTO tbluser VALUES (NULL, '$uname', '$pwd', '$mail', '$gen', '$hbb')";
        $x = mysqli_query($con, $qry);

        if ($x) {
            $newId = mysqli_insert_id($con);
            $_SESSION['uid'] = $newId;
            $_SESSION['uname'] = $uname;
            $_SESSION['email'] = $mail;
            $success = true;
        } else {
            $error = "Registration failed: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gamer Registration - GameKart</title>
  <?php include("topscript.php"); ?>
</head>
<body style="background: radial-gradient(circle at top center, #FCF8FF 0%, #F6EBFF 40%, #FFFFFF 100%);">

<div class="auth-wrapper" style="padding: 50px 20px;">
    <div class="auth-card" style="max-width: 500px;">
        <div class="auth-header">
            <a href="chome.php" class="navbar-logo" style="justify-content: center; font-size: 26px; margin-bottom: 12px;">
                <i class="bi bi-controller" style="color: var(--theme-primary);"></i> GAME<span>KART</span>
            </a>
            <h2 class="auth-title">Create Gamer Account</h2>
            <p style="color: var(--theme-muted); font-size: 14px; margin: 0;">Join GameKart to unlock exclusive gaming discounts & rapid delivery</p>
        </div>

        <?php if ($success): ?>
            <div class="alert alert-success text-center" style="background: #DCFCE7; border-color: #BBF7D0; color: #15803D; font-weight: 600; padding: 20px;">
                <i class="bi bi-check-circle-fill" style="font-size: 32px; display: block; margin-bottom: 8px;"></i>
                Account Created Successfully! Welcome, <?php echo htmlspecialchars($uname); ?>.
                <div style="margin-top: 14px;">
                    <a href="chome.php" class="btn-primary" style="padding: 8px 22px;">Start Shopping <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        <?php else: ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert" style="padding: 10px 14px; font-size: 13.5px; border-radius: 8px;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="cregister.php">
                <div class="form-group">
                    <label for="txtuname" class="form-label">Gamer Handle (Username)</label>
                    <input type="text" name="txtuname" id="txtuname" class="form-control" placeholder="e.g. ApexLegend99" required>
                </div>

                <div class="form-group">
                    <label for="txtemail" class="form-label">Email Address</label>
                    <input type="email" name="txtemail" id="txtemail" class="form-control" placeholder="gamer@example.com" required>
                </div>

                <div class="form-group">
                    <label for="txtpwd" class="form-label">Password</label>
                    <input type="password" name="txtpwd" id="txtpwd" class="form-control" placeholder="Create a strong password" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <div style="display: flex; gap: 20px; padding: 6px 0;">
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                            <input type="radio" name="gender" value="Male" checked> Male
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                            <input type="radio" name="gender" value="Female"> Female
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer;">
                            <input type="radio" name="gender" value="Other"> Other
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Gaming Interests</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 4px 0;">
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13.5px; cursor: pointer;">
                            <input type="checkbox" name="hbb[]" value="PC Gaming" checked> PC Gaming
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13.5px; cursor: pointer;">
                            <input type="checkbox" name="hbb[]" value="Console Gaming"> Console Gaming
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13.5px; cursor: pointer;">
                            <input type="checkbox" name="hbb[]" value="Esports & FPS"> Esports / FPS
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13.5px; cursor: pointer;">
                            <input type="checkbox" name="hbb[]" value="RGB Battlestation"> RGB Battlestation
                        </label>
                    </div>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" name="BtnReg" class="btn-primary" style="width: 100%; padding: 12px; font-size: 15px;">
                        <i class="bi bi-person-check-fill me-1"></i> Register Gamer Account
                    </button>
                </div>

                <div style="text-align: center; margin-top: 20px; font-size: 14px; color: var(--theme-text);">
                    Already registered? <a href="clogin.php" style="font-weight: 700; color: var(--theme-primary-dark);">Sign In Here</a>
                </div>

                <div style="text-align: center; margin-top: 14px; border-top: 1px solid var(--theme-border); padding-top: 14px;">
                    <a href="chome.php" style="font-size: 13px; color: var(--theme-muted);">
                        <i class="bi bi-arrow-left me-1"></i> Return to Storefront
                    </a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
