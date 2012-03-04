<?php

require 'config.php';

require 'arc2/ARC2.php';

$file = $argv[1]; // 'annotations.ttl';
if (!$file) exit("Usage: {$argv[0]} file\n");

$parser = ARC2::getTurtleParser();
$parser->parse($file);

//$triples = $parser->getTriples();
$triples = $index = $parser->getSimpleIndex(0);
print_r($triples);

//$store = ARC2::getRemoteStore(array('remote_store_endpoint' => $config['store'] . '/services/sparql'));
//$q = 'SELECT ...';
//$rows = $store->query($q, 'rows');