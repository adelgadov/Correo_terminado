<?php
class folder {

    function crear_carpeta () {
$serv = $_SERVER ['DOCUMENT_ROOT'] .'/Correos/';

$ruta = $serv.'adjuntos';
if(!file_exists($ruta))
{
    mkdir ($ruta);

}
}

}