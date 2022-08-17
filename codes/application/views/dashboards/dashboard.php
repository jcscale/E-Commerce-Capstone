<title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard_orders/dashboard_orders.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js" charset="utf-8"></script>
  </head>
  <body>

  <div class="container mt-3">

  <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <form action="">
                    <div class="text-field">
                        <input type="text" required class="form-control">
                        <label>Search</label>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <select class="form-select status" aria-label="Default select example">
                    <option selected>Show All</option>
                    <option>Order in process</option>
                    <option>Shipped</option>
                    <option>Cancelled</option>
                </select>
            </div>
        </div>

        <table class="table table-striped">
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

            <ul class="pagination d-flex justify-content-center">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
      
  </div>