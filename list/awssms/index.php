<?php
$mobile = urldecode($_GET['mobile']);
$message = urldecode($_GET['message']);

require './vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

$params = array(
    'credentials' => array(
        'key' => 'AKIAJBL76SN3WKDCRP5A',
        'secret' => 'eRAD3TLElf1m2AkspEWe9ITClMYz+vPETbHEMjK9',
    ),
    'region' => 'us-west-2', // < your aws from SNS Topic region
    'version' => 'latest'
);
$sns = new \Aws\Sns\SnsClient($params);

$args = array(
    "SenderID" => "totalbhakti",
    "SMSType" => "Transactional",
    "Message" => $message,
    "PhoneNumber" => $mobile
);

$result = $sns->publish($args);
