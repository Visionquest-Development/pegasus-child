<?php
require_once('vendor/autoload.php');


\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
