<?php 
$date = str_replace('modified ', '',  $data[0]['text']);

$formatter = DateTimeImmutable::createFromFormat('Y-m-d', $date);
echo 'Vérifié le ' . $formatter->format( 'd/m/Y') . ' - ';
?>