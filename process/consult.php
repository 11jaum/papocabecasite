<?php
include("connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $username_consulta = mysqli_real_escape_string($con, $_POST['username_consulta']);
    $name_consulta = mysqli_real_escape_string($con, $_POST['name_consulta']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $text = mysqli_real_escape_string($con, $_POST['text']);
    $contato = mysqli_real_escape_string($con, $_POST['contato'] ?? null);

    // Insert the data into the database
    $sql = "INSERT INTO consulta (username, nome, data_consulta, hora, descricao, contato)
            VALUES ('$username_consulta', '$name_consulta', '$date', '$time', '$text', '$contato')";

    if (mysqli_query($con, $sql)) {
        // Success
        echo json_encode(['status' => 'success', 'message' => 'Consulta marcada com sucesso!']);
    } else {
        // Error
        echo json_encode(['status' => 'error', 'message' => 'Erro ao marcar consulta.']);
    }

    // Close connection
    mysqli_close($con);
}
?>
