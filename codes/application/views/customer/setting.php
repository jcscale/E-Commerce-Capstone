<title>Dashboard</title>

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"rel="stylesheet" /> -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/setting/setting.css">
    <script src="<?php echo base_url();?>assets/js/setting/setting.js"></script>


  </head>
  <body>

    <div class="container mt-3">

        <?php if($this->session->flashdata('settings_save')){?>
            <div class="settings_save">
                <p class="bg-success">Success</p>
            </div>
        <?php }?>

        <?php if(!empty($shipping)){?>
            <form action="<?=base_url()?>customers/update_setting" method="post"
                class="form-validation" data-cc-on-file="false"
                data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                id="payment-form">
            

                <div class="shipping">
                    <h3>Shipping Information</h3>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control" name="first_name" value="<?=$shipping['first_name']?>">
                        <label>First Name</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control" name="last_name" value="<?=$shipping['last_name']?>">
                        <label>Last Name</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control" name="address" value="<?=$shipping['address']?>">
                        <label>Address</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control" name="address2" value="<?=$shipping['address2']?>">
                        <label>Address 2</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control" name="city" value="<?=$shipping['city']?>">
                        <label>City</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control" name="state" value="<?=$shipping['state']?>">
                        <label>State</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control" name="zip_code" value="<?=$shipping['zip_code']?>">
                        <label>Zipcode</label>
                    </div>
                </div>

                <div class="billing">
                    <h3>Billing Information</h3>
                    <input type="checkbox"><label for="" class="ms-3 mb-3">Same as shipping </label>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control first_name" name="bill_first_name" value="<?=$billing['first_name']?>">
                        <label>First Name</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control last_name" name="bill_last_name" value="<?=$billing['last_name']?>">
                        <label>Last Name</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control address" name="bill_address" value="<?=$billing['address']?>">
                        <label>Address</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control address2" name="bill_address2" value="<?=$billing['address2']?>">
                        <label>Address 2</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control city" name="bill_city" value="<?=$billing['city']?>">
                        <label>City</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control state" name="bill_state" value="<?=$billing['state']?>">
                        <label>State</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control zipcode" name="bill_zip_code" value="<?=$billing['zip_code']?>">
                        <label>Zipcode</label>
                    </div>


                <button class="btn btn-success">Update</button>
                
            </form>
        <?php } else {?> 

            <form action="<?=base_url()?>customers/save_setting" method="post"
                class="form-validation" data-cc-on-file="false"
                data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                id="payment-form">
            

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
                        <input type="text"  placeholder=" " class="form-control first_name" name="bill_first_name">
                        <label>First Name</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control last_name" name="bill_last_name">
                        <label>Last Name</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control address" name="bill_address">
                        <label>Address</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control address2" name="bill_address2">
                        <label>Address 2</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control city" name="bill_city">
                        <label>City</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control state" name="bill_state">
                        <label>State</label>
                    </div>
                    <div class="text-field">
                        <input type="text"  placeholder=" " class="form-control zipcode" name="bill_zip_code">
                        <label>Zipcode</label>
                    </div>


                <button class="btn btn-success">Save</button>
            
            </form>
        <?php }?>

        
           
    </div>
