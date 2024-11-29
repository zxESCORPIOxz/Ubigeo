<?php
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Falta el parámetro id_departamento']);
    exit;
}

$id_departamento = $_GET['id'];

$provincias = json_decode(file_get_contents('../json/provincias.json'), true);

$resultado = array_filter($provincias, function ($provincia) use ($id_departamento) {
    return $provincia['id_departamento'] === $id_departamento;
});

echo json_encode(array_values($resultado));
?>
