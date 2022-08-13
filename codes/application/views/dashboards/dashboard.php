<title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashboard_orders/dashboard_orders.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js" charset="utf-8"></script>
  </head>
  <body>

  <div class="container">
    welcome
    <?=$this->session->userdata('first_name')?>
    <a class="nav-link" href="<?=base_url();?>logout">Logout</a>
  </div>