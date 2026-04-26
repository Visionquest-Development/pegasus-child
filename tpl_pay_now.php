<?php
/* 
	Template Name: Pay Now Template
*/
?>
	<?php get_header(); ?>
	
 
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
			<div class="col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					
					<?php the_content(); ?>
					<script>
					
						function pegasusOnSubmit(token) {
						  console.log( 'Gcaptcha Success.' );
						}

						function pegasusValidate(event) {
						  event.preventDefault();
						  if ( !document.getElementById('customeremail').value || !document.getElementById('customername').value ) {
							alert( "You must add text to the required field" );
						  } else {
							grecaptcha.execute();
						  }
						}

						function pegasusOnload() {
						  var element = document.getElementById('payment-button');
						  element.onclick = pegasusValidate;
						}

					</script>
					<script src="https://www.google.com/recaptcha/api.js" async defer></script>
					
					<form action="<?php echo get_stylesheet_directory_uri(); ?>/charge.php" method="POST" id="payment-form" enctype="multipart/form-data">
						  
						<div class="form-header">
							<p>Powered by Stripe</p>
						</div>
						  
						<span  id="card-errors" class="payment-errors" style="color: red; font-size: 22px; "></span>
						 
						<div class="form-row left">
							<label for="customername" class="next-line">Name <strong>*</strong></label>
							<input type="text" id="customername" name="customername" value="<?php ( isset( $_POST['customername'] ) ? $last_name : null ) ?>" required >
						</div>
						
						<!-- //Email -->
						<div class="form-row right">
							<label for="customeremail" class="next-line">Email <strong>*</strong></label>
							<input type="text" id="customeremail" name="customeremail" value="<?php ( isset( $_POST['customeremail'] ) ? $email : null ) ?>" required >
						</div>
						
						<div class="form-row amount">
							<span class="next-line"><b>Amount</b> <strong>*</strong></span>
							<i>Please enter a dollar amount.</i> 
							<input name="payamount" class="form-control" type="number" id="custom-donation-amount" placeholder="10.00" min="0" step="10.00"/ required >
						</div>
						<p><b>Credit Card</b> <strong>*</strong></p>
						<div id="card-element">
							<!-- a Stripe Element will be inserted here. -->
						</div>
						<br />
						
						<div id='recaptcha' 
						class="g-recaptcha"
						data-sitekey="6LfOVZ8UAAAAAGLQupG7Vf8qLQvG-DZD9USuoatc"
						data-callback="onSubmit"
						data-size="invisible"></div>
						
						<!--Submit-->
						<button type="submit" id="payment-button">Pay Now</button>
						<img class="pwrd-by-stripe centered" src="<?php echo get_stylesheet_directory_uri(); ?>/powered_by_stripe.png">
					</form>
					
					<script>pegasusOnload();</script>
					
				
				<?php endwhile; else: ?>
					<?php /* kinda a 404 of sorts when not working */ ?>
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
			</div>
			
       
      </div>
	</div>
    
	
	
	<script>
		/*
		jQuery(document).ready(function($) {
			
		
			 $('#sendPledgeBtn').click(function(){
			  var token = function(res){
				var $input = $('<input type=hidden name=stripeToken />').val(res.id);
				var tokenId = $input.val();
				var email = res.email;

				setTimeout(function(){
				  $.ajax({
					url:'make-payment.php',
					cache: false,
					data:{ email : email, token:tokenId },phva
				  })
				  .done(function(data){
					// If Payment Success 
					$('#sendPledgeBtn').html('Thank You').addClass('disabled');
				  })
				  .error(function(){
					$('#sendPledgeBtn').html('Error, Unable to Process Payment').addClass('disabled');
				  });
				},500);

				$('form:first-child').append($input).submit();
			  };
				
			   var changedamount = $('#amount').val()*100;
			  StripeCheckout.open({
				key:         'pk_test_S5QkayY1J119Z0K0beBhY6ug', // Your Key
				address:     false,
				amount:      changedamount,
				currency:    'usd',
				name:        'Canted Pictures',
				description: 'Donation',
				panelLabel:  'Checkout',
				token:       token
			  });
			  return false;
			}); 
			
		

			
			
			
			

		}); //end document ready function
		*/
	</script>
	
	<?php get_footer(); ?>
