<?php
include_once("conn.php");

if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
    header("Location: clogin.php?msg=login_required");
    exit;
}
$uid = (int)$_SESSION['uid'];

$msg = "";
$msgType = "success";

// REMOVE ITEM
if (isset($_POST['remove'])) {
    $cid = (int)$_POST['cid'];
    mysqli_query($con, "DELETE FROM tblcart WHERE cartid=$cid AND userid=$uid");
    $msg = "Item removed from cart.";
    $msgType = "info";
}

// CLEAR CART
if (isset($_POST['clear_cart'])) {
    mysqli_query($con, "DELETE FROM tblcart WHERE userid=$uid");
    $msg = "Cart cleared successfully.";
    $msgType = "info";
}

// UPDATE QUANTITY
if (isset($_POST['update'])) {
    if (isset($_POST['qty']) && is_array($_POST['qty'])) {
        foreach ($_POST['qty'] as $cid => $qty) {
            $cid = (int)$cid;
            $qty = max(1, (int)$qty);
            mysqli_query($con, "UPDATE tblcart SET qty=$qty WHERE cartid=$cid AND userid=$uid");
        }
        $msg = "Cart quantities updated successfully.";
    }
}

// FETCH CART ITEMS
$q = "SELECT c.cartid, c.qty, p.productid, p.title, p.price, p.mrp, p.des, p.img 
      FROM tblcart c 
      JOIN tblpro p ON c.productid = p.productid 
      WHERE c.userid = $uid";
$res = mysqli_query($con, $q);

$total = 0;
$itemCount = 0;
$items = [];
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $subtotal = $row['qty'] * $row['price'];
        $total += $subtotal;
        $itemCount += $row['qty'];
        $items[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart & Payment - GameKart</title>
    <?php include("topscript.php"); ?>
    <style>
        .cart-wrapper {
            max-width: 1240px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .cart-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 32px;
            align-items: flex-start;
        }
        .summary-card {
            background: var(--theme-surface);
            border: 1px solid var(--theme-border);
            border-radius: 16px;
            padding: 26px;
            box-shadow: 0 4px 20px rgba(206, 92, 255, 0.06);
            position: sticky;
            top: 90px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14.5px;
            color: var(--theme-text);
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px dashed var(--theme-border);
            padding-top: 16px;
            margin-top: 16px;
            font-family: var(--font-display);
            font-size: 24px;
            font-weight: 800;
            color: var(--theme-ink);
        }
        .qty-input {
            width: 58px;
            padding: 6px 8px;
            text-align: center;
            border: 1px solid var(--theme-border);
            border-radius: 6px;
            font-weight: 700;
            outline: none;
        }
        .qty-input:focus {
            border-color: var(--theme-primary);
        }

        /* Payment Options Box */
        .payment-box {
            background: #FFFFFF;
            border: 1px solid var(--theme-border);
            border-radius: 12px;
            padding: 18px;
            margin-top: 20px;
        }
        .payment-option-card {
            border: 1.5px solid var(--theme-border);
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #FFFFFF;
        }
        .payment-option-card.selected {
            border-color: var(--theme-primary);
            background: #FCF8FF;
            box-shadow: 0 2px 10px rgba(206, 92, 255, 0.12);
        }
        .payment-details-panel {
            display: none;
            padding: 14px 4px 4px;
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 992px) {
            .cart-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <main class="cart-wrapper">
        <div style="margin-bottom: 28px;">
            <span class="badge badge-purple" style="margin-bottom: 8px;">Order & Payment</span>
            <h1 style="font-size: 34px; margin: 0;">Your Gaming Shopping Cart</h1>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-<?php echo ($msgType == 'info') ? 'primary' : 'success'; ?> alert-dismissible fade show mb-4" role="alert" style="background: var(--theme-surface-soft); border-color: var(--theme-border); color: var(--theme-primary-dark); font-weight: 600; border-radius: 10px;">
                <i class="bi bi-info-circle-fill me-2"></i><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (count($items) > 0): ?>
            <div class="cart-grid">
                <!-- Left Column: Cart Items Table -->
                <div>
                    <form method="post" action="cart.php" id="cartForm">
                        <div class="table-container" style="border-radius: 12px; border: 1px solid var(--theme-border);">
                            <table class="gamekart-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th style="text-align: center;">Qty</th>
                                        <th>Subtotal</th>
                                        <th style="text-align: right;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <?php 
                                            $subtotal = $item['qty'] * $item['price'];
                                            $imgName = !empty($item['img']) ? $item['img'] : 'demo.jpg';
                                            $imgPath = "images/" . $imgName;
                                        ?>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 14px;">
                                                    <img src="<?php echo htmlspecialchars($imgPath); ?>" class="table-thumb" alt="<?php echo htmlspecialchars($item['title']); ?>" onerror="this.src='https://placehold.co/100x100/F6EBFF/CE5CFF?text=Gear'">
                                                    <div>
                                                        <div style="font-weight: 700; color: var(--theme-ink); font-size: 14.5px;">
                                                            <?php echo htmlspecialchars($item['title']); ?>
                                                        </div>
                                                        <div style="font-size: 12px; color: var(--theme-muted); max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            <?php echo htmlspecialchars($item['des']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="font-family: var(--font-display); font-weight: 700; color: var(--theme-primary-dark); font-size: 15.5px;">
                                                ₹<?php echo number_format($item['price']); ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="number" name="qty[<?php echo $item['cartid']; ?>]" value="<?php echo $item['qty']; ?>" min="1" max="99" class="qty-input">
                                            </td>
                                            <td style="font-family: var(--font-display); font-weight: 700; color: var(--theme-ink); font-size: 16px;">
                                                ₹<?php echo number_format($subtotal); ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <button type="submit" name="remove" value="1" onclick="this.form.cid.value='<?php echo $item['cartid']; ?>';" class="btn-danger" style="padding: 5px 10px; font-size: 12px; border-radius: 6px;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="cid" value="">

                        <!-- Table Footer Actions -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 18px; flex-wrap: wrap; gap: 12px;">
                            <a href="cviewproduct.php" class="btn-secondary" style="font-size: 13.5px;">
                                <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                            </a>
                            <div style="display: flex; gap: 10px;">
                                <button type="submit" name="clear_cart" class="btn-secondary" style="color: var(--theme-danger) !important; border-color: var(--theme-danger) !important; font-size: 13.5px;" onclick="return confirm('Clear all items from your cart?');">
                                    <i class="bi bi-trash me-1"></i> Clear Cart
                                </button>
                                <button type="submit" name="update" class="btn-primary" style="font-size: 13.5px;">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Update Quantities
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

<?php
    $upi_id = "9825904828@fam";
    $upiUrl = "upi://pay?pa=" . $upi_id . "&pn=GameKart&am=" . $total . "&cu=INR";
    $qr = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($upiUrl) . "&size=220x220";
?>
                <!-- Right Column: Checkout & Payment Methods -->
                <div>
                    <div class="summary-card">
                        <h3 style="font-size: 20px; margin-bottom: 16px; border-bottom: 1.5px solid var(--theme-border); padding-bottom: 12px; font-family: var(--font-heading); font-weight: 800; color: var(--theme-ink);">
                            <i class="bi bi-receipt me-2 text-primary"></i> Order Summary & Payment
                        </h3>
                        
                        <div class="summary-row">
                            <span>Total Items:</span>
                            <strong><?php echo $itemCount; ?> units</strong>
                        </div>
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span style="font-weight: 700;">₹<?php echo number_format($total); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Fast Delivery:</span>
                            <span class="badge badge-success" style="font-size: 11px;">FREE EXPRESS</span>
                        </div>
                        <div class="summary-row">
                            <span>GST & Tax:</span>
                            <span>Included</span>
                        </div>

                        <div class="summary-total">
                            <span>Grand Total:</span>
                            <span style="color: var(--theme-primary-dark); font-family: var(--font-display); font-weight: 800; font-size: 26px;">
                                ₹<?php echo number_format($total); ?>
                            </span>
                        </div>

                        <!-- Checkout & Payment Form -->
                        <form method="post" action="placeorder.php" id="checkoutForm" style="margin-top: 24px;">
                            <!-- PAYMENT SECTION -->
                            <div class="pay-box" style="background: var(--theme-surface-soft); border: 1.5px solid var(--theme-border); border-radius: 14px; padding: 20px;">
                                <h5 style="color: var(--theme-primary-dark); font-family: var(--font-heading); font-weight: 700; font-size: 16px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                    <i class="bi bi-credit-card-2-front"></i> Select Payment Method
                                </h5>

                                <select class="form-select payment-select w-100" name="payment_method" id="paymentSelect" onchange="showPayOption(this.value)" style="border: 1.5px solid var(--theme-border); border-radius: 10px; padding: 10px 14px; font-weight: 600; background-color: #FFFFFF; cursor: pointer;">
                                    <option value="upi" selected>⚡ UPI (Instant QR / Apps)</option>
                                    <option value="card">💳 Debit / Credit Card</option>
                                    <option value="cod">📦 Cash on Delivery (COD)</option>
                                </select>

                                <!-- UPI Panel -->
                                <div id="upi_box" style="display: block; margin-top: 18px; padding-top: 16px; border-top: 1px dashed var(--theme-border);">
                                    <div class="d-flex gap-3 align-items-center flex-wrap">
                                        <div style="background: #FFFFFF; padding: 10px; border-radius: 12px; border: 1.5px solid var(--theme-border); box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                                            <img src="<?= $qr ?>" width="150" height="150" alt="UPI QR" style="border-radius: 8px; display: block;" onerror="this.src='https://placehold.co/150x150/F6EBFF/CE5CFF?text=UPI+QR'">
                                        </div>
                                        <div style="flex: 1; min-width: 170px;">
                                            <div class="badge badge-purple mb-1">UPI Deep Link</div>
                                            <div style="font-size: 11px; color: var(--theme-muted); text-transform: uppercase; font-weight: 700;">Merchant ID</div>
                                            <div style="font-family: var(--font-logo); font-weight: 700; font-size: 14px; color: var(--theme-ink); margin-bottom: 4px;"><?= $upi_id ?></div>
                                            <div style="font-size: 11px; color: var(--theme-muted); text-transform: uppercase; font-weight: 700;">Payable Amount</div>
                                            <h4 style="color: var(--theme-primary-dark); font-family: var(--font-display); font-weight: 800; margin: 0 0 10px 0;">₹<?= number_format($total) ?></h4>
                                            <button type="submit" class="pay-btn" style="width: 100%; padding: 10px 16px; font-size: 13.5px; border-radius: 8px; background: linear-gradient(135deg, var(--theme-primary) 0%, var(--theme-primary-dark) 100%); color: #FFF; border: none; font-weight: 700; cursor: pointer;">
                                                <i class="bi bi-check2-all me-1"></i> I Have Paid
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-center" style="font-size: 11.5px; color: var(--theme-muted);">
                                        Scan with Google Pay, PhonePe, Paytm, or BHIM
                                    </div>
                                </div>

                                <!-- Card Panel -->
                                <div id="card_box" style="display: none; margin-top: 18px; padding-top: 16px; border-top: 1px dashed var(--theme-border);">
                                    <input class="form-control mb-2" name="card_number" placeholder="Card Number (XXXX XXXX XXXX XXXX)" maxlength="19" style="font-size: 13px;">
                                    <div class="row g-2 mb-2">
                                        <div class="col-6"><input class="form-control" name="card_exp" placeholder="MM/YY" maxlength="5" style="font-size: 13px;"></div>
                                        <div class="col-6"><input type="password" class="form-control" name="card_cvv" placeholder="CVV" maxlength="4" style="font-size: 13px;"></div>
                                    </div>
                                    <input class="form-control mb-3" name="card_holder" placeholder="Name on Card" style="font-size: 13px;">
                                    <button type="submit" class="pay-btn w-100" style="padding: 11px; font-size: 14px; border-radius: 8px; background: linear-gradient(135deg, var(--theme-primary) 0%, var(--theme-primary-dark) 100%); color: #FFF; border: none; font-weight: 700; cursor: pointer;">
                                        <i class="bi bi-lock-fill me-1"></i> Pay Now ₹<?= number_format($total) ?>
                                    </button>
                                </div>

                                <!-- COD Panel -->
                                <div id="cod_box" style="display: none; margin-top: 18px; padding-top: 16px; border-top: 1px dashed var(--theme-border);">
                                    <div class="alert alert-success d-flex align-items-center mb-3" style="font-size: 12.5px; padding: 10px 14px; border-radius: 8px; background: #eefcf3; border: 1px solid #a3e6b8; color: #1e7e34;">
                                        <i class="bi bi-truck me-2 fs-5"></i>
                                        <span>Cash on Delivery active. Pay in cash or UPI when delivered.</span>
                                    </div>
                                    <button type="submit" class="pay-btn w-100" style="padding: 11px; font-size: 14px; border-radius: 8px; background: linear-gradient(135deg, var(--theme-primary) 0%, var(--theme-primary-dark) 100%); color: #FFF; border: none; font-weight: 700; cursor: pointer;">
                                        <i class="bi bi-box-seam me-1"></i> Confirm COD Order (₹<?= number_format($total) ?>)
                                    </button>
                                </div>

                            </div>

                            <div style="margin-top: 14px; text-align: center; color: var(--theme-muted); font-size: 12px;">
                                <i class="bi bi-shield-check text-success me-1"></i> 256-Bit SSL Encrypted Gaming Checkout
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty Cart State -->
            <div style="text-align: center; padding: 70px 20px; background: var(--theme-surface); border: 1.5px dashed var(--theme-border); border-radius: 16px; max-width: 680px; margin: 0 auto;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--theme-surface-soft); color: var(--theme-primary-dark); display: flex; align-items: center; justify-content: center; font-size: 38px; margin: 0 auto 20px;">
                    <i class="bi bi-cart-x"></i>
                </div>
                <h2 style="font-size: 28px; margin-bottom: 8px;">Your Gaming Cart is Empty</h2>
                <p style="color: var(--theme-text); max-width: 440px; margin: 0 auto 24px;">
                    Looks like you haven't added any battle-ready gaming gear yet. Browse our catalog for mechanical keyboards, mice, and RGB accessories!
                </p>
                <a href="cviewproduct.php" class="btn-primary" style="padding: 12px 28px; font-size: 15px;">
                    <i class="bi bi-grid-fill me-1"></i> Shop Gaming Gear Now
                </a>
            </div>
        <?php endif; ?>
    </main>

    <?php include("footer.php"); ?>

<script>
function showPayOption(val) {
    const upiBox = document.getElementById('upi_box');
    const cardBox = document.getElementById('card_box');
    const codBox = document.getElementById('cod_box');

    if (upiBox) upiBox.style.display = 'none';
    if (cardBox) cardBox.style.display = 'none';
    if (codBox) codBox.style.display = 'none';

    if (val === 'upi' && upiBox) {
        upiBox.style.display = 'block';
    } else if (val === 'card' && cardBox) {
        cardBox.style.display = 'block';
    } else if (val === 'cod' && codBox) {
        codBox.style.display = 'block';
    }
}
</script>

</body>
</html>
