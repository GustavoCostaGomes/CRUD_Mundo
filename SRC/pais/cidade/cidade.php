<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';

if (isset($_GET['id_cidade']) && is_numeric($_GET['id_cidade'])) {
    $id_cidade = (int) ($_GET['id_cidade']);
    $query = "SELECT * FROM cidades WHERE id_cidade  = $id_cidade";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $cidade = $result->fetch_assoc();  
    } else {
        $cidade = null;
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../assets/img/globo.svg" type="image/ico" />
    <title><?php echo htmlspecialchars($cidade['nome']); ?></title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../../index.php" title="Logo"><img src="../../assets/img/logo.svg" alt="Logo" title="Logo"/></a>
        </div>

        <nav class="navbar">
            <a class="navbaritem" href="../pais.php?id_pais=<?php echo urlencode($cidade['id_pais']); ?>">Voltar</a>
        </nav>
    </header>

    <main>
        <div class="titulo">
            <h2><?php echo htmlspecialchars($cidade['nome']); ?></h2>
        </div>  
        
        <div id="api-info" class="api-info"></div>

    </main>
    
    <footer>
         <p> CRUD_Mundo - Gustavo Gomes </p>
    </footer>

    <script src="../../js/script_cidades.js"></script>
</body>
</html>