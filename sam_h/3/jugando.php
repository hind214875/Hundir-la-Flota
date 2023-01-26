
<?php
require_once 'Board.php';

//recibir los attributos desde inicio
$turno = $_POST['turnos'];
$tablero = unserialize(base64_decode($_POST['tablero']));

//we call function play and augmentar turnos y check if the juego finished or not
if($_POST) {
    play($tablero);
    $turno++;
    if(terminarElJuego($tablero)){
        echo "El Juego termina con: ".$turno." turnos. Si quieres jugar otravez pulse el botón Jugar"."</br></br>";
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <style>
        table,
        tr,
        td {border: 1px solid black;width: 500px;margin: auto }
        form {text-align: center}
        .res{background-color: aqua; width: 300px;padding: 10px;}
    </style>
</head>

<body>
<?="TURNO: $turno"?>
<br>
<?=imprimirTablero($tablero);?>
<br>
<form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>">
    <label for="fila">Numero fila:</label><br>
    <input type="text" id="fila" name="fila" value="<?php if(isset($_POST['fila']))?>"/><br>

    <label for="columna">numero columna</label><br>
    <input type="text" id="columna" name="columna" value="<?php if(isset($_POST['columna']))?>"><br><br>

    <input type='hidden' name='tablero' value="<?=base64_encode(serialize($tablero)) ?>">
    <input type='hidden' name='turnos' value="<?=$turno?>">

    <input type="submit" value="enviar" name="submit">
    <input type="button" onclick="window.location.href='../3/inicio.php';" value="Jugar" />

</form>
<div class="res">
            <h3>Guía del juego</h3>
            <p>
                <strong>* 0 es Agua</strong></br>
                <strong>* 1 es Barco</strong></br>
                <strong>* F cuando dispara en una barco</strong></br>
                <strong>* A cuando dispara en Agua</strong></br>
                <strong>* si quieres volver a jugar utiliza el botón Jugar</strong></br>
            </p>
</div>
</body>

</html>