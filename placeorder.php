<?php
include_once("conn.php");

// Ensure user session
if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
    header("Location: clogin.php?msg=login_required");
    exit;
}
$userid = (int)$_SESSION['uid'];

$rawMethod = isset($_POST['payment_method']) ? strtolower(trim($_POST['payment_method'])) : 'upi';
if ($rawMethod == 'upi') {
    $paymentMethod = 'UPI / Instant QR';
} else if ($rawMethod == 'card') {
    $paymentMethod = 'Debit / Credit Card';
} else if ($rawMethod == 'cod') {
    $paymentMethod = 'Cash on Delivery (COD)';
} else {
    $paymentMethod = htmlspecialchars($_POST['payment_method'] ?? 'Online Payment');
}

// Fetch cart items
$cartQry = mysqli_query($con, "SELECT c.*, p.price, p.title 
                              FROM tblcart c 
                              JOIN tblpro p ON c.productid = p.productid 
                              WHERE c.userid = $userid");

if (!$cartQry || mysqli_num_rows($cartQry) == 0) {
    echo "<script>alert('Your cart is empty! Please add some gaming products first.'); window.location='cviewproduct.php';</script>";
    exit;
}

// Calculate total amount
$totalAmount = 0;
$cartItems = [];
while ($row = mysqli_fetch_assoc($cartQry)) {
    $totalAmount += ($row['qty'] * $row['price']);
    $cartItems[] = $row;
}

// Insert into tblorder
$orderdate = date('Y-m-d H:i:s');
$insertOrder = "INSERT INTO tblorder(userid, orderdate, totalamout) VALUES($userid, '$orderdate', $totalAmount)";
if (!mysqli_query($con, $insertOrder)) {
    die("Order Insertion Failed: " . mysqli_error($con));
}
$orderid = mysqli_insert_id($con);

// Insert into tblorderdetails
foreach ($cartItems as $item) {
    $pid = (int)$item['productid'];
    $qty = (int)$item['qty'];
    $price = (int)$item['price'];
    $subtotal = $qty * $price;

    $insertDetail = "INSERT INTO tblorderdetails(orderid, productid, qty, price, subtotal) 
                     VALUES($orderid, $pid, $qty, $price, $subtotal)";
    if (!mysqli_query($con, $insertDetail)) {
        die("Order Details Insertion Failed: " . mysqli_error($con));
    }
}

// Clear user's cart
mysqli_query($con, "DELETE FROM tblcart WHERE userid = $userid");

// Redirect with success message
echo "<script>alert('🎉 Order #$orderid Placed Successfully via $paymentMethod! Total: ₹" . number_format($totalAmount) . ". Your gaming gear will be dispatched shortly.'); window.location='orders.php';</script>";
exit;
?>
