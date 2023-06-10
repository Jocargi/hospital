<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <h1>Gestión de Hospital</h1>
        <div>
            <a href="" id="subCabecera">Agregar</a>
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
            require_once("dbAcces.php");
            
            $registrosPagina = isset($_POST['registros_pagina']) ? (int)$_POST['registros_pagina'] : 10;
            $pagina = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;
            
            if (isset($_POST['siguiente'])) {
                $pagina++;
            }
            
            if (isset($_POST['anterior'])) {
                if ($pagina > 1) {
                    $pagina--;
                }
            }
            
            if (isset($_POST['primera_pagina'])) {
                $pagina = 1;
            }
            
            $offset = ($pagina - 1) * $registrosPagina;
            
            $sql = "SELECT * FROM pacientes WHERE true";
            
            if (!empty($_POST["sip"])) {
                $sip = $_POST["sip"];
                $sql .= " AND sip LIKE :sip";
            }
            
            $sql .= " LIMIT :limit OFFSET :offset";
            
            $stmt = $pdo->prepare($sql);
            
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
                echo "<a href='Actualizar.php?id=" . $row['id'] . "'>Actualizar</a> | ";
                echo "<a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a>";
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

        <?php
        $totalRegistros = $pdo->query("SELECT COUNT(*) FROM pacientes")->fetchColumn();
        $totalPaginas = ceil($totalRegistros / $registrosPagina);
        ?>

        <div class="paginador">
            <form action="index.php" method="POST">
                <input type="hidden" name="pagina" value="1">
                <button type="submit" name="primera_pagina" <?php echo ($pagina == 1) ? 'disabled' : ''; ?>>Primera</button>
            </form>
            <form action="index.php" method="POST">
                <input type="hidden" name="pagina" value="<?php echo $pagina - 1; ?>">
                <button type="submit" name="anterior" <?php echo ($pagina == 1) ? 'disabled' : ''; ?>>Anterior</button>
            </form>
            <span>Página <?php echo $pagina; ?></span>
            <form action="index.php" method="POST">
                <input type="hidden" name="pagina" value="<?php echo $pagina + 1; ?>">
                <button type="submit" name="siguiente" <?php echo ($pagina == $totalPaginas) ? 'disabled' : ''; ?>>Siguiente</button>
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
