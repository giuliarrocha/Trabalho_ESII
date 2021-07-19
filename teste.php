<?php
$final = '<li>Jain R.K. and Iyengar S.R.K., â€œAdvanced Engineering Mathematicsâ€, Narosa Publications,</li>';

$final = str_replace("Â", "a", $final);
$final = str_replace("â", "a", $final);
$final = str_replace("é", 'e', $final);
$final = str_replace('É“', 'e', $final);
$final = str_replace('ã', 'a', $final);
$final = str_replace("ó", "o", $final);
$final = str_replace("Ó", "o", $final);
$final = str_replace("á", 'a', $final);
$final = str_replace('ç“', 'c', $final);
$final = str_replace('Ç', 'c', $final);

echo $final;
?>
