<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';

$cidades = [];

if (isset($_GET['id_pais']) && is_numeric($_GET['id_pais'])) {
    $id_pais = (int) ($_GET['id_pais']);
    $query = "SELECT * FROM paises WHERE id_pais  = $id_pais";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $pais = $result->fetch_assoc();  
    } else {
        $pais = null;
    }
}

if (isset($id_pais)) {
    $query = "SELECT * FROM cidades WHERE id_pais = $id_pais";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cidades[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../assets/img/globo.svg" type="image/ico" />
    <title><?php echo htmlspecialchars($pais['nome']); ?></title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../index.php" title="Logo"><img src="../assets/img/logo.svg" alt="Logo" title="Logo"/></a>
        </div>

        <div class="search-container">
            <input type="text" id="search-cidades" class="search-box" placeholder="Buscar cidade...">
        </div>

        <nav class="navbar">
            <a class="navbaritem" href="../index.php">Voltar</a>
        </nav>
    </header>

    <main>
        <div class="titulo">
            <h2><?php echo htmlspecialchars($pais['nome']); ?></h2>
        </div>  
        
        <div id="api-info" class="api-info"></div>

        <div class="card-container">
            <?php if (!empty($cidades)): ?>
                <?php foreach ($cidades as $cidade): ?>
                    <div class="card">
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($cidade['nome']); ?></h3>
                            <p><?php echo number_format($cidade['populacao'], 0, ',', '.') . ' habitantes'; ?></p>
                            <a href="cidade/cidade.php?id_cidade=<?php echo urlencode($cidade['id_cidade']); ?>" class="btn">Ver Informações</a>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Não há cidades disponíveis no momento.</p>
            <?php endif; ?>
        </div>
    </main>
    
    <footer>
         <p> CRUD_Mundo - Gustavo Gomes </p>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>