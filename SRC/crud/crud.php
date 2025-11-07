<?php
include '/xampp/htdocs/CRUD_Mundo/SRC/database/db.php';

$resultPaises = $conn->query("SELECT * FROM paises ORDER BY id_pais");
$resultCidades = $conn->query("SELECT * FROM cidades ORDER BY id_pais");

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../assets/img/globo.svg" type="image/ico" />
    <title>CRUD</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../index.php" title="Logo"><img src="../assets/img/logo.svg" alt="Logo" title="Logo"/></a>
        </div>

        <nav class="navbar">
            <a class="navbaritem" href="create/create_paises.php">Cadastrar Países</a>
            <a class="navbaritem" href="create/create_cidades.php">Cadastrar Cidades</a>
        </nav>
    </header>

    <main>
        <div class="tabela">
            <div class="titulo">
                <h2>Países</h2>
            </div>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Continente</th>
                        <th>População</th>
                        <th>Idioma</th>
                        <th>Bandeira</th>
                        <th>Ações</th>
                    </tr>
                    <?php
                            if($resultPaises->num_rows > 0) {
                                while ($row = $resultPaises->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row["id_pais"] . "</td>
                                        <td>" . $row["nome"] . "</td>
                                        <td>" . $row["continente"] . "</td>
                                        <td>" . $row["populacao"] . "</td>
                                        <td>" . $row["idioma"] . "</td>
                                        <td>" . $row["bandeira"] . "</td>
                                        <td>
                                            <a href='update/update_paises.php?id_pais=" . $row["id_pais"] . "'>Editar</a>
                                            <a href='delete/delete_paises.php?id_pais=" . $row["id_pais"] . "' class='btn-excluir'>Excluir</a>
                                        </td>
                                    </tr>";
                                }
                            }
                            else{
                            echo "<tr><td colspan='5'>Nenhum registro encontrado</td></tr>";
                            }
                    ?>
                </table>
            </div>
        
            <div class="tabela">
                <div class="titulo">
                    <h2>Cidades</h2>
                </div>
                <div class="scroll">
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>População</th>
                            <th>Id_pais</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                                if($resultCidades->num_rows > 0) {
                                    while ($row = $resultCidades->fetch_assoc()) {
                                        echo "<tr>
                                            <td>" . $row["id_cidade"] . "</td>
                                            <td>" . $row["nome"] . "</td>
                                            <td>" . $row["populacao"] . "</td>
                                            <td>" . $row["id_pais"] . "</td>
                                            <td>
                                                <a href = 'update/update_cidades.php?id_cidade=" . $row["id_cidade"] . "'>Editar</a>
                                                <a href='delete/delete_cidades.php?id_cidade=" . $row["id_cidade"] . "' class='btn-excluir'>Excluir</a>
                                            </td>
                                        </tr>";
                                    }
                                }
                                else{
                                echo "<tr><td colspan='5'>Nenhum registro encontrado</td></tr>";
                                }
                        ?>
                    </table>
                </div>
            </div>
    </main>

    <footer>
         <p> CRUD_Mundo - Gustavo Gomes </p>
    </footer>

<script src="../js/script.js"></script>
</body>
</html>