<?php

require_once 'Board.php';

//iniciar turnos 
$turnos = 1;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 1</title>
    <style>
        table,
        tr,
        td {border: 1px solid black;width: 500px;margin: auto }
        form {text-align: center}
      
    </style>
</head>

<body>
    <h2><b>Actividad 3:<b></h2>
    <?php
      imprimirTablero($tablero);
    ?>
    <br>
    <div>
         
        <form method="post" action="jugando.php">
            <label for="fila">Numero fila:</label><br>
            <input type="text" id="fila" name="fila" value="<?php if(isset($_POST['fila']))?>" /><br>

            <label for="columna">numero columna</label><br>
            <input type="text" id="columna" name="columna" value="<?php if(isset($_POST['columna']))?>"><br><br>
   
            <input type='hidden' name='tablero' value="<?= base64_encode(serialize($tablero)) ?>"> 
            <input type='hidden' name='turnos' value="<?= $turnos ?>">

            <input type="submit" value="enviar" name="submit">
        </form>
       

    </div>

</body>

</html>