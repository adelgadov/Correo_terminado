<?php
include "ejecutor.php";
include "upload.php";
include "folder.php";
error_reporting(E_ERROR | E_PARSE);

$archivo = $_FILES["adjunto"]["name"];
$curso = $_POST['curso'];
$correo = $_POST['correo'];
$seleccion = $_POST['seleccion'];

$ejecutor = new ejecutor();

//Creamos la carpeta donde guardaremos el archivo si no está creada.
$carpeta = new folder();
$crear_carpeta = $carpeta -> crear_carpeta();


//Subimos el archivo y almacenamos el resultado en un array.
$upload = new upload();
$subir_archivo = $upload -> upload_file();
$leer_csv = $upload -> csv_to_array("adjuntos/".$archivo);

//Borra el documento que hemos subido una vez lo hemos almacenado en un array.
unlink('adjuntos/'.$archivo);

$ejecutor = new ejecutor();


switch ($seleccion){
    case ('Moodle'):

        $tabla = $ejecutor -> descarga_moodle($leer_csv, $curso);

        break;

    case ('Correos'):

        $tabla = $ejecutor -> descarga_correos($leer_csv, $correo, $ejecutor);
        break;

    case ('Mostrar'):

        $tabla = $ejecutor ->tabla_saneada($leer_csv, $ejecutor, $curso, $correos_originales, $correo);

        break;

}