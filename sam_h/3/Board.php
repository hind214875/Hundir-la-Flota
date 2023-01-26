<?php
//variables

$tablero = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
];

//array for posiciones Prohibidas
$prohibidas = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
];

//5 arrays por los barcos
$portaviones = [1, 1, 1, 1]; //1
$submarinos = [1, 1, 1]; //3
$destructores = [1, 1]; //3
$fragatas = [1]; //2



//call the method to fill the tablero with barcos
rellenarTablero($tablero, $portaviones, $prohibidas);
for ($i = 1; $i <= 3; $i++) {
    rellenarTablero($tablero, $submarinos, $prohibidas);
    rellenarTablero($tablero, $destructores, $prohibidas);
    if ($i >= 2) {
        rellenarTablero($tablero, $fragatas, $prohibidas);
    }
}

//set casillas prohibidas
function setProhibidas($x, $y, &$prohibidas)
{
    /* boucle to set in $prohibidas positions arround the barco + the barco it self to avoid touching barcos */
    for ($i = $x - 1; $i < ($x + 2); $i++) {
        for ($j = $y - 1; $j < ($y + 2); $j++) {
            if ($i >= 0 && $i < 10 && $j >= 0 && $j < 10) {
                $prohibidas[$i][$j] = 1;
            }
        }
    }
}

//control prohibidas
function controlProhibidas($x, $y, $dir, &$barco, &$prohibidas)
{
    /* output of boolean: true if possible to set new barco in this position without touching other one */
    $possible = true;
    if ($dir === 0) {//where direction is horizontal 
        for ($i = 0; $i < (count($barco) + 1); $i++) {
            if ($y < 10) { //controle that it is inside the matriz
                if ($prohibidas[$x][$y] == 1) {
                    $possible = false;
                }
                $y++;
            }
        }
    } else {//where direction is vertical
        for ($j = 0; $j < (count($barco) + 1); $j++) {
            if ($x < 10) {//controle that it is inside the matriz
                if ($prohibidas[$x][$y] == 1) {
                    $possible = false;
                }
                $x++;
            }
        }
    }   
    return $possible;
}

//rellenar el tablero 
function rellenarTablero(&$tablero, &$barco, &$prohibidas)
{
    //while random x and y se encuentra en posicion prohibida genera otra x & y & direction

    $xRand = rand(0, count($tablero[0]) - 1); //0-9
    $yRand = rand(0, count($tablero[0]) - 1); //0-9
    $direction = rand(0, 1); // 0: horizontal, 1: vertical;

    /* when direction is horizontal */
    if ($direction === 0) {
        do {
            $total = $yRand + count($barco);
            /*controle is total is outside the matrix && that is possible to set a barco in this positions 
            if not then get new randoms and continue loop
            */
            if ($total >= 10 || controlProhibidas($xRand, $yRand, $direction, $barco, $prohibidas) == false) {
                $xRand = rand(0, count($tablero[0]) - 1); //0-9
                $yRand = rand(0, count($tablero[0]) - 1); //0-9
                $continue=true;  //variable to control if we stop the loop or continue
            } else {
                /* if is possible to set barco and is inside matrix. set matrix prohibidas and tablero with 1(barco) */
                for ($i = 0; $i < count($barco); $i++) {
                    setProhibidas($xRand, $yRand, $prohibidas);
                    $tablero[$xRand][$yRand] = 1;
                    $yRand++;
                   
                }
                $continue=false; //variable to control if we stop the loop or continue
            }
        } while ($continue);
    } else {
        do {
            $total = $xRand + count($barco);
            if ($total >= 10 || controlProhibidas($xRand, $yRand, $direction, $barco, $prohibidas) == false) {
                $xRand = rand(0, count($tablero[0]) - 1); //0-9
                $yRand = rand(0, count($tablero[0]) - 1);
                $continue=true;
            } else {

                for ($i = 0; $i < count($barco); $i++) {
                    setProhibidas($xRand, $yRand, $prohibidas);
                    $tablero[$xRand][$yRand] = 1;
                    $xRand++; 
                }

                $continue=false;
            }
        } while ($continue);
    }
}



//imprimir el tablero
function imprimirTablero($tablero)
{
    echo "<table>";

    foreach ($tablero as $fila) {

        echo "<tr>";

        foreach ($fila as $columna) {
            echo "<td>" . $columna . " " . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";

}


function play(&$tablero)
{
    $fila = $_POST['fila'];
    $columna = $_POST['columna'];
    /*checks if the row and column is not out of the board, and if the position equal to 1 is changed to F else the position is changed to A*/
    if ($fila >= 0 && $fila < count($tablero) && $columna >= 0 && $columna < count($tablero)) {

        if ($tablero[$fila][$columna] == 1) {
            $tablero[$fila][$columna] = "F";
           
            echo "<strong style='color:green'>Has Tocado un barco</strong><br><br>";
        } else if ($tablero[$fila][$columna] == 0) {
            $tablero[$fila][$columna] = "A";
            echo "<strong style='color:red'>Has fallado</strong><br><br>";
        }

    } else {
        echo "<strong style='color:red'>Fuera del tablero</strong>";
    }
}

//function that check if the game ends
function terminarElJuego($tablero){
    $terminar=true;
    for ($i=0; $i <count($tablero) ; $i++) { 
        for ($j=0; $j <count($tablero) ; $j++) { 
            if($tablero[$i][$j]==1){
              $terminar=false;
            }
        }
    }
    return $terminar;
}