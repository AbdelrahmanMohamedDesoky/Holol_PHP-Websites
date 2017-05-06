<?php
require_once('stripe/init.php');

$stripe = array(
  "secret_key"      => "sk_test_naMRIfedsT2uzmxqW3j3CKDc",
  "publishable_key" => "pk_test_6Lqm1xQ5sdpVEMxQui3B1JkU"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>