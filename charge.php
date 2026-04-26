<?php
	//use PHPMailer\PHPMailer\PHPMailer;


	/* =========================================================

		THIS IS KILLED RIGHT NOW

	==========================================================*/
	die();
	/* =========================================================

		THIS IS KILLED RIGHT NOW

	==========================================================*/



	//$playerChoice = $_POST['playerChoice'];
	//$first_name = $_POST['fname'];
	$cust_name = $_POST['customername'];
	$email = $_POST['customeremail'];
	//$phone = $_POST['phone'];
	//$fileAttach = $_FILES['fileAttach'];
	//$bio = $_POST['bio'];

	$token  = $_POST['stripeToken'];

	$form_amount = $_POST['payamount'];
	$strName = $cust_name;

	//var_dump($_POST);
	//phpinfo();
	//die();

	try {
		//require_once('Stripe/init.php');

		// Use Stripe's library to make requests...
		//https://stripe.com/docs/api?lang=php
		//Secret Test Key


		/*
		$customer = \Stripe\Customer::create(array(
			'email' => $email,
			'description' => 'Customer for ' . $email,
			//'source' => $token,
			//'coupon' => $coupon,
		));
		*/

		//print_r( $customer );

		/*if ( $subChoice ) {
			\Stripe\Subscription::create(array(
				'customer' => $token,
				'coupon' => $coupon,
				'items' => array(
					array(
						'plan' => '2',
					),
				)
			));
		}*/

		$charge = \Stripe\Charge::create(array(
			'amount' => $form_amount*100,
			'currency' => "usd",
			'source' => $token,
			'description' => 'Payment from ' . $email . ' on VQDEV pay now form.',
		));


		/*===========================
			send email
		============================*/

		$strTo = 'jim.obrien3@gmail.com';
		//$strName = $first_name . ' ' . $last_name;

		$strEmail = $email;
		//$strPhone = $phone;
		//$strPlayerChoice = $playerChoice;
		//$strMessage = $bio;

		// Uniqid Session //
		$strSid = md5(uniqid(time()));

		$strHeader = "";
		$strHeader .= "From: ".$strName."<".$strEmail.">\nReply-To: ".$strEmail."";
		$strSubject = 'VQDEV payment from ' . $strName . ' for ' . $form_amount . '.';
		$strHeader .= "\nMIME-Version: 1.0\n";
		$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
		$strHeader .= "This is a multi-part message in MIME format.\n";
		$strHeader .= "--".$strSid."\n";
		$strHeader .= "Content-type: text/html; charset=utf-8\n";
		$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";

		$strHeader .= "Name: \n";
		$strHeader .= $strName."\n\n";
		$strHeader .= "Email: \n";
		$strHeader .= $strEmail."\n\n";
		//$strHeader .= "Phone: \n";
		//$strHeader .= $strPhone."\n\n";
		$strHeader .= "Amount: \n";
		$strHeader .= $form_amount."\n\n";
		//$strHeader .= "Player Choice: \n";
		//$strHeader .= $strPlayerChoice."\n\n";
		//$strHeader .= "Link to Video on qb-tv site: ";
		//$qbtv_file_link = 'http://qb-tv.com/wp-content/uploads/qbtv_video_uploads/' . $name;
		//$strHeader .= $qbtv_file_link . "\n\n";

		//$strHeader .= "Message: ";
		//$strHeader .= $strMessage."\n\n";

		$flgSend = mail("$strTo", "$strSubject", $strHeader);  // @ = No Show Error //

		if($flgSend) {

			$clientHeader = "";
			$clientHeader .= "From: " . "Jim O'Brien" . "<" . "jim.obrien3@gmail.com" . ">\n";
			$clientHeader .= "Reply-To: " . "jim.obrien3@gmail.com" . "\n";

			$clientSubject = 'VQDEV: Thank you, ' . $strName . ' for your payment.';

			$clientHeader .= "\nMIME-Version: 1.0\n";
			$clientHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
			$clientHeader .= "This is a multi-part message in MIME format.\n";
			$clientHeader .= "--".$strSid."\n";
			$clientHeader .= "Content-type: text/html; charset=utf-8\n";
			$clientHeader .= "Content-Transfer-Encoding: 7bit\n\n";

			$clientHeader .= "Congrats, " . $strName . " paid $" . $form_amount . " to Visionquest Development!" . "\n\n";
			$clientHeader .= "Name: \n";
			$clientHeader .= $strName."\n\n";
			$clientHeader .= "Email: \n";
			$clientHeader .= $strEmail."\n\n";
			//$clientHeader .= "Phone: \n";
			//$clientHeader .= $strPhone."\n\n";
			//$clientHeader .= "Player Choice: \n";
			//$clientHeader .= $strPlayerChoice."\n\n";

			//$clientHeader .= "We will get back to you via email within 72 hours of purchase with your results."."\n\n";
			$clientHeader .= "- Thanks from VQDEV";

			$emailtoClient = mail($strEmail, "$clientSubject", $clientHeader);

			header("Location: https://visionquestdevelopment.com/thank-you");
			die();

		} else {
			echo "Cannot send mail.";
		}

	} catch(\Stripe\Error\Card $e) {
		// Since it's a decline, \Stripe\Error\Card will be caught
		$body = $e->getJsonBody();
		$err  = $body['error'];

		print('Status is:' . $e->getHttpStatus() . "\n");
		print('Type is:' . $err['type'] . "\n");
		print('Code is:' . $err['code'] . "\n");
		// param is '' in this case
		print('Param is:' . $err['param'] . "\n");
		print('Message is:' . $err['message'] . "\n");
	} catch (\Stripe\Error\RateLimit $e) {
		// Too many requests made to the API too quickly
		 echo "Too many requests sent to Stripe's API too quickly";
	} catch (\Stripe\Error\InvalidRequest $e) {
		// Invalid parameters were supplied to Stripe's API
		print_r($response);
		//echo ("test");
		echo " Invalid parameters were supplied to Stripe's API";
	} catch (\Stripe\Error\Authentication $e) {
		// Authentication with Stripe's API failed
		// (maybe you changed API keys recently)
		echo " Authentication with Stripe's API failed";
	} catch (\Stripe\Error\ApiConnection $e) {
		// Network communication with Stripe failed
		echo " Network communication with Stripe failed";
	} catch (\Stripe\Error\Base $e) {
		// Display a very generic error to the user, and maybe send
		// yourself an email
		echo "You have encountered an error!";
	} catch (Exception $e) {
		// Something else happened, completely unrelated to Stripe
		 echo "Error: Something else happened, completely unrelated to Stripe";
	}

	?>
