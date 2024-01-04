<?php
    include("function.php");
    $cities = cities($_POST['id']);
    echo json_encode($cities);
?>