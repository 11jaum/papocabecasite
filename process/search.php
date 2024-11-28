<?php
    include("check.php");

    session_start();
    $username = $_SESSION['username']; // Verifique se a variável de sessão foi definida em check.php

    
    // Verifica se o nome de usuário contém "Psi"
    if (strpos($username, 'Psi') === false) {
        die('<p class="noResults">Apenas psicólogos podem usar a pesquisa.</p>');
    }

    // Executa a pesquisa se "Psi" for encontrado no nome do usuário
    if (isset($_GET["term"])) {
        $searchTerm = mysqli_real_escape_string($con, $_GET["term"]);

        $stmt = $con->prepare("SELECT Id, Username, Picture 
                               FROM User 
                               WHERE Username LIKE '%$searchTerm%' 
                               ORDER BY Username DESC 
                               LIMIT 20");
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;

        if ($count < 1) {
            echo '<p class="noResults">Sem resultados</p>';
        }

        while ($user = $result->fetch_assoc()) {
            ?>
            <div class="row" onclick="$('#searchContainer').hide(); chat('<?php echo $user['Id'] ?>');">
                <img src="profilePics/<?php echo $user["Picture"] ?>" />
                <p><?php echo $user["Username"] ?></p>
            </div>
            <?php
        }
    }
?>
