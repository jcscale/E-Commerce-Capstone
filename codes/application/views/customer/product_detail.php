<title>All Products</title>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/product_details/product_details.css">
<script src="<?php echo base_url();?>assets/js/product_details/product_details.js"></script>
  </head>
  <body>    

    <div class="container mt-3">
        <a href="<?=base_url()?>customers">Go back</a>

        <h2><?=$product['name']?></h2>
        <div class="product_img">
            <?php $i=0;?>
            <?php foreach($images as $image){ $i++?>
                <?php if($i==1) {?>
                    <img src="<?=base_url()?>uploads/<?=$image['filename']?>" alt="" width="220" height="200">
                <?php } else {?>
                    <div class="img-list">
                        <img src="<?=base_url()?>uploads/<?=$image['filename']?>" alt="" width="50" height="50">
                    </div>
                    <?php }?>
            <?php }?>
            
        </div>

        <div class="description mb-3">
            <p>
                <?=$product['description']?>
            </p>
        </div>
        
        <form action="<?=base_url()?>customers/temp_orders" method="post" class="d-flex justify-content-end"> 
            <p class="price" id="product_price" orig-price="<?=$product['price']?>">($<?=$product['price']?>)</p>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="number" min="1" class="form-control quantity" id="product_quantity" name="quantity" value="1">
            <button class="btn btn-success">Buy</button>
        </form>

        <div class="similar">
            <h2>Similar Items</h2>
            <div class="similar_img">
            <?php foreach($similar_items as $similar){?>
                <a href="<?=base_url()?>customers/show/<?=$similar['product_id']?>" class="anchor_img">
                    <div class="img_wrapper">
                        <img src="<?=base_url()?>/uploads/<?=$similar['filename']?>" alt="" width="100" height="100">
                        <p class="img_price">$<?=$similar['price']?></p>
                        <p class="img_name"><?=$similar['name']?></p>
                    </div>
                </a>
                
            <?php }?>
                
                <!-- <div class="img_wrapper">
                    <img src="../dashboard_products/Pocket-T-shirt_122719.webp" alt="" width="100" height="100">
                    <p class="img_price">$19.99</p>
                    <p class="img_name">T-shirt</p>
                </div>
                <div class="img_wrapper">
                    <img src="../dashboard_products/Pocket-T-shirt_122719.webp" alt="" width="100" height="100">
                    <p class="img_price">$19.99</p>
                    <p class="img_name">T-shirt</p>
                </div>
                <div class="img_wrapper">
                    <img src="../dashboard_products/Pocket-T-shirt_122719.webp" alt="" width="100" height="100">
                    <p class="img_price">$19.99</p>
                    <p class="img_name">T-shirt</p>
                </div>
                <div class="img_wrapper">
                    <img src="../dashboard_products/Pocket-T-shirt_122719.webp" alt="" width="100" height="100">
                    <p class="img_price">$19.99</p>
                    <p class="img_name">T-shirt</p>
                </div> -->
                
                
            </div>
        </div>

    </div>