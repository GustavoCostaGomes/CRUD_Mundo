<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';

$mensagem = "";

// Verifica seo id foi passado
if (!isset($_GET['id_cidade']) || empty($_GET['id_cidade'])) {
    die("ID da cidade não fornecido.");
}

$id_cidade = (int) $_GET['id_cidade'];

$query = "SELECT * FROM cidades WHERE id_cidade = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_cidade);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Cidade não encontrada.");
}

$cidade = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $populacao = (int) $_POST['populacao'];
    $id_pais = (int) $_POST['id_pais'];

    if ($id_pais <= 0) {
        $mensagem = "Selecione um país.";
    } else {
        $updateQuery = "UPDATE cidades SET nome = ?, populacao = ?, id_pais = ? WHERE id_cidade = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("siii", $nome, $populacao, $id_pais, $id_cidade);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: ../crud.php");
            exit;
        } else {
            $mensagem = "Erro ao atualizar cidade. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" class="css">
    <link rel="shortcut icon" href="../../../img/globo.svg" type="image/ico" />
    <title>Update Cidade</title>
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
                <h2>Atualizar Cidade</h2>
                <form action="update_cidades.php?id_cidade=<?php echo $id_cidade; ?>" method="post" autocomplete="off">
                    <div class="message">
                        <?php if (!empty($mensagem)) echo '<span class="message-text">' . htmlspecialchars($mensagem) . '</span>'; ?>
                    </div>

                    <div class="input-box">
                        <input type="text" name="nome" value="<?php echo htmlspecialchars($cidade['nome']); ?>" required>
                        <label>Nome</label>
                    </div>

                    <div class="input-box">
                        <input type="number" name="populacao" value="<?php echo htmlspecialchars($cidade['populacao']); ?>" required>
                        <label>População</label>
                    </div>

                    <div class="input-box">
                        <select name="id_pais" id="id_pais" required>
                            <option value="">Selecione um país</option>
                            <?php
                            $paises = $conn->query("SELECT id_pais, nome FROM paises ORDER BY nome ASC");
                            while ($pais = $paises->fetch_assoc()) {
                                $selected = ($pais['id_pais'] == $cidade['id_pais']) ? "selected" : "";
                                echo "<option value='{$pais['id_pais']}' $selected>{$pais['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn">Atualizar</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
         <p> CRUD_Mundo - Gustavo Gomes </p>
    </footer>
</body>
</html>
