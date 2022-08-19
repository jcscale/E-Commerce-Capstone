<title>Products</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/catalog/catalog.js" charset="utf-8"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/catalog/catalog.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  </head>
  <body>
    <div class="container mt-3">

        <?php if($this->session->flashdata('welcome_master')){ ?>
            <script type="text/javascript">toastr.success('<?=$this->session->flashdata('welcome_master')?>')</script>
        <?php } ?>

        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <div class="categories">
                    <form action="<?=base_url()?>customers/index" method="post">
                        <div class="text-field">
                            <input type="text" placeholder=" " class="form-control" id="search_word" name="search_word">
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
                                <h2>ALL Products (page <?=$page?>)</h2>
                            <?php }?>
                        </div>
                        <div class="col-md-3">
                            <nav aria-label="Page navigation example">
                                <!-- <p><?=$links?></p> -->
                                <!-- <ul class="pagination sm d-flex justify-content-end ">
                                  <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                  </li>
                                  <li class="page-item active" aria-current="page">
                                    <span class="page-link">2</span>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                  </li>
                                </ul> -->
                            </nav>
                            <select class="form-select" aria-label="Default select example ">
                                <option selected>Sort by</option>
                                <option value="1">Price</option>
                                <option value="2">Most Popular</option>
                              </select>
                        </div>
                    </div>
                    <div class="product_list">
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
        </div>

        <p><?=$links?></p>

    </div>