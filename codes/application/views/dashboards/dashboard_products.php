<title>Products</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard_products/dashboard_products.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard_products/dashboard_products.js" charset="utf-8"></script>
  </head>
  <body>

  <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <form action="">
                    <div class="text-field">
                        <input type="text" class="form-control" placeholder=" ">
                        <label>Search</label>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add new product
                  </button>
            </div>
        </div>

        <div id="products"></div>

            <!-- <ul class="pagination d-flex justify-content-center">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul> -->

             <!-- Modal -->
             <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    
                    <form action="dashboards/add_product" method="post" enctype="multipart/form-data" id="add_product_form">
                    
                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" name="name" form="add_product_form">
                            <label>Name</label>
                        </div>

                        
                        
                        <div class="text-field mb-3">
                            <!-- <input type="text" required class="form-control"> -->
                            <textarea class="form-control" name="description" id="" cols="30" rows="2" placeholder=" " form="add_product_form"></textarea>
                            <label>Description</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="number" placeholder=" " class="form-control" name="inventory_count" form="add_product_form">
                            <label>Inventory Count</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" name="quantity_sold" form="add_product_form">
                            <label>Quantity Sold</label>
                        </div>
                        
                        <div class="text-field mb-3">
                        <input type="text" placeholder=" " class="form-control" name="category">
                        <label>Add new category</label>
                        </div>

                        <p>Categories:</p>
                        <div class="text-field mb-3">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Tools
                                </button>
                                <input type="hidden" value="1" id="hide_id" class="hide_id" name="category_id" form="add_product_form">
                                
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <?php foreach($categories as $category){?>
                                        <li class="dropdown_li">
                                            <!-- <p class="dropdown_p"><?=$category['name']?></p> -->
                                            <form class="dropdown_form" action="" id="category_form">
                                                <input type="text" value="<?=$category['name']?>" class="dropdown_input" form="category_form">
                                                <input type="hidden" value="<?=$category['id']?>" class="hidden_id" form="category_form">
                                                <p class="ui-icon ui-icon-pencil ms-3 me-3 pencil"></p><a class="ui-icon ui-icon-trash me-3 trash" href=""></a>
                                            </form>  
                                        </li>
                                    <?php }?>
                                
                                </ul>
                                
                            </div>
                        </div>
                          
                        <p>Image:</p>
                        <div class="text-field mb-3">
                            <input type="file" class="form-control" name="image" form="add_product_form">
                        </div>
                         

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Preview</button>
                            <button type="submit" class="btn btn-primary" form="add_product_form">Add</button>
                        </div>
                          
                    </form>
                </div>
                  
              </div>
              </div>
          </div>

        <!-- Edit Modal -->
        <!-- <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    
                    <form action="" method="post" enctype="multipart/form-data" id="">
                    
                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" name="name" form="">
                            <label>Name</label>
                        </div>

                        
                        
                        <div class="text-field mb-3">
                            <textarea class="form-control" name="description" id="" cols="30" rows="2" placeholder=" " form=""></textarea>
                            <label>Description</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="number" placeholder=" " class="form-control" name="inventory_count" form="">
                            <label>Inventory Count</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" name="quantity_sold" form="">
                            <label>Quantity Sold</label>
                        </div>
                        
                        <div class="text-field mb-3">
                        <input type="text" placeholder=" " class="form-control" name="category">
                        <label>Add new category</label>
                        </div>

                        <p>Categories:</p>
                        <div class="text-field mb-3">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Tools
                                </button>
                                <input type="hidden" value="1" id="hide_id" class="hide_id" name="category_id" form="">
                                
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <?php foreach($categories as $category){?>
                                        <li class="dropdown_li">
                                            <form class="dropdown_form" action="" id="category_form">
                                                <input type="text" value="<?=$category['name']?>" class="dropdown_input" form="category_form">
                                                <input type="hidden" value="<?=$category['id']?>" class="hidden_id" form="category_form">
                                                <p class="ui-icon ui-icon-pencil ms-3 me-3 pencil"></p><a class="ui-icon ui-icon-trash me-3 trash" href=""></a>
                                            </form>  
                                        </li>
                                    <?php }?>
                                
                                </ul>
                                
                            </div>
                        </div>
                          
                        <p>Image:</p>
                        <div class="text-field mb-3">
                            <input type="file" class="form-control" name="image" form="add_product_form">
                        </div>

                        <div class="mb-3 img-sortable">
                            <ul id="sortable">
                              <li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="Pocket-T-shirt_122719.webp" alt="" width="50" height="50">Image 1 <span class="ui-icon ui-icon-trash ms-5"></span></li>
                              <li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="Pocket-T-shirt_122719.webp" alt="" width="50" height="50">Image 2 <span class="ui-icon ui-icon-trash ms-5"></span></li>
                              <li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="Pocket-T-shirt_122719.webp" alt="" width="50" height="50">Image 3 <span class="ui-icon ui-icon-trash ms-5"></span></li>
                            </ul>
                        </div>
                         

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Preview</button>
                            <button type="submit" class="btn btn-primary" form="add_product_form">Add</button>
                        </div>
                          
                    </form>
                </div>
                  
              </div>
              </div>
          </div> -->

       

    </div>

   