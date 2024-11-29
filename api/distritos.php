<?php
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Falta el parámetro id_provincia']);
    exit;
}

$id_provincia = $_GET['id'];

$distritos = json_decode(file_get_contents('../json/distritos.json'), true);

$resultado = array_filter($distritos, function ($distrito) use ($id_provincia) {
    return $distrito['id_provincia'] === $id_provincia;
});

echo json_encode(array_values($resultado));
?>
