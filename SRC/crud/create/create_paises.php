<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $continente = $_POST['continente'];
    $populacao = $_POST['populacao'];
    $idioma = $_POST['idioma'];

    $sql = "SELECT * FROM paises WHERE nome = '$nome'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: create_paises.php?message=" . urlencode("País já cadastrado"));
        exit();
    }
    else {
        $sql = "INSERT INTO paises(nome, continente, populacao, idioma) VALUES ('$nome', '$continente', '$populacao', '$idioma')";
        if ($conn->query($sql) === TRUE) {
            header("Location: create_paises.php?message=" . urlencode("Cadastro realizado com sucesso"));
            exit(); 
        }
        else {
            header("Location: create_paises.php?message=" . urlencode("Erro ao cadastrar"));
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
    <title>Cadastro de Países</title>
</head>
<body>

</body>
</html>