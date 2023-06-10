<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="index.css"> <!-- Archivo CSS externo -->
</head>

<body>
    <header>
        <h1>Gestión de Hospital</h1>
        <div>
            <a href="" id="subCabecera">Agregar</a> <!-- Enlace para agregar -->
        </div>
    </header>

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
            require_once("dbAcces.php"); // Archivo de acceso a la base de datos

            // Obtener los valores de registros por página y página actual (si se envían por POST)
            $registrosPagina = isset($_POST['registros_pagina']) ? (int)$_POST['registros_pagina'] : 10;
            $pagina = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;

            $offset = ($pagina - 1) * $registrosPagina; // Calcular el offset para la consulta SQL

            $sql = "SELECT * FROM pacientes WHERE true"; // Consulta SQL inicial

            if (!empty($_POST["sip"])) {
                $sip = $_POST["sip"];
                $sql .= " AND sip LIKE :sip"; // Agregar condición si se proporciona un SIP en el formulario de búsqueda
            }

            // Obtener el número total de registros
            $totalRegistrosStmt = $pdo->prepare($sql);
            if (!empty($_POST["sip"])) {
                $sip = '%' . $sip . '%';
                $totalRegistrosStmt->bindParam(':sip', $sip);
            }
            $totalRegistrosStmt->execute();
            $totalRegistros = $totalRegistrosStmt->rowCount();

            // Calcular el número total de páginas
            $totalPaginas = ceil($totalRegistros / $registrosPagina);

            // Consulta SQL con limit y offset para obtener los registros de la página actual
            $stmt = $pdo->prepare($sql . " LIMIT :limit OFFSET :offset");
            if (!empty($_POST["sip"])) {
                $sip = '%' . $sip . '%';
                $stmt->bindParam(':sip', $sip);
            }
            $stmt->bindParam(':limit', $registrosPagina, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

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
                echo "<a href='Actualizar.php?id=" . $row['id'] . "'>Actualizar</a> | "; // Enlace para actualizar
                echo "<a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a>"; // Enlace para eliminar
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <form action="index.php" method="POST">
            <label for="sip">Buscador por SIP:</label>
            <input type="text" name="sip">
            <input type="submit" value="Buscar">
        </form>

        <div class="paginador">
            <!-- Formulario para ir a la primera página -->
            <form action="index.php" method="POST">
                <input type="hidden" name="pagina" value="1">
                <input type="hidden" name="registros_pagina" value="<?php echo $registrosPagina; ?>">
                <button type="submit" name="primera_pagina" <?php echo ($pagina == 1) ? 'disabled' : ''; ?>>Primera</button>
            </form>
            <!-- Formulario para ir a la página anterior -->
            <form action="index.php" method="POST">
                <input type="hidden" name="pagina" value="<?php echo max($pagina - 1, 1); ?>">
                <input type="hidden" name="registros_pagina" value="<?php echo $registrosPagina; ?>">
                <button type="submit" name="anterior" <?php echo ($pagina == 1) ? 'disabled' : ''; ?>>Anterior</button>
            </form>
            <span>Página <?php echo $pagina; ?></span> <!-- Página actual -->
            <!-- Formulario para ir a la página siguiente -->
            <form action="index.php" method="POST">
                <input type="hidden" name="pagina" value="<?php echo min($pagina + 1, $totalPaginas); ?>">
                <input type="hidden" name="registros_pagina" value="<?php echo $registrosPagina; ?>">
                <button type="submit" name="siguiente" <?php echo ($pagina == $totalPaginas) ? 'disabled' : ''; ?>>Siguiente</button>
            </form>
            <!-- Formulario para ir a la última página -->
            <form action="index.php" method="POST">
                <input type="hidden" name="pagina" value="<?php echo $totalPaginas; ?>">
                <input type="hidden" name="registros_pagina" value="<?php echo $registrosPagina; ?>">
                <button type="submit" name="ultima_pagina" <?php echo ($pagina == $totalPaginas) ? 'disabled' : ''; ?>>Última</button>
            </form>
        </div>

        <form action="index.php" method="POST">
            <label for="registros_pagina">Registros por página:</label>
            <select name="registros_pagina">
                <option value="10" <?php echo ($registrosPagina == 10) ? 'selected' : ''; ?>>10</option>
                <option value="20" <?php echo ($registrosPagina == 20) ? 'selected' : ''; ?>>20</option>
                <option value="30" <?php echo ($registrosPagina == 30) ? 'selected' : ''; ?>>30</option>
            </select>
            <input type="submit" value="Aplicar">
        </form>
    </footer>
</body>

</html>
