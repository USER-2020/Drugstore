<?php
define("KEY", "drogueriajaramillos2021");
define("COD", "AES-128-ECB");

define('ProPayPal', 0);
if(ProPayPal){
	define("PayPalClientId", "*********************");
	define("PayPalSecret", "*********************");
	define("PayPalBaseUrl", "https://api.paypal.com/v1/");
	define("PayPalENV", "production");
} else {
	define("PayPalClientId", "AYjGImIQzlMVihvV0G3DQ8OPzm7aXk504eNKlnpFlO_5cLEK9Rcfq83pJKBEt0KIUPV6pmBIa7ObgLzv");
	define("PayPalSecret", "EELXTM9PX8R1x2ZHjcI50SW73UNwSYd0CHBfZ2U9cSu8VruREHxNG7Hd-78IOD-P8suhFmVNlwIpMyzr");
	define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
	define("PayPalENV", "sandbox");
}
?>