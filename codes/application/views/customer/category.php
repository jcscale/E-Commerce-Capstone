<title>Products</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/catalog/catalog.css">

  </head>
  <body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <div class="categories">
                    <form action="" method="post">
                        <div class="text-field">
                            <input type="text" placeholder=" " class="form-control" name="search_word">
                            <label>Search</label>
                            <!-- <input type="submit"> -->
                        </div>
                    </form>
                    <h4>Categories</h4>
                    <?php foreach($categories as $category){?>
                        <a class="cate" href="<?=base_url()?>customers/category/<?=$category['id']?>"><?=$category['name']?> (<?=$category['count']?>)</a>
                    <?php }?>
                    <a class="cate" href="<?=base_url()?>customers">Show All</a>
                </div>
                
            </div>

            <div class="col-md-9 d-flex">
                <div class="all_products">
                    <div class="row">
                        <div class="col-md-9">
                            <?php if(!empty($page)) {?>
                                <h2><?=$products[0]['cate_name']?> (page <?=$page?>)</h2>
                            <?php }?>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" aria-label="Default select example ">
                                <option selected>Sort by</option>
                                <option value="1">Price</option>
                                <option value="2">Most Popular</option>
                              </select>
                        </div>
                    </div>
                    <?php if(!empty($products)) {?>
                        <?php foreach($products as $product){?>
                            <a href="<?=base_url()?>customers/show/<?=$product['id']?>" class="anchor_img">
                                <div class="product_img">
                                    <img src="<?=base_url()?>uploads/<?=$product['filename']?>" alt="" width="100px" height="100px">
                                    <p class="price">$<?=$product['price']?></p>
                                    <p class="product_name"><?=$product['name']?></p>
                                </div>
                            </a>
                        <?php }?>
                    <?php }?>
                    
                </div>
            </div>
        </div>

        <p><?=$links?></p>

    </div>