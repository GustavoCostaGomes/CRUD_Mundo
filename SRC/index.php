<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';

$query = "SELECT * FROM paises";
$result = $conn->query($query);
$paises = [];

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $paises[] = $row;
    }
} else {
    $paises = null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="assets/img/globo.svg" type="image/ico" />
    <title>Home</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php" title="Logo"><img src="assets/img/logo.svg" alt="Logo" title="Logo"/></a>
        </div>

        <div class="search-container">
            <input type="text" id="search-paises" class="search-box" placeholder="Buscar país...">
        </div>

        <nav class="navbar">
            <a class="navbaritem" href="crud/crud.php">Editar Dados</a>
        </nav>
    </header>

    <main>    
        <div class="titulo">
            <h2>Países</h2>
        </div>

        <div class="card-container">
            <?php if (!empty($paises)): ?>
                <?php foreach ($paises as $pais): ?>
                    <div class="card">
                        <img src="assets/img/<?php echo htmlspecialchars($pais['bandeira']); ?>" alt="<?php echo htmlspecialchars($pais['nome']); ?>">
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($pais['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($pais['continente']); ?></p>
                            <p><?php echo number_format($pais['populacao'], 0, ',', '.') . ' habitantes'; ?></p>
                            <p><?php echo htmlspecialchars($pais['idioma']); ?></p>
                            <a href="pais/pais.php?id_pais=<?php echo urlencode($pais['id_pais']); ?>" class="btn">Ver cidades</a>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Não há países disponíveis no momento.</p>
            <?php endif; ?>
        </div>

    </main>

    <footer>
         <p> CRUD_Mundo - Gustavo Gomes </p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>