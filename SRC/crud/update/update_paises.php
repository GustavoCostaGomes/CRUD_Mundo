<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';
    
$nome = "";
$continente ="";
$populacao = "";
$idioma = "";

if (isset($_GET['id_pais'])){
    $id = $_GET['id_pais'];
    $sql = "SELECT * FROM paises WHERE id_pais = $id";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $continente = $row['continente'];
        $populacao = $row['populacao'];
        $idioma = $row['idioma'];
    } else {
        header("Location: update_paises.php?message=" . urlencode("País não encontrado"));
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id_pais'];
    $nome = $_POST['nome'];
    $continente = $_POST['continente'];
    $populacao = $_POST['populacao'];
    $idioma = $_POST['idioma'];

    $sql = "UPDATE paises SET nome='$nome', continente='$continente', populacao='$populacao', idioma='$idioma' WHERE id_pais='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: update_paises.php?message=" . urlencode("Atualizado com sucesso"));
        exit();
    } else {
        header("Location: update_paises.php?message=" . urlencode("Erro ao atualizar"));
        exit();
    }

    $conn->close();
    header("Location: update_paises.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" class="css">
    <link rel="shortcut icon" href="../../../img/globo.svg" type="image/ico" />
    <title>Update</title>
</head>
<body>
    
</body>
</html>