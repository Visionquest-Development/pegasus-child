<?php // Create a customer using a Stripe token

// If you're using Composer, use Composer's autoload:
require_once('vendor/autoload.php');

// Be sure to replace this with your actual test API key
// (switch to the live key later)


try
{
  $customer = \Stripe\Customer::create(array(
    'email' => $_POST['stripeEmail'],
    'source'  => $_POST['stripeToken'],
    'plan' => 'sub-lvl2'
  ));

  header('Location: https://visionquestdevelopment.com/thank-you');
  exit;
}
catch(Exception $e)
{

  error_log("unable to sign up customer:" . $_POST['stripeEmail'].
    ", error:" . $e->getMessage());
	header('Location:https://visionquestdevelopment.com/404');
}
