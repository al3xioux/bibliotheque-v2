<?php
    $json = file_get_contents('test.json');
    // echo $json;
    echo var_dump(json_decode($json, true));

?>