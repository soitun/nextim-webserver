<?php
include_once('common.php');
require 'http_client.php';
$ticket = gp('ticket');
$room_id = gp('id');
if(!empty($ticket)) {
    $data = array('ticket'=>$ticket, 'domain'=>$_IMC['domain'], 'apikey'=>$_IMC['apikey'], 'room'=>$room_id, 'endpoint' => $space['uid']);
	$client = new HttpClient($_IMC['imsvr'], $_IMC['impost']);
	$client->post('/room/leave', $data);
	$pageContents = $client->getContent();
	echo $pageContents;
}
?>
