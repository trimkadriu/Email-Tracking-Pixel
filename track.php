<?php

function returnImageGif() {
    $name = './dummy.jpg';
    $fp = fopen($name, 'rb');

    header("Content-Type: image/png");
    header("Content-Length: " . filesize($name));

    fpassthru($fp);
    exit;
}

$imageid = $_GET['imgid'];
if(!empty($imageid) && $_SERVER['REMOTE_ADDR'] !== '46.99.4.244') { // Exclude Google Mail Server
    file_put_contents('emails.db', $imageid, FILE_APPEND);
}
returnImageGif();