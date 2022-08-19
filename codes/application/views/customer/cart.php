<title>Dashboard</title>

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"rel="stylesheet" /> -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/shopping_cart/shopping_cart.css">
    <script src="<?php echo base_url();?>assets/js/shopping_cart/shopping_cart.js"></script>

    <!-- <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


  </head>
  <body>

    <div class="container mt-3 p-3">



        <?php if(!empty($temp_orders)){?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="display:none" scope="col">Id</th>
                    <th scope="col">Item</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($temp_orders as $temp_order) {?>
                        <tr>
                            <td style="display:none"><?=$temp_order['id']?></td>
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

            <?php if(!empty($total_temp_price['total_temp_price'])) {?>
            <p class="total_price continue">$<?=$total_temp_price['total_temp_price']?></p>
            <?php if(!empty($temp_orders)){?>
                <!-- <button class="btn btn-success mb-5 continue"><a href="<?=base_url()?>customers/show/<?=$temp_orders[0]['product_id']?>">Continue Shopping</a></button> -->
                <button class="btn btn-success mb-5 continue"><a href="<?=base_url()?>customers">Continue Shopping</a></button>
            <?php }?>
            
        <?php }?>
        
      

            <?php if(!empty($shipping)){?>
                <form action="<?=base_url()?>customers/handlePayment" method="post"
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
                        <!-- <input type="checkbox"><label for="" class="ms-3">Same as shipping </label> -->
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

                        <input type="hidden" id="hidden_json" value=" " name="hidden_json">
                        <?php if(!empty($total_temp_price['total_temp_price'])){?>
                            <input type="hidden" value="<?=$total_temp_price['total_temp_price']?>" name="total_price">
                        <?php }?>
                        

                    </div>

                    <div class="pay">
                        <?php if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p><?php echo $this->session->flashdata('success'); ?></p>
                            </div>
                        <?php } ?>
                        <!-- <div class="text-field">
                            <input class='form-control' size='4' type='text' placeholder=" ">
                            <label class='control-label'>Name on Card</label>
                        </div> -->
                        <div class="text-field">
                            <input autocomplete='off' class='form-control card-number' size='20' type='text' placeholder=" ">
                            <label class='control-label'>Card Number</label>				
                        </div>
                        <div class="text-field">
                            <input autocomplete='off' class='form-control card-cvc' placeholder=' '
                                size='4' type='text'>	
                            <label class='control-label'>CVC (ex.456)</label>
                        </div>
                        <div class="text-field">
                            <input class='form-control card-expiry-month' size='2' type='text' placeholder=" ">
                            <label class='control-label'>Expiration Month (MM)</label>
                        </div>
                        <div class="text-field">
                            <input class='form-control card-expiry-year' size='4'
                                type='text' placeholder=" ">
                            <label class='control-label'>Expiration Year (YYYY)</label>
                        </div>

                        <button class="btn btn-success">Pay</button>
                    </div>

                    
                    
                </form>
            <?php } else {?>
                    <div class="alert alert-primary mb-3" role="alert">
                       Fill up first the shipping and billing infos in the settings tab to checkout order(s).
                    </div>
                <?php }?>

        <?php } else{?>
            <?php if($this->session->flashdata('success')){ ?>
                <script type="text/javascript">toastr.success('<?=$this->session->flashdata('success')?>')</script>
            <?php } ?>
            <h3 class="text-center">No orders in the cart</h3>
            <?php }?>
        

        
        
           
    </div>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        $(function () {
		var $stripeForm = $(".form-validation");
		$('form.form-validation').bind('submit', function (e) {
			var $stripeForm = $(".form-validation"),
				inputSelector = ['input[type=email]', 'input[type=password]',
					'input[type=text]', 'input[type=file]',
					'textarea'
				].join(', '),
				$inputs = $stripeForm.find('.required').find(inputSelector),
				$errorMessage = $stripeForm.find('div.error'),
				valid = true;
			$errorMessage.addClass('hide');
			$('.has-error').removeClass('has-error');
			$inputs.each(function (i, el) {
				var $input = $(el);
				if ($input.val() === '') {
					$input.parent().addClass('has-error');
					$errorMessage.removeClass('hide');
					e.preventDefault();
				}
			});
			if (!$stripeForm.data('cc-on-file')) {
				e.preventDefault();
				Stripe.setPublishableKey($stripeForm.data('stripe-publishable-key'));
				Stripe.createToken({
                    name: $('.first_name').val() +" "+ $('.last_name').val(),
                    // address_line1: $('.address').val(),
                    // address_line2: $('.address2'),
                    // address_city: $('.city').val(),
                    // address_country: $('.state').val(),
                    // address_zip: $('.zipcode'),
					number: $('.card-number').val(),
					cvc: $('.card-cvc').val(),
					exp_month: $('.card-expiry-month').val(),
					exp_year: $('.card-expiry-year').val()
				}, stripeResponseHandler);
			}
		});
		function stripeResponseHandler(status, res) {
			if (res.error) {
				$('.error')
					.removeClass('hide')
					.find('.alert')
					.text(res.error.message);
			} else {
				var token = res['id'];
				$stripeForm.find('input[type=text]').empty();
				$stripeForm.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
				$stripeForm.get(0).submit();
			}
		}
	});
    </script>


    