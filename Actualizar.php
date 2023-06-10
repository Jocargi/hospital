<?php
require_once("dbAcces.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $sip = $_POST["sip"];
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $telefono = $_POST["telefono"];
    $localidad = $_POST["localidad"];
    $sexo = $_POST["sexo"];

    $stmt = $pdo->prepare("UPDATE pacientes SET sip = :sip, dni = :dni, nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, telefono = :telefono, localidad = :localidad, sexo = :sexo WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":sip", $sip);
    $stmt->bindParam(":dni", $dni);
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":apellido1", $apellido1);
    $stmt->bindParam(":apellido2", $apellido2);
    $stmt->bindParam(":telefono", $telefono);
    $stmt->bindParam(":localidad", $localidad);
    $stmt->bindParam(":sexo", $sexo);
    $stmt->execute();

    header("Location: index.php");
    exit();
} else {
    $id = $_GET["id"];

    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Actualizar</title>
    <link rel="stylesheet" href="Actualizar.css">
</head>
<body>
    <header>
        <h1>Modificar Usuario</h1>
    </header>
    <section>
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
            <label for="sexo">Sexo:</label>
            <select name="sexo">
                <option value="Hombre" <?php if($paciente['sexo'] == 'Hombre') echo 'selected'; ?>>Hombre</option>
                <option value="Mujer" <?php if($paciente['sexo'] == 'Mujer') echo 'selected'; ?>>Mujer</option>
            </select>
            <input type="submit" value="Actualizar">
        </form>
    </section>
</body>
</html>

