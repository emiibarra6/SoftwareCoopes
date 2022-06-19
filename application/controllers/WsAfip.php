<?php

include 'vendor/afipsdk/afip.php/src/Afip.php';

//ya estamos en produccion
$afip = new Afip(array('CUIT' => 20389282988,'production' => true));

$taxpayer_details = $afip->RegisterScopeThirteen->GetTaxpayerDetails(30685172506);


$server_status = $afip->RegisterScopeThirteen->GetServerStatus();

print_r($taxpayer_details); //razon social rara, deberia de devolver La Cassina

print_r($server_status);


?>
