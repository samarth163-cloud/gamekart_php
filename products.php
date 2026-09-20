<?php
include_once("conn.php");

$msg = "";
$msgType = "success";

// ADD PRODUCT
if (isset($_POST['btnadd'])) {
    $title = mysqli_real_escape_string($con, trim($_POST['txttitle']));
    $mrp   = (int)$_POST['txtmrp'];
    $price = (int)$_POST['txtp'];
    $desc  = mysqli_real_escape_string($con, trim($_POST['txtdes']));
    $image = "";

    if ($price < 0 || $mrp < 0) {
        $msg = "Price and MRP cannot be negative values!";
        $msgType = "danger";
    } elseif (empty($title) || empty($price)) {
        $msg = "Please provide at least a Product Title and Selling Price.";
        $msgType = "danger";
    } else {
        if (!empty($_FILES['fup']['name'])) {
            $image = time() . '_' . preg_replace("/[^a-zA-Z0-9._-]/", "", basename($_FILES['fup']['name']));
            if (!is_dir('images')) {
                mkdir('images', 0777, true);
            }
            move_uploaded_file($_FILES['fup']['tmp_name'], 'images/' . $image);
        } else {
            $image = "demo.jpg";
        }

        $qry = "INSERT INTO tblpro VALUES(NULL, '$title', '$mrp', '$price', '$desc', '$image')";
        if (mysqli_query($con, $qry)) {
            $msg = "Gaming gear '$title' added to inventory successfully!";
            $msgType = "success";
        } else {
            $msg = "Error adding product: " . mysqli_error($con);
            $msgType = "danger";
        }
    }
}

// UPDATE PRODUCT
if (isset($_POST['btnupd'])) {
    $pid   = (int)$_POST['txtpid'];
    $title = mysqli_real_escape_string($con, trim($_POST['txttitle']));
    $mrp   = (int)$_POST['txtmrp'];
    $price = (int)$_POST['txtp'];
    $desc  = mysqli_real_escape_string($con, trim($_POST['txtdes']));

    if ($price < 0 || $mrp < 0) {
        $msg = "Price and MRP cannot be negative values!";
        $msgType = "danger";
    } else {
        if (!empty($_FILES['fup']['name'])) {
            $image = time() . '_' . preg_replace("/[^a-zA-Z0-9._-]/", "", basename($_FILES['fup']['name']));
            if (!is_dir('images')) {
                mkdir('images', 0777, true);
            }
            move_uploaded_file($_FILES['fup']['tmp_name'], 'images/' . $image);
            $qry = "UPDATE tblpro SET title='$title', mrp='$mrp', price='$price', des='$desc', img='$image' WHERE productid='$pid'";
        } else {
            $qry = "UPDATE tblpro SET title='$title', mrp='$mrp', price='$price', des='$desc' WHERE productid='$pid'";
        }

        if (mysqli_query($con, $qry)) {
            $msg = "Product #$pid updated successfully!";
            $msgType = "success";
        } else {
            $msg = "Error updating product: " . mysqli_error($con);
            $msgType = "danger";
        }
    }
}

// DELETE PRODUCT
if (isset($_GET['deleteid'])) {
    $pid = (int)$_GET['deleteid'];
    if (mysqli_query($con, "DELETE FROM tblpro WHERE productid='$pid'")) {
        $msg = "Product #$pid removed from inventory.";
        $msgType = "info";
    }
}

// SEARCH FILTER
$search = isset($_GET['search']) ? trim(mysqli_real_escape_string($con, $_GET['search'])) : '';
$whereClause = "";
if (!empty($search)) {
    $whereClause = "WHERE title LIKE '%$search%' OR des LIKE '%$search%'";
}

// Fetch all products
$qry = mysqli_query($con, "SELECT * FROM tblpro $whereClause ORDER BY productid DESC");
$totalProducts = mysqli_num_rows($qry);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Gear Inventory - GameKart Admin</title>
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

        .page-title-wrap {
            display: flex;
            flex-direction: column;
            gap: 4px;
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
            margin: 0;
        }

        .btn-add-top {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #CE5CFF;
            color: #FFFFFF !important;
            border: 1px solid #CE5CFF;
            padding: 10px 22px;
            border-radius: 8px;
            font-family: var(--font-display);
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(206, 92, 255, 0.3);
            transition: all 0.2s ease;
        }

        .btn-add-top:hover {
            background: #B838EE;
            border-color: #B838EE;
            transform: translateY(-1px);
        }

        /* Form Card */
        .gear-form-card {
            background: #FFFFFF;
            border: 1px solid #E5C7F7;
            border-radius: 14px;
            padding: 26px 30px 24px;
            margin-bottom: 32px;
            box-shadow: 0 2px 12px rgba(206, 92, 255, 0.04);
        }

        .form-card-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-display);
            font-size: 18px;
            font-weight: 700;
            color: #17121A;
            margin-bottom: 22px;
        }

        .form-card-title i {
            color: #CE5CFF;
            font-size: 20px;
        }

        .form-label-custom {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: #17121A;
            margin-bottom: 7px;
            font-family: var(--font-body);
        }

        .form-control-custom {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #E5C7F7;
            border-radius: 8px;
            background: #FFFFFF;
            color: #17121A;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control-custom::placeholder {
            color: #A396A6;
            font-size: 13.5px;
        }

        .form-control-custom:focus {
            border-color: #CE5CFF;
            box-shadow: 0 0 0 3px rgba(206, 92, 255, 0.12);
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1.2fr;
            gap: 20px;
            margin-bottom: 18px;
        }

        .btn-save-gear {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #CE5CFF;
            color: #FFFFFF !important;
            border: none;
            padding: 11px 26px;
            border-radius: 8px;
            font-family: var(--font-display);
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(206, 92, 255, 0.25);
            transition: all 0.2s ease;
        }

        .btn-save-gear:hover {
            background: #B838EE;
            transform: translateY(-1px);
        }

        /* Inventory Table Card */
        .inventory-card {
            background: #FFFFFF;
            border: 1px solid #E5C7F7;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(206, 92, 255, 0.04);
        }

        .inventory-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .inventory-card-title {
            font-family: var(--font-display);
            font-size: 19px;
            font-weight: 700;
            color: #17121A;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .table-thumb-preview {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: contain;
            background: #FCF8FF;
            border: 1px solid #E5C7F7;
            padding: 2px;
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
            .form-grid-3 {
                grid-template-columns: 1fr;
            }
            .admin-main-content {
                padding: 20px;
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
                    <a href="products.php" class="sidebar-item active">
                        <i class="bi bi-controller"></i>
                        <span>Products Inventory</span>
                    </a>
                </li>
                <li>
                    <a href="aorder.php" class="sidebar-item">
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
            <div class="page-title-wrap">
                <h1 class="page-title">
                    <i class="bi bi-controller"></i> Battle Gear Inventory
                </h1>
                <p class="page-subtitle">
                    Add, edit, or remove hardware, peripherals, and battle station accessories.
                </p>
            </div>
            <div>
                <a href="#addProductSection" class="btn-add-top">
                    <i class="bi bi-plus-lg"></i> Add New Gear
                </a>
            </div>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-<?php echo $msgType; ?> alert-dismissible fade show mb-4" role="alert" style="border-radius: 10px;">
                <i class="bi bi-info-circle-fill me-2"></i><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Add New Gaming Product Form Card -->
        <div class="gear-form-card" id="addProductSection">
            <div class="form-card-title">
                <i class="bi bi-plus-circle-fill"></i> Add New Gaming Product
            </div>

            <form method="post" action="products.php" enctype="multipart/form-data">
                <!-- Product Title -->
                <div style="margin-bottom: 18px;">
                    <label class="form-label-custom">Product Title *</label>
                    <input type="text" name="txttitle" class="form-control-custom" placeholder="e.g. Razer BlackWidow V4 Pro Mechanical Keyboard" required>
                </div>

                <!-- 3 Columns: MRP, Selling Price, Image -->
                <div class="form-grid-3">
                    <div>
                        <label class="form-label-custom">MRP (Original Price ₹)</label>
                        <input type="number" name="txtmrp" class="form-control-custom" placeholder="e.g. 19999" min="0">
                    </div>
                    <div>
                        <label class="form-label-custom">Selling Price (₹) *</label>
                        <input type="number" name="txtp" class="form-control-custom" placeholder="e.g. 14999" required min="0">
                    </div>
                    <div>
                        <label class="form-label-custom">Product Image Upload</label>
                        <input type="file" name="fup" class="form-control-custom" accept="image/*" style="padding: 8px 12px;">
                    </div>
                </div>

                <!-- Description -->
                <div style="margin-bottom: 24px;">
                    <label class="form-label-custom">Product Description & Specs</label>
                    <textarea name="txtdes" class="form-control-custom" rows="3" placeholder="Enter tech specifications, RGB features, warranty, switch types..."></textarea>
                </div>

                <!-- Save Button (Right aligned) -->
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" name="btnadd" class="btn-save-gear">
                        <i class="bi bi-plus-lg me-1"></i> Save New Product
                    </button>
                </div>
            </form>
        </div>

        <!-- Catalog Inventory Table Card -->
        <div class="inventory-card">
            <div class="inventory-card-header">
                <h2 class="inventory-card-title">
                    <i class="bi bi-stars" style="color: #CE5CFF;"></i> Catalog Inventory (<?php echo $totalProducts; ?> Items)
                </h2>

                <form method="get" action="products.php" style="display: flex; gap: 8px; margin: 0;">
                    <div style="position: relative;">
                        <input type="text" name="search" class="form-control-custom" placeholder="Search gear title..." value="<?php echo htmlspecialchars($search); ?>" style="padding: 7px 12px; width: 220px; font-size: 13px;">
                    </div>
                    <button type="submit" class="btn-primary" style="padding: 7px 14px; font-size: 13px; border-radius: 8px;">
                        <i class="bi bi-search"></i>
                    </button>
                    <?php if (!empty($search)): ?>
                        <a href="products.php" class="btn-secondary" style="padding: 7px 12px; font-size: 13px; border-radius: 8px;">Reset</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="table-container" style="border-radius: 10px; border: 1px solid #E5C7F7;">
                <table class="gamekart-table">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Photo</th>
                            <th>Product Title</th>
                            <th>MRP</th>
                            <th>Price (INR)</th>
                            <th>Tech Specs & Description</th>
                            <th style="text-align: right; width: 130px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($qry && mysqli_num_rows($qry) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($qry)): ?>
                                <?php 
                                    $imgName = !empty($row['img']) ? $row['img'] : 'demo.jpg';
                                    $imgPath = "images/" . $imgName;
                                ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($imgPath); ?>" class="table-thumb-preview" alt="Gear" onerror="this.src='https://placehold.co/100x100/F6EBFF/CE5CFF?text=Gear'">
                                    </td>
                                    <td style="font-weight: 700; color: #17121A; font-size: 14.5px;">
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </td>
                                    <td style="color: #8E7F91; text-decoration: line-through; font-size: 13.5px;">
                                        <?php echo !empty($row['mrp']) ? '₹'.number_format($row['mrp']) : '-'; ?>
                                    </td>
                                    <td style="font-family: var(--font-display); font-weight: 700; color: #B838EE; font-size: 16px;">
                                        ₹<?php echo number_format($row['price']); ?>
                                    </td>
                                    <td style="max-width: 320px; font-size: 13px; color: #665A68; line-height: 1.4;">
                                        <?php echo htmlspecialchars($row['des']); ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <button type="button" class="btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-right: 4px; border-radius: 6px;" 
                                                onclick='openEditModal(<?php echo json_encode($row); ?>)'>
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="products.php?deleteid=<?php echo $row['productid']; ?>" class="btn-danger" style="padding: 5px 10px; font-size: 12px; border-radius: 6px;" onclick="return confirm('Delete this product from catalog?');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px; color: #8E7F91;">
                                    No products found in inventory.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<!-- EDIT PRODUCT MODAL -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 14px; border: 1px solid #E5C7F7;">
            <div class="modal-header" style="background: #FCF8FF; border-bottom: 1px solid #E5C7F7;">
                <h5 class="modal-title" id="editProductModalLabel" style="font-family: var(--font-display); font-weight: 700; color: #17121A;">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Edit Gaming Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="products.php" enctype="multipart/form-data">
                <input type="hidden" name="txtpid" id="edit_pid">
                <div class="modal-body" style="padding: 24px;">
                    <div style="margin-bottom: 16px;">
                        <label class="form-label-custom">Product Title</label>
                        <input type="text" name="txttitle" id="edit_title" class="form-control-custom" required>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label-custom">MRP (INR)</label>
                            <input type="number" name="txtmrp" id="edit_mrp" class="form-control-custom" min="0">
                        </div>
                        <div>
                            <label class="form-label-custom">Price (INR) *</label>
                            <input type="number" name="txtp" id="edit_price" class="form-control-custom" required min="0">
                        </div>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <label class="form-label-custom">Description & Specs</label>
                        <textarea name="txtdes" id="edit_desc" class="form-control-custom" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="form-label-custom">Update Photo (Optional)</label>
                        <input type="file" name="fup" class="form-control-custom" accept="image/*" style="padding: 8px 12px;">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #E5C7F7; background: #FCF8FF;">
                    <button type="button" class="btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" name="btnupd" class="btn-primary" style="border-radius: 8px;">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(pro) {
    document.getElementById('edit_pid').value = pro.productid;
    document.getElementById('edit_title').value = pro.title;
    document.getElementById('edit_mrp').value = pro.mrp;
    document.getElementById('edit_price').value = pro.price;
    document.getElementById('edit_desc').value = pro.des;
    
    var editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
    editModal.show();
}
</script>

</body>
</html>
