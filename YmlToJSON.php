<?php
use Symfony\Component\Yaml\Yaml;
$filepath='dati.ylm';
$output_file='dati.json';
$file=file_get_contents($filepath);
$yalmdata=Yalm::parse($file);
$jsonData = json_encode($yalmdata, JSON_PRETTY_PRINT);
file_put_contents($output_file, $jsonData);
?>
