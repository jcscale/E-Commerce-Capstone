<title>Sign Up</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/signup/signup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js" charset="utf-8"></script>
  </head>
  <body>


<div class="container mt-3">
    <div class="error"><?=$this->session->flashdata('input_errors');?></div>

    <form action="users/process_signup" method="POST">
        <h3>Sign Up</h3>
        <div class="text-field">
            <input type="text" placeholder=" " class="form-control" name="first_name">
            <label>First Name</label>
        </div>

        <div class="text-field">
            <input type="text" placeholder=" " class="form-control" name="last_name">
            <label>Last Name</label>
        </div>

        <div class="text-field">
            <input type="email" placeholder=" " class="form-control" name="email">
            <label>Email</label>
        </div>

        <div class="text-field">
            <input type="password" placeholder=" " class="form-control" name="password">
            <label>Password</label>
        </div>

        <div class="text-field">
            <input type="password" placeholder=" " class="form-control" name="confirm_password">
            <label>Confirm Password</label>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Sign Up</button>
        </div>

        <p>Have an account? <span><a href="<?=base_url()?>">Log In</a></span></p>
    </form>
        
</div>