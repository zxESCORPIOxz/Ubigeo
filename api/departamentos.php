<?php
header('Content-Type: application/json');

$departamentos = json_decode(file_get_contents('../json/departamentos.json'), true);

echo json_encode($departamentos);
?>
