<?php

require 'config.php';

$file = 'reset.rdf';

$dom = new DOMDocument;
$dom->load($file);

$xpath = new DOMXPath($dom);
$xpath->registerNamespace('bf', 'http://schemas.talis.com/2006/bigfoot/configuration#');
$node = $xpath->query('bf:JobRequest/bf:startTime')->item(0);

$date = date(DATE_ATOM, time() + 30); // schedule for 30 seconds from now
$date = preg_replace('/\+00:00$/', 'Z', $date);
$node->appendChild($dom->createTextNode($date));

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $config['store'] . '/jobs',
  CURLOPT_HTTPHEADER => array('Content-Type: application/rdf+xml'),
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $dom->saveXML(),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_USERPWD => $config['auth'],
  CURLOPT_VERBOSE => true,
  CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
  CURLOPT_BINARYTRANSFER => true,
));

$result = curl_exec($curl);
print_r($result);
print "\n\n";
