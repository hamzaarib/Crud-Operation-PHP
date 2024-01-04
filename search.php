<?php
    include("php/function.php");
    if(isset($_POST["search"])){
        $id = $_POST["id"];
        search($id);
    }
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $h = read($id);  
    }
?>
