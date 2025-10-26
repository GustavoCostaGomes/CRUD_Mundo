<?php
include '../../database/db.php';
    
$nome = "";
$continente ="";
$populacao = "";
$id_pais = "";

if (isset($_GET['id_cidade'])){
    $id = $_GET['id_cidade'];
    $sql = "SELECT * FROM cidades WHERE id_cidade = $id";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $populacao = $row['populacao'];
        $id_pais = $row['idioma'];
    } else {
        header("Location: update_cidades.php?message=" . urlencode("País não encontrado"));
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id_cidade'];
    $nome = $_POST['nome'];
    $populacao = $_POST['populacao'];
    $id_pais = $_POST['id_pais'];

    $sql = "UPDATE cidades SET nome='$nome', populacao='$populacao', id_pais='$id_pais' WHERE id_cidade='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: update_cidades.php?message=" . urlencode("Atualizado com sucesso"));
        exit();
    } else {
        header("Location: update_cidades.php?message=" . urlencode("Erro ao atualizar"));
        exit();
    }

    $conn->close();
    header("Location: update_cidades.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="" class="css">
    <title>Update</title>
</head>
<body>
    
</body>
</html>