
  <?php
  require_once("dbAcces.php");
  
  if (isset($_GET['id'])) {
      $sql_delete = "DELETE FROM pacientes WHERE id = :id";
      $arrayValues_pacientes[':id'] = $_GET['id'];
      
      $stmt = $pdo->prepare($sql_delete);
      $resultado = $stmt->execute($arrayValues_pacientes);
  
      if ($resultado) {
         header("Location:index.php");
      } else {
          echo "Error al eliminar el registro.";
      }
  }
  ?>
