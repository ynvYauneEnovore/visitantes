<!DOCTYPE html>
<html lang="es-BO" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
  </head>
  <body>
    <table border = 1>
      <tr>
        <td>#</td>
        <td>IP</td>
        <td>PAÍS</td>
        <td>MONEDA</td>
      </tr>
      <?php
      require 'config.php';
      $rows = mysqli_query($conn, "SELECT * FROM visitas");
      ?>

      <?php foreach($rows as $row) : ?>
      <tr>
        <td>Visitante <?php echo $row["idvisitas"]; ?></td>
        <td><?php echo $row["ip_visitante"]; ?></td>
        <td><?php echo $row["pais_origen"]; ?></td>
        <td><?php echo $row["moneda"]; ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
<br>
    <table border = 1>
      <tr>
        <td>#</td>
        <td>IP</td>
        <td>DATE</TD>
        <td>SIMBOLO</td>
        <td>VALOR</td>
      </tr>
      <?php
      require 'config.php';
      $rows = mysqli_query($conn, "SELECT * FROM monedas");
      ?>

      <?php foreach($rows as $row) : ?>
      <tr>
        <td>Visitante <?php echo $row["idmonedas"]; ?></td>
        <td><?php echo $row["ip"]; ?></td>
        <td><?php echo $row["date"]; ?></td>
        <td><?php echo $row["base"]; ?></td>
        <td><?php echo $row["rates"]; ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <a href="index.php">Index</a>
  </body>
</html>