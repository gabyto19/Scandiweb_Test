<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/tools/reset.css">
    <link rel="icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/product-list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Product List</title>
</head>
<body>
<div class="main-container">
    <div class="product-list-header">
        <h2>Product List</h2>
        <div class="product-list-header-buttons">
            <button id="product-add-btn" onclick="addProduct()">ADD</button>
            <button id="product-delete-btn" onclick="deleteProduct()">MASS DELETE</button>
        </div>
    </div>
    <div class="product-list-content">
        <?php if (empty($dvd) && empty($furniture) && empty($book)): ?>
            <div class="empty-product-msg">
                There is no product added
            </div>
        <?php endif;?>
        <?php foreach ($dvd as $dvdCollection): ?>
            <div class="product" id="<?php echo $dvdCollection["product_id"]?>">
                <input type="checkbox" class="delete-checkbox" value="<?php echo $dvdCollection["product_id"]?>">
                <div class="product-desc">
                    <div class="product-sku"><?php echo $dvdCollection["sku"]?></div>
                    <div class="product-name"><?php echo $dvdCollection["name"]?></div>
                    <div class="product-price"><?php echo $dvdCollection["price"], " $"?></div>
                    <div class="product-desc"><?php echo "Size: ", $dvdCollection["size"], " MB"?></div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($furniture as $furnitureCollection): ?>
            <div class="product" id="<?php echo $furnitureCollection["product_id"]?>">
                <input type="checkbox" class="delete-checkbox" value="<?php echo $furnitureCollection["product_id"]?>">
                <div class="product-desc">
                    <div class="product-sku"><?php echo $furnitureCollection["sku"]?></div>
                    <div class="product-name"><?php echo $furnitureCollection["name"]?></div>
                    <div class="product-price"><?php echo $furnitureCollection["price"], " $"?></div>
                    <div class="product-desc">
                        <?php echo "Dimension: " ,
                        $furnitureCollection["height"], "x",
                        $furnitureCollection["width"], "x",
                        $furnitureCollection["length"]?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($book as $bookCollection): ?>
            <div class="product" id="<?php echo $bookCollection["product_id"]?>">
                <input type="checkbox" class="delete-checkbox" value="<?php echo $bookCollection["product_id"]?>">
                <div class="product-desc">
                    <div class="product-sku"><?php echo $bookCollection["sku"]?></div>
                    <div class="product-name"><?php echo $bookCollection["name"]?></div>
                    <div class="product-price"><?php echo $bookCollection["price"], " $"?></div>
                    <div class="product-desc"><?php echo "Weight: ", $bookCollection["weight"], "KG"?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="product-list-footer">
        <footer>
            Scandiweb Test assignment
        </footer>
    </div>
<script src="assets/js/main.js"></script>
</body>
</html>
