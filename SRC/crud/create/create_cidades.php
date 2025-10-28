<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $populacao = $_POST['populacao'];
    $idioma = $_POST['id_pais'];

    $sql = "SELECT * FROM cidades WHERE nome = '$nome'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: create_cidades.php?message=" . urlencode("Cidade já cadastrada"));
        exit();
    }
    else {
        $sql = "INSERT INTO cidades(nome, populacao, id_pais) VALUES ('$nome', '$populacao', '$id_pais')";
        if ($conn->query($sql) === TRUE) {
            header("Location: create_cidades.php?message=" . urlencode("Cadastro realizado com sucesso"));
            exit(); 
        }
        else {
            header("Location: create_cidades.php?message=" . urlencode("Erro ao cadastrar"));
            exit();
        }
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
    <link rel="shortcut icon" href="../../../img/globo.svg" type="image/ico" />
    <title>Cadastro de Cidades</title>
</head>
<body>

</body>
</html>