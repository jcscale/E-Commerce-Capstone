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

  <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <form action="">
                    <div class="text-field">
                        <input type="search" required class="form-control" aria-controls="empTable" id="search_table">
                        <label>Search</label>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <select class="form-select status" aria-label="Default select example" id="status">
                    <option selected>Show All</option>
                    <option>Order in process</option>
                    <option>Shipped</option>
                    <option>Cancelled</option>
                </select>
            </div>
        </div>

        <table id='empTable' class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Billing Address</th>
                <th scope="col">Total</th>
                <th scope="col">Status Order</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($orders as $order){?>
                <tr>
                    <td><a href="<?=base_url()?>dashboards/show/<?=$order['id']?>"><?=$order['id']?></a></td>
                    <td><?=$order['first_name']?></td>
                    <td><?=$order['created_at']?></td>
                    <td><?=$order['address']?></td>
                    <td>$<?=$order['total_price']?></td>
                    <td>
                        <select class="form-select status" aria-label="Default select example">
                            <option selected>Show All</option>
                            <option>Order in process</option>
                            <option>Shipped</option>
                            <option>Cancelled</option>
                        </select>
                    </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
      
  </div>
