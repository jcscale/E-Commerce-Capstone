<title>Products</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard_products/dashboard_products.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <!-- Datatable CSS -->
    <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <!-- Datatable JS -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard_products/dashboard_products.js" charset="utf-8"></script>
  </head>
  <body>

  <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <form action="">
                    <div class="text-field">
                        <input type="text" class="form-control" placeholder=" " aria-controls="empTable" id="search_table">
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

        <div id="products">
        <table id='empTable' class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">Picture</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Inventory Count</th>
            <th scope="col">Quantity Sold</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product){?>
                <tr>
                <td><img src="<?=base_url()?>uploads/<?=$product['filename']?>" alt="" height="50" width="50"></td>
                <td><?=$product['id']?></td>
                <td><?=$product['name']?></td>
                <td><?=$product['inventory_count']?></td>
                <td><?=$product['quantity_sold']?></td>
                <td>

                    <!-- <a href="dashboards/product_detail/<?=$product['id']?>" data-bs-toggle="modal" data-bs-target="#edit_modal">edit</a> -->
                    <a href="dashboards/product_detail/<?=$product['id']?>" id="product_detail" data-bs-toggle="modal" data-bs-target="#edit_modal">edit</a>
                    <a href="dashboards/delete_product/<?=$product['id']?>">delete</a>
                    
                    <!-- <form action="<?=base_url()?>dashboards/delete_product/<?=$product['id']?>" method="POST">
                        <input class="delete btn btn-danger" type="submit" value="X">
                    </form> -->
                    
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
        </div>

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
                    <!-- <form action="" method="post" enctype="multipart/form-data" id="add_product_form"> -->
                    
                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" name="name" id="name" form="add_product_form">
                            <label>Name</label>
                        </div>

                        <div class="text-field mb-3">
                            <!-- <input type="text" required class="form-control"> -->
                            <textarea class="form-control" name="description" id="description" cols="30" rows="2" placeholder=" " form="add_product_form"></textarea>
                            <label>Description</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="number" placeholder=" " class="form-control" name="price" id="price" form="add_product_form">
                            <label>Price</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="number" placeholder=" " class="form-control" id="inventory_count" name="inventory_count" form="add_product_form">
                            <label>Inventory Count</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" id="quantity_sold" name="quantity_sold" form="add_product_form">
                            <label>Quantity Sold</label>
                        </div>
                        
                        <form action="dashboards/add_category" method="POST" id="add_category_form">
                            <div class="text-field mb-3">
                                <input type="text" placeholder=" " class="form-control" name="category" form="add_category_form" id="add_new_category">
                                <!-- <button type="submit" form="add_category_form">Submit</button> -->
                                <label>Add new category</label>
                            </div>
                        </form> 
                       

                        <p>Categories:</p>
                        <div class="text-field mb-3">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Consumables
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
                            <input type="file" class="form-control" id="image" name="image" form="add_product_form">
                        </div>
                         

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Preview</button>
                            <button type="submit" class="btn btn-primary" form="add_product_form" id="add">Add</button>
                        </div>
                          
                    </form>
                </div>
                  
              </div>
              </div>
          </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    
                    <form action="dashboards/update_product" method="post" enctype="multipart/form-data" id="edit_product_form">
                        
                        <input type="hidden" value="" id="edit_id" form="edit_product_form" name="edit_id">
                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" name="edit_name" form="edit_product_form" id="edit_name">
                            <label>Name</label>
                        </div>

                        
                        
                        <div class="text-field mb-3">
                            <textarea class="form-control" name="edit_description" id="edit_description" cols="30" rows="2" placeholder=" " form="edit_product_form"></textarea>
                            <label>Description</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="number" placeholder=" " class="form-control" name="edit_price" form="edit_product_form" id="edit_price">
                            <label>Price</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="number" placeholder=" " class="form-control" name="edit_inventory_count" form="edit_product_form" id="edit_inventory_count">
                            <label>Inventory Count</label>
                        </div>

                        <div class="text-field mb-3">
                            <input type="text" placeholder=" " class="form-control" name="edit_quantity_sold" form="edit_product_form" id="edit_quantity_sold">
                            <label>Quantity Sold</label>
                        </div>
                        
                        <div class="text-field mb-3">
                        <input type="text" placeholder=" " class="form-control" name="edit_category">
                        <label>Add new category</label>
                        </div>

                        <p>Categories:</p>
                        <div class="text-field mb-3">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Consumable
                                </button>
                                <input type="hidden" value="1" id="hide_id" class="hide_id" name="category_id" form="edit_product_form">
                                
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
                            <input type="file" class="form-control" name="edit_image" form="edit_product_form" id="edit_image">
                        </div>

                        <div class="mb-3 img-sortable">
                            <ul id="sortable">
                              <!-- <li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="Pocket-T-shirt_122719.webp" alt="" width="50" height="50">Image 1 <span class="ui-icon ui-icon-trash ms-5"></span></li>
                              <li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="Pocket-T-shirt_122719.webp" alt="" width="50" height="50">Image 2 <span class="ui-icon ui-icon-trash ms-5"></span></li>
                              <li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="Pocket-T-shirt_122719.webp" alt="" width="50" height="50">Image 3 <span class="ui-icon ui-icon-trash ms-5"></span></li> -->
                            </ul>
                        </div>
                         

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Preview</button>
                            <button type="submit" class="btn btn-primary" form="edit_product_form">Update</button>
                        </div>
                          
                    </form>
                </div>
                  
              </div>
              </div>
          </div>
          <!-- Edit Modal -->

       

    </div>

   