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
    <link rel="shortcut icon" href="/SRC/assets/img/globo.svg" type="image/ico" />
    <title>Home</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="index.php" title="Logo"><img src="/SRC/assets/img/logo.svg" alt="Logo" title="Logo"/></a>
        </div>

        <nav class="navbar">
            <a class="navbaritem" href="/SRC/crud//crud.php">Editar Dados</a>
        </nav>
    </div>

    <div class="cont">

    </div>

    <div class="card-container">
        <?php if (!empty($paises)): ?>
            <?php foreach ($paises as $pais): ?>
                <div class="card">
                    <img src="/SRC/assets/img/ <?php echo htmlspecialchars($pais['bandeira']); ?>" alt="<?php echo htmlspecialchars($pais['nome']); ?>">
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($pais['nome']); ?></h3>
                        <p><?php echo htmlspecialchars($pais['continente']); ?></p>
                        <p><?php echo htmlspecialchars($pais['populacao']); ?></p>
                        <p><?php echo htmlspecialchars($pais['idioma']); ?></p>
                        <a href="/SRC/pais/pais.php echo urlencode($pais['id_pais']); ?>" class="btn">Ver cidades</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Não há países disponíveis no momento.</p>
        <?php endif; ?>
    </div>

    <div class="footer">

    </div>
</body>
</html>