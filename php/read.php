<?php
    include("function.php");
    $read = read($_POST['id']);
    $array = array(
        "read" => $read,
        "genders" => genders(),
        "countries" => countries(),
        "cities" => cities($read['country_id'])
    );
    echo json_encode($array);
?>