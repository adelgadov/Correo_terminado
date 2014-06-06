<?php
class ejecutor {

//Quitar las tildes.
    public function quitarAcentos($text)
    {
        $text = htmlentities($text, ENT_QUOTES, 'ISO-8859-1');
        $text = strtolower($text);
        $patron = array (
            // Espacios, puntos y comas por guion


            // Vocales
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',

            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',

            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',

            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',

            // Agregar aqui mas caracteres si es necesario

        );

        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }


//Descargamos el csv con los parámetros necesarios para subirlo al Moodle.

    public function descarga_moodle($archivo, $curso, $i = 0) {
        header('Content-type: application/txt');
        header('Content-Disposition: attachment; filename="moodle.csv"');

        echo 'username;password;firstname;lastname;email; course1';
        echo "\r\n";
        do {
            echo 'al'.$archivo[$i]["num_matricula"].";".$archivo[$i]["password"].";".$archivo[$i]["nombre"].";".$archivo[$i]["apellido1"]." ".$archivo[$i]["apellido2"].";".$archivo[$i]["email_personal"].";".$curso;
            echo "\r\n";
            $i++;
        }while ($i < count($archivo));

    }

//Descargamos el csv con los parámetros necesarios para subirlo al servidor de correo.

    public function descarga_correos($archivo, $correo, $ejecutor, $i = 0) {
        header('Content-type: application/txt');
        header('Content-Disposition: attachment; filename="correos.csv"');
        echo 'email;password';
        echo "\r\n";
        do {
            $letranombre = substr($archivo[$i]["nombre"], 0, 1);
            echo preg_replace('[\s+]','',(strtolower($ejecutor -> quitarAcentos($letranombre).$ejecutor -> quitarAcentos($archivo[$i]["apellido1"]).$ejecutor -> quitarAcentos($archivo[$i]["apellido2"]).$correo.";".$archivo[$i]["password"])));
            echo "\r\n";
            $i++;
        }while ($i <count($archivo));

    }


    public function tabla_saneada($archivo,$ejecutor, $curso, $correos_originales, $correo, $i = 0, $b = 0) {

        echo '<link rel="stylesheet" type="text/css" href="estilos/estilo.css" />';
        echo '<title>Vista Previa</title>';

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
            $letranombre = substr($archivo[$b]["nombre"], 0, 1);
            echo '<tr><td>'.preg_replace('[\s+]','',(strtolower($ejecutor -> quitarAcentos($letranombre).$ejecutor -> quitarAcentos($archivo[$b]["apellido1"]).$ejecutor -> quitarAcentos($archivo[$b]["apellido2"]).$correo)))."</td><td>".$archivo[$b]["password"]."</td></tr>";
            $b++;
        }while ($b < count($archivo));

        echo '</table>';



    }
}