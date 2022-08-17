<title>Dashboard</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/order_details/order_details.css">

  </head>
  <body>

    <div class="container mt-3">
        
        <div class="row g-5">
            <div class="col-md-5">
                <div class="shipping">
                    <h4>Order ID: <?=$info['id']?></h4>
                    <h6>Customer Shipping Info:</h6>
                    <p>Name: <?=$info['first_name']?></p>
                    <p>Address: <?=$info['address']?></p>
                    <p>City: <?=$info['city']?></p>
                    <p>State: <?=$info['state']?></p>
                    <p>Zip: <?=$info['zip_code']?></p>

                    <h6>Customer Billing Info:</h6>
                    <p>Name: <?=$info['bill_first_name']?></p>
                    <p>Address: <?=$info['bill_address']?></p>
                    <p>City: <?=$info['bill_city']?></p>
                    <p>State: <?=$info['bill_state']?></p>
                    <p>Zip: <?=$info['bill_zip']?></p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="order_details">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach($json_orders as $order){?>
                                <tr>
                                    <td><?=$order['Id']?></td>
                                    <td><?=$order['Item']?></td>
                                    <td><?=$order['Price']?></td>
                                    <td><?=$order['Quantity']?></td>
                                    <td><?=$order['Total']?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                      </table>

                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body bg-success">
                                    <p class="card-text">Status: Shipped</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                    <p class="card-text">Subtotal: $<?=$info['total_price']?></p>
                                    <p class="card-text">Shipping: $1.00</p>
                                    <p class="card-text">Total Price: $30.98</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>