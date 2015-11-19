<?php
require 'vendor/autoload.php';

require 'envato/EnvatoApi.php';

define('ENVATO_TOKEN', '2veXlqqGpPEkmbYsxX4cdDrxlbCJA89R');

$envatoClient = new EnvatoApi(ENVATO_TOKEN);

echo '<pre>';

$result = $envatoClient->getAuthorSales(0);

// $result = $envatoClient->test();

// $result = $envatoClient->getBuyerPurchases(0);

// $result = $envatoClient->getPrivateDownloadPurshases();

if(isset($result)){
	var_dump($result);
}

echo '</pre>';
?>
