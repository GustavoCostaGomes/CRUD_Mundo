<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $populacao = (int) $_POST['populacao'];
    $id_pais = (int) $_POST['id_pais'];

     if ($id_pais <= 0) {
        $mensagem = "Selecione um país válido.";
    } else {
        $result = $conn->prepare("SELECT id_cidade FROM cidades WHERE nome = ?");
        $result->bind_param("s", $nome);
        $result->execute();
        $result->store_result();

        if ($result->num_rows > 0) {
            $mensagem = "Cidade já cadastrada.";
        } else {
            $stmt = $conn->prepare("INSERT INTO cidades (nome, populacao, id_pais) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $nome, $populacao, $id_pais);

            if ($stmt->execute()) {
                $mensagem = "Cadastro realizado com sucesso!";
            } else {
                $mensagem = "Erro ao cadastrar cidade.";
            }

            $stmt->close();
        }
        $result->close();
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
    <title>Cadastro de Cidades</title>
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
                <h2>Cadastrar Cidades</h2>
                <form action="create_cidades.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="message">
                        <?php if (!empty($mensagem)) echo '<span class="message-text">' . htmlspecialchars($mensagem) . '</span>'; ?>
                    </div>
                    <div class="input-box">
                        <input type="text" name="nome" required>
                    <label>Nome</label>
                    </div>
                    <div class="input-box">
                        <input type="number" name="populacao" required>
                        <label>População</label>
                    </div>
                    <div class="input-box">
                        <select name="id_pais" id="id_pais" required>
                            <option value="">Selecione um país</option>
                            <?php
                            $paises = $conn->query("SELECT id_pais, nome FROM paises ORDER BY nome ASC");
                            while ($pais = $paises->fetch_assoc()) {
                                echo "<option value='{$pais['id_pais']}'>{$pais['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>