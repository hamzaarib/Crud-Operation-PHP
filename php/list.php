<?php 
    include("function.php");
    $array = array(
        "list_table" => list_table(),
        "genders" => genders(),
        "countries" => countries(),
        "cities" => cities(1)
    );
    echo json_encode($array);
?>