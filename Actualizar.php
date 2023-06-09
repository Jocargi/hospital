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
        <input type="text" name="id" >
        
        <label for="Sip">SIP:</label>
        <input type="number" name="sip">
        
        <label for="Dni">DNI:</label>
        <input type="text" name="dni">

        <label for="Dni">nombre:</label>
        <input type="text" name="nombre">

        <label for="apellido1">apellido1:</label>
        <input type="text" name="apellido1">

        <label for="apellido2">apellido2:</label>
        <input type="text" name="apelldo2">
        
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono">
        
        <input type="submit" value="Actualizar">
    </form>

</section>

   
</body>
</html>



       
