<?php

require 'config.php';

$file = $argv[1]; // 'annotations.ttl';
if (!$file) exit("Usage: {$argv[0]} file\n");

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $config['store'] . '/meta',
  CURLOPT_HTTPHEADER => array('Content-Type: text/turtle'),
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => file_get_contents($file),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_USERPWD => $config['auth'],
  CURLOPT_VERBOSE => true,
  CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
  CURLOPT_BINARYTRANSFER => true,
));

$result = curl_exec($curl);
print_r($result);
print "\n\n";

