<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';

$id_pais = $_GET['id_pais'];
$mensagem = "";

// verifica se o id foi passado
if (!isset($_GET['id_pais']) || empty($_GET['id_pais'])) {
    die("ID do país não fornecido.");
}

$id_pais = intval($_GET['id_pais']);

$query = "SELECT * FROM paises WHERE id_pais = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_pais);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("País não encontrado.");
}

$pais = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $continente = $_POST['continente'];
    $populacao = (int) $_POST['populacao'];
    $idioma = $_POST['idioma'];
    $novaBandeira = $pais['bandeira'];

    // nova bandeira
    if (isset($_FILES['bandeira']) && $_FILES['bandeira']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['bandeira'];

        $targetDir = "../../assets/img/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileType = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'avif', 'webp'];

        if (!in_array($fileType, $allowedTypes)) {
            $mensagem = "Formato de imagem inválido. Permitidos: JPG, JPEG, PNG, AVIF, WEBP";
        } else {
            $fileName = uniqid() . '.' . $fileType;
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
                $antiga = "../../assets/img/" . $pais['bandeira'];
                if (file_exists($antiga)) unlink($antiga);

                $novaBandeira = $fileName;
            } else {
                $mensagem = "Erro ao enviar a nova bandeira.";
            }
        }
    }

    $updateQuery = "UPDATE paises SET nome=?, continente=?, populacao=?, idioma=?, bandeira=? WHERE id_pais=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssissi", $nome, $continente, $populacao, $idioma, $novaBandeira, $id_pais);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../crud.php");
        exit;
    } else {
        $mensagem = "Erro ao atualizar país. Tente novamente.";
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
    <title>Atualizar País</title>
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
                <h2>Atualizar País</h2>
                <form action="update_paises.php?id_pais=<?php echo $id_pais; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="message">
                        <?php if (!empty($mensagem)) echo '<span class="message-text">' . htmlspecialchars($mensagem) . '</span>'; ?>
                    </div>

                    <div class="input-box">
                        <input type="text" name="nome" value="<?php echo htmlspecialchars($pais['nome']); ?>" required>
                        <label>Nome</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="continente" value="<?php echo htmlspecialchars($pais['continente']); ?>" required>
                        <label>Continente</label>
                    </div>

                    <div class="input-box">
                        <input type="number" name="populacao" value="<?php echo htmlspecialchars($pais['populacao']); ?>" required>
                        <label>População</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="idioma" value="<?php echo htmlspecialchars($pais['idioma']); ?>" required>
                        <label>Idioma</label>
                    </div>

                    <div class="input-box">
                        <input type="file" name="bandeira">
                        <label>Bandeira</label>
                    </div>

                    <button type="submit" class="btn">Atualizar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
