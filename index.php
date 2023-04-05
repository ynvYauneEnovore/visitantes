<!DOCTYPE html>
<html lang="es-BO">
  <head>
    <meta charset="utf-8">
    <title>weVote</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <?php
    include 'head.php';
    ?>
    <div class="container w-80 vh-100 d-flex justify-content-center align-items-center">
    <a href="data.php">Data</a>
    
    <script type="text/javascript">
       const validInputs = ["EUR", "USD", "JPY", "BGN", "CZK", "DKK", "GBP", "HUF", "PLN", "RON",
         "SEK", "CHF", "ISK", "NOK", "TRY", "AUD", "BRL", "CAD", "CNY", "HKD", "IDR", 
         "ILS", "INR", "KRW", "MXN", "MYR", "NZD", "PHP", "SGD", "THB", "ZAR"];

    $(document).ready(function() {
        . $userInput;
    $json = file_get_contents($apiUrl);
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  </body>
</html>
<?php
require 'config.php';
  if(isset($_POST["ip"])){
    $ip = $_POST["ip"];
    $name = $_POST["name"];
    $currency = $_POST["currency"];
  
    $query = "INSERT INTO visitas VALUES('', '$ip', '$name', '$currency')";
    mysqli_query($conn, $query);
  
    // Obtener los datos del JSON según la moneda ingresada por el usuario
    $userInput = $_POST['userInput'];
    $apiUrl = 'https://api.vatcomply.com/rates?base=' . $userInput;
    $json = file_get_contents($apiUrl);
    $data = json_decode($json, true);
  
    // Si el JSON no contiene datos, mostrar un mensaje de error
    if (!$data) {
      echo "Error: no se encontraron datos para la moneda ingresada";
    } else {
      // Asignar los valores a las variables
      $date = $data['date'];
      $base = $data['base'];
      $rates = json_encode($data['rates']);
  
      // Crear una consulta preparada para insertar datos en la tabla "monedas"
      $stmt = $conn->prepare("INSERT INTO monedas (date, base, rates) VALUES (?, ?, ?)");
  
      // Asignar los valores a los parámetros de la consulta preparada
      $stmt->bind_param('sss', $date, $base, $rates);
  
      // Ejecutar la consulta preparada
      if ($stmt->execute()) {
        // Mostrar un mensaje de éxito
        echo "Los datos se han guardado correctamente en la base de datos.";
      } else {
        // Mostrar un mensaje de error
        echo "Error al guardar los datos en la base de datos.";
      }
    }
  }
  ?>
  