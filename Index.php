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
    <h1>Gestion de Hospital</h1>
    <div>
        <a href="" id="subCabecera">Agregar</a>
    </div>
    </header>
    <?php
    $pdo;
   $stmt = $pdo->prepare("SELECT * FROM pacientes limit 10");
   $stmt->execute();
    $row=1;

    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>sip</th>";
    echo "<th>dni</th>";
    echo "<th>nombre</th>";
    echo "<th>apellido1</th>";
    echo "<th>apellido2</th>";
    echo "<th>telefono</th>";
    echo "<th>fecha_nacimiento</th>";
    echo "<th>Acciones</th>";
  
  

    

    // Recorrer los resultados y mostrar los datos en la tabla
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
        echo "<td>";
        echo "<a href='Actualizar.php?id=" . $row['id'] . "'>Actualizar |</a>";
        echo "<a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";






    ?>
</body>

</html>