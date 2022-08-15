<title>Dashboard</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/product_details/product_details.css">

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

        <div class="description">
            <p>
                <?=$product['description']?>
            </p>
        </div>
        
        <form action="" class="d-flex justify-content-end"> 
            <p class="price">($19.99)</p>
            <input type="number" class="form-control quantity">
            <button class="btn btn-success">Buy</button>
        </form>

        <div class="similar">
            <h2>Similar Items</h2>
            <div class="similar_img">
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
                
                
            </div>
        </div>

    </div>