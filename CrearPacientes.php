<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Paciente</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <h1>Gestión de Hospital</h1>
        <div>
            <a href="index.php" id="subCabecera">Regresar</a>
        </div>
    </header>

    <h2>Crear Paciente</h2>

    <?php
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        

        // aqui se obtienen los datos enviados por el formulario
        $sip = $_POST["sip"];
        $dni = $_POST["dni"];
        $nombre = $_POST["nombre"];
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"];
        $telefono = $_POST["telefono"];
        $localidad = $_POST["localidad"];
        $sexo = $_POST["sexo"];

        // Aqui se realiza la consulta para insertar los datos
        $sql = "INSERT INTO pacientes (sip, dni, nombre, apellido1, apellido2, telefono, localidad, sexo)
                VALUES (:sip, :dni, :nombre, :apellido1, :apellido2, :telefono, :localidad, :sexo)";

        // Se prepara la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':sip', $sip);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido1', $apellido1);
        $stmt->bindParam(':apellido2', $apellido2);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':localidad', $localidad);
        $stmt->bindParam(':sexo', $sexo);

        // Se ejecuta la consulta y se verifica si se insertó correctamente el paciente
        if ($stmt->execute()) {
            echo "Paciente creado exitosamente.";
        } else {
            echo "Error al crear el paciente.";
        }
    }
    ?>

    <!-- Formulario para crear un nuevo paciente -->
    <form action="CrearPacientes.php" method="POST">
        <label for="sip">SIP:</label>
        <input type="text" name="sip" required><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido1">Apellido 1:</label>
        <input type="text" name="apellido1" required><br>

        <label for="apellido2">Apellido 2:</label>
        <input type="text" name="apellido2" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required><br>

        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" required><br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select><br>

        <input type="submit" value="Guardar">
    </form>
</body>

</html>
