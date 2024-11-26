<?php
// Conectar ao banco de dados
include("connection/connect.php");

if (mysqli_connect_errno()) {
    echo json_encode(["error" => "Falha ao se conectar: " . mysqli_connect_error()]);
    exit();
}

// Buscar consultas agendadas (selecione apenas os campos necessários)
$sql = "SELECT id, username, nome, data_consulta, hora, descricao, contato FROM consulta";
$result = mysqli_query($con, $sql);

if (!$result) {
    echo json_encode(["error" => "Erro na consulta: " . mysqli_error($con)]);
    exit();
}

$consultas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Verificar se há resultados e retornar o JSON
if (!empty($consultas)) {
    echo json_encode($consultas);
} else {
    echo json_encode(["message" => "Nenhuma consulta agendada"]);
}

// Fechar conexão com o banco de dados
mysqli_close($con);
?>
