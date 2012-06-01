<?php
    include("album.php");
    if ($_GET['getnav'] == 1)
    {
        echo PhotoAlbum::generateList("horizontal", "../img",$_GET['count'],$_GET['count']+3);
    }
    echo "";
?>