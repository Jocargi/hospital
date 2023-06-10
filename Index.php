<!DOCTYPE html>
<html lang="en">
<?php
    require_once("dbAcces.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>Gestión de Hospital</h1>
        <div>
            <a href="" id="subCabecera">Agregar</a>
        </div>
    </header>

    <?php
        $pdo;
        $stmt = $pdo->prepare("SELECT * FROM pacientes LIMIT 10");
        $stmt->execute();
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>SIP</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Teléfono</th>
                <th>Localidad</th>
                <th>Sexo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['sip'] . "</td>";
                    echo "<td>" . $row['dni'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['apellido1'] . "</td>";
                    echo "<td>" . $row['apellido2'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['localidad'] . "</td>";
                    echo "<td>" . $row['sexo'] . "</td>";
                    echo "<td>";
                    echo "<a href='Actualizar.php?id=" . $row['id'] . "'>Actualizar</a> | ";
                    echo "<a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
