<title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/shopping_cart/shopping_cart.css">
    <script src="<?php echo base_url();?>assets/js/shopping_cart/shopping_cart.js"></script>

  </head>
  <body>

    <div class="container mt-3">


        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Item</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($temp_orders as $temp_order) {?>
                    <tr>
                        <td><?=$temp_order['name']?></td>
                        <td>$<?=$temp_order['price']?></td>
                        <td>
                            <form class="td_input_form" action="">
                                <input class="td_input" type="text" value="<?=$temp_order['quantity']?>">
                            </form>
                            <a class="td_update">update</a> 
                            <a class="td_delete" href="<?=base_url()?>customers/delete_temp_order/<?=$temp_order['id']?>">delete</a>
                        </td>
                        <td>$<?=$temp_order['total_price']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>

        <p class="total_price continue">$<?=$total_temp_price['total_temp_price']?></p>
        <button class="btn btn-success mb-5 continue"><a href="<?=base_url()?>customers/show/<?=$temp_orders[0]['product_id']?>">Continue Shopping</a></button>


        <form action="<?=base_url()?>customers/ship_bill_info" method="post">

            <div class="shipping">
                <h3>Shipping Information</h3>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="first_name">
                    <label>First Name</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="last_name">
                    <label>Last Name</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="address">
                    <label>Address</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="address2">
                    <label>Address 2</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="city">
                    <label>City</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="state">
                    <label>State</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="zip_code">
                    <label>Zipcode</label>
                </div>
            </div>

            <div class="billing">
                <h3>Billing Information</h3>
                <input type="checkbox"><label for="" class="ms-3">Same as shipping </label>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_first_name">
                    <label>First Name</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_last_name">
                    <label>Last Name</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_address">
                    <label>Address</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_address2">
                    <label>Address 2</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_city">
                    <label>City</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_state">
                    <label>State</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_zip_code">
                    <label>Zipcode</label>
                </div>

                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_card">
                    <label>Card</label>
                </div>
                <div class="text-field">
                    <input type="text"  placeholder=" " class="form-control" name="bill_security_code">
                    <label>Security Code</label>
                </div>
                <div class="text-field">
                    <input type="month"  placeholder=" " class="form-control" name="bill_expiration">
                    <label>Expiration</label>
                </div>
            </div>

            <button class="btn btn-success">Pay</button>
            
        </form>

           

    </div>