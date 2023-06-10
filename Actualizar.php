<?php
require_once("dbAcces.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtienes los datosde los pacientes a través de la base del metodo post
    $id = $_POST["id"];
    $sip = $_POST["sip"];
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $telefono = $_POST["telefono"];
    $localidad = $_POST["localidad"];

    // Aqui lo que sucede es que se realiza la actualización y el bimParam por ejempl 
    //$stmt->bindParam(":dni", $dni);: Vincula el parámetro :dni de la consulta preparada con la variable $dni que contiene el valor actualizado del DNI  
    $stmt = $pdo->prepare("UPDATE pacientes SET sip = :sip, dni = :dni, nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, telefono = :telefono, localidad = :localidad WHERE id = :id");
    $stmt->bindParam(":sip", $sip);
    $stmt->bindParam(":dni", $dni);
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":apellido1", $apellido1);
    $stmt->bindParam(":apellido2", $apellido2);
    $stmt->bindParam(":telefono", $telefono);
    $stmt->bindParam(":localidad", $localidad);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Te redirecciona a la pagina principar si no hay nadad mal
    header("Location: index.php");
    exit();
} else {
    // Obtener el ID del paciente de la URL
    $id = $_GET["id"];

    // Obtener los datos del paciente según su ID
    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el paciente
    if (!$paciente) {
        echo "Paciente no encontrado.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Actualizar.css">
</head>
<body>
    <header> <h1>Actulizar clientes</h1></header>
<form action="actualizar.php" method="POST">
    <label for="id">ID:</label>
    <input type="text" name="id" value="<?php echo $paciente['id']; ?>">
    <label for="sip">SIP:</label>
    <input type="text" name="sip" value="<?php echo $paciente['sip']; ?>">
    <label for="dni">DNI:</label>
    <input type="text" name="dni" value="<?php echo $paciente['dni']; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $paciente['nombre']; ?>">
    <label for="apellido1">Apellido1:</label>
    <input type="text" name="apellido1" value="<?php echo $paciente['apellido1']; ?>">
    <label for="apellido2">Apellido2:</label>
    <input type="text" name="apellido2" value="<?php echo $paciente['apellido2']; ?>">
    <label for="telefono">Teléfono:</label>
    <input type="tel" name="telefono" value="<?php echo $paciente['telefono']; ?>">
    <label for="localidad">Localidad:</label>
    <input type="text" name="localidad" value="<?php echo $paciente['localidad']; ?>">
    <input type="submit" value="Actualizar">
</form>
    
</body>
</html>
