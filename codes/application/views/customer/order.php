<title>Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Datatable CSS -->
    <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <!-- Datatable JS -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard_orders/dashboard_orders.css">

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard/dashboard.js" charset="utf-8"></script>
  </head>
  <body>

  <div class="container mt-3">

  <h3>Order History</h3>
    <div class="row">
        <?php foreach($orders as $order){?>
            <div class="card mt-3 me-3 alert-primary pb-2" style="width: 18rem;">
                <div class="card-header">
                    Total amount: <?=$order['total_price']?>
                </div>
                <?php foreach($customer_items as $val){?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Item: <?=$val['Item']?></li>
                        <li class="list-group-item">Price: <?=$val['Price']?></li>
                        <li class="list-group-item">Quantity: <?=$val['Quantity']?></li>
                    </ul>
                <?php }?>
                
            </div>
        <?php }?>
    </div>
      
  </div>
