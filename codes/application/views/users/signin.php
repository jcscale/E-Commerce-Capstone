<title>Sign In</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/signin/signin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js" charset="utf-8"></script>
  </head>
  <body>

    <div class="container mt-3">
        <form action="" method="POST">
            <h3>Log In</h3>
            <div class="text-field">
                <input type="text" placeholder=" " class="form-control">
                <label>Email</label>
            </div>
    
            <div class="text-field">
                <input type="text" placeholder=" " class="form-control">
                <label>Password</label>
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="button">Login</button>
            </div>

            <p>Don't have an account? <span><a href="<?=base_url()?>signup">Sign Up</a></span></p>
        </form>
        
    </div>