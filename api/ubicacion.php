<?php
header('Content-Type: application/json');

if (!isset($_GET['ubigeo'])) {
    echo json_encode(['error' => 'Falta el parámetro ubigeo']);
    exit;
}

$ubigeo = $_GET['ubigeo'];

$departamentos = json_decode(file_get_contents('../json/departamentos.json'), true);
$provincias = json_decode(file_get_contents('../json/provincias.json'), true);
$distritos = json_decode(file_get_contents('../json/distritos.json'), true);

$distrito = array_filter($distritos, function ($distrito) use ($ubigeo) {
    return $distrito['id'] === $ubigeo;
});

if (empty($distrito)) {
    echo json_encode(['error' => 'Ubigeo no encontrado']);
    exit;
}

$distrito = array_values($distrito)[0];

$provincia = array_filter($provincias, function ($provincia) use ($distrito) {
    return $provincia['id'] === $distrito['id_provincia'];
});

$provincia = array_values($provincia)[0];

$departamento = array_filter($departamentos, function ($departamento) use ($provincia) {
    return $departamento['id'] === $provincia['id_departamento'];
});

$departamento = array_values($departamento)[0];

$response = [
    'departamento' => $departamento['nombre'],
    'provincia' => $provincia['nombre'],
    'distrito' => $distrito['nombre']
];

echo json_encode($response);
?>
