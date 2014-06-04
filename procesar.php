<?php
include "saneartexto.php";
include "upload.php";
error_reporting(E_ERROR | E_PARSE);

$archivo = $_FILES["adjunto"]["name"];
$curso = $_POST['curso'];
$correo = $_POST['correo'];
$seleccion = $_POST['seleccion'];

$saneartexto = new saneartexto();

$upload = new upload();
$subir_archivo = $upload -> upload_file();
$leer_csv = $upload -> csv_to_array("adjuntos/".$archivo);
$saneartexto = new saneartexto();


switch ($seleccion){
    case ('Moodle'):

        $tabla = $saneartexto -> descarga_moodle($leer_csv, $curso);

break;

    case ('Correos'):

        $tabla = $saneartexto -> descarga_correos($leer_csv, $correo, $saneartexto);
break;

    case ('Mostrar'):

        $tabla = $saneartexto ->tabla_saneada($leer_csv, $saneartexto, $curso, $correos_originales, $correo);

    break;

}




//var_dump($leer_csv);
?>
