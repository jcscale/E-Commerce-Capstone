<title>Products</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/catalog/catalog.css">

  </head>
  <body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <div class="categories">
                    <form action="">
                        <div class="text-field">
                            <input type="text" placeholder=" " class="form-control">
                            <label>Search</label>
                        </div>
                    </form>
                    <h4>Categories</h4>
                    <?php foreach($categories as $category){?>
                        <a class="cate" href=""><?=$category['name']?> (<?=$category['count']?>)</a>
                    <?php }?>
                    <a class="cate" href="">Show All</a>
                </div>
                
            </div>

            <div class="col-md-9 d-flex">
                <div class="all_products">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>ALL Products (page 2)</h2>
                        </div>
                        <div class="col-md-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination sm d-flex justify-content-end ">
                                  <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                  </li>
                                  <li class="page-item active" aria-current="page">
                                    <span class="page-link">2</span>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                  </li>
                                </ul>
                            </nav>
                            <select class="form-select" aria-label="Default select example ">
                                <option selected>Sort by</option>
                                <option value="1">Price</option>
                                <option value="2">Most Popular</option>
                              </select>
                        </div>
                    </div>
                    <?php foreach($products as $product){?>
                        <a href="<?=base_url()?>customers/show/<?=$product['id']?>">
                            <div class="product_img">
                                <img src="<?=base_url()?>uploads/<?=$product['filename']?>" alt="" width="100px" height="100px">
                                <p class="price">$<?=$product['price']?></p>
                                <p class="product_name">T-<?=$product['name']?></p>
                            </div>
                        </a>
                    <?php }?>
                </div>
            </div>
        </div>


        <ul class="pagination d-flex justify-content-center mt-3">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>

    </div>