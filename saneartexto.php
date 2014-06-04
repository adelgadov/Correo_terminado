<?php
class saneartexto {

//Descargamos el csv con los parámetros necesarios para subirlo al Moodle.

public function descarga_moodle($archivo, $curso, $i = 0) {
    header('Content-type: application/txt');
    header('Content-Disposition: attachment; filename="moodle.csv"');


        do {
            echo 'al'.$archivo[$i]["num_matricula"].";".$archivo[$i]["password"].";".$archivo[$i]["nombre"].";".$archivo[$i]["apellido1"]." ".$archivo[$i]["apellido2"].";".$archivo[$i]["email_personal"].";".$curso;
            echo "\r\n";
            $i++;
        }while ($i < count($archivo));

}

//Descargamos el csv con los parámetros necesarios para subirlo al servidor de correo.

    public function descarga_correos($archivo, $correos_originales, $correo, $i = 0) {
        header('Content-type: application/txt');
        header('Content-Disposition: attachment; filename="correos.csv"');

        do {
            echo str_replace($correos_originales, $correo,$archivo[$i]["email_personal"]).";".$archivo[$i]["password"];
            echo "\r\n";
            $i++;
         }while ($i <count($archivo));

    }


public function tabla_saneada($archivo,$saneartexto, $curso, $correos_originales, $correo, $i = 0, $b = 0) {

    echo '<link rel="stylesheet" type="text/css" href="estilos/estilo.css" />';

//Hacemos cuadrar la tabla.

        $cuadrar_a = array ("apellido1", "email_personal", "apellido2");
        $cuadrar_b = array ("apellidos", "curso", "email_personal");


//Ponemos un título a la primera tabla

        echo '<div class="table_a_tittle"><h1>Moodle.csv</h1></div>';


//Creamos la primera tabla para ver cómo saldrá nuestra tabla del Moodle.

        echo '<table class="table_mostrar_a" border="1px solid black">';

        echo '<tr>';
        foreach ($archivo[0] as $campo => $valor) {
            echo '<th>'.str_replace($cuadrar_a, $cuadrar_b, $campo).'</th>';

        }

        echo '</tr><tr>';

        do {

        echo '<tr><td>al'.$archivo[$i]["num_matricula"]."</td><td>".$archivo[$i]["password"]."</td><td>".$archivo[$i]["nombre"]."</td><td>".$archivo[$i]["apellido1"]." ".$archivo[$i]["apellido2"]."</td><td>".$archivo[$i]["email_personal"]."</td><td>".$curso."</td></tr>";
        $i++;
        }while ($i < count($archivo));

    echo '</table>';


//Ponemos un título a la segunda tabla.

    echo '<div class="table_b_tittle"><h1>Correos.csv</h1></div>';


//Creamos la primera tabla para ver cómo saldrá nuestra tabla del sevidor de correo.

        echo '<table class="table_mostrar_b" border="1px solid black">';

        echo '<tr>';

            echo '<th>correo cesma</th><th>password';

        do {
            echo '<tr><td>'.str_replace($correos_originales, $correo,$archivo[$b]["email_personal"])."</td><td>".$archivo[$b]["password"]."</td></tr>";
            $b++;
        }while ($b < count($archivo));

        echo '</table>';



}
}
