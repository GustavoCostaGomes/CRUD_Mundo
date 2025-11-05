<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';

$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $continente = $_POST['continente'];
    $populacao = (int) $_POST['populacao'];
    $idioma = $_POST['idioma'];

    if (isset($_FILES['bandeira']) && $_FILES['bandeira']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['bandeira'];

        $targetDir = "../../assets/img/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = uniqid() . '.' . strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        $targetFilePath = $targetDir . $fileName;

        $allowedTypes = ['jpg', 'jpeg', 'png', 'avif', 'webp'];
        $fileType = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        if (!in_array($fileType, $allowedTypes)) {
            $mensagem = "Formato de imagem inválido. Permitidos: JPG, JPEG e PNG";
        } elseif (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
                $insertQuery = "INSERT INTO paises (nome, continente, populacao, idioma, bandeira) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("sssis", $nome, $continente, $populacao, $idioma, $fileName);

                if ($stmt->execute()) {
                    $stmt->close();
                    $conn->close();
                    header("Location: ../crud.php");
                } else {
                    $mensagem = "Erro ao cadastrar produto. Tente novamente.";
                }
        } else {
            $mensagem = "Erro ao fazer upload da imagem.";
        }
    } else {
        $mensagem = "Nenhuma imagem foi enviada ou ocorreu um erro.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" class="css">
    <link rel="shortcut icon" href="../../assets/img/globo.svg" type="image/ico" />
    <title>Cadastro de Países</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../../index.php" title="Logo"><img src="../../assets/img/logo.svg" alt="Logo" title="Logo"/></a>
        </div>

        <nav class="navbar">
            <a class="navbaritem" href="../crud.php">Voltar</a>
        </nav>
    </header>

    <main>
        <div class="wrap">
            <div class="form-box">
                <h2>Cadastrar Países</h2>
                <form action="create_paises.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="message">
                        <?php if (!empty($mensagem)) echo '<span class="message-text">' . htmlspecialchars($mensagem) . '</span>'; ?>
                    </div>
                    <div class="input-box">
                        <input type="text" name="nome" required>
                    <label>Nome</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="continente" required>
                        <label>Continente</label>
                    </div>
                    <div class="input-box">
                        <input type="number" name="populacao" required>
                        <label>População</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="idioma" required>
                        <label>Idioma</label>
                    </div>
                    <div class="input-box">
                        <input type="file" name="bandeira" required>
                        <label>Bandeira</label>
                    </div>
                    <button type="submit" class="btn">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>