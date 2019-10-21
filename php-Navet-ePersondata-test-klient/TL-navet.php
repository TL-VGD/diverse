<?php
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
$sslOptions = array(
	'local_cert' => 'Kommun_A.pem',
	'passphrase' => '5085873593180405',
	);
$streamcontext = stream_context_create(	array('ssl' => $sslOptions) );
$options = array(
	'location' => 'https://www2.test.skatteverket.se/na/na_epersondata/V2/personpostXML',
	'stream_context' => $streamcontext
	);
$wsdl = 'file://' . dirname(__FILE__) . DIRECTORY_SEPARATOR . 'navet.wsdl';
$client = new SoapClient($wsdl, $options);
if (!empty($_POST['pnr'])) { $pnr = $_POST['pnr']; } else { $pnr = '194107086995'; };
$argument  = [
		"Bestallning" => array(
			"OrgNr" => 162021004748, 
			"BestallningsId" => '00000079-FO01-0001'
			),
		"PersonId" => $pnr
	];
print json_encode( (array)$client->getData( $argument ), JSON_UNESCAPED_UNICODE );
?>
