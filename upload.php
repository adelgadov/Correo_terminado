<?php
class upload {

//Subimos el fichero a nuestra carpeta /adjuntos.

function upload_file () {

    $uploaddir = 'adjuntos/';
    $uploadfile = $uploaddir . basename($_FILES['adjunto']['name']);

    move_uploaded_file($_FILES['adjunto']['tmp_name'], $uploadfile);

}

//Convertimos el fichero .csv en un array bidimensional númerico-asociativo.

function csv_to_array($filename, $delimiter=';')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

}