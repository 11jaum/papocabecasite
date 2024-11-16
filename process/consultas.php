<?php
// Conectar ao banco de dados
include("connection/connect.php");

if (mysqli_connect_errno()) {
    echo json_encode(["error" => "Falha ao se conectar: " . mysqli_connect_error()]);
    exit();
}

// Buscar consultas agendadas
$sql = "SELECT * FROM consulta";
$result = mysqli_query($con, $sql);

if (!$result) {
    die(json_encode(["error" => "Erro na consulta: " . mysqli_error($con)]));
}

$consultas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Verificar se há resultados
if (count($consultas) > 0) {
    echo json_encode($consultas);
} else {
    echo json_encode(["message" => "Nenhuma consulta agendada"]);
}

mysqli_close($con);
?>
