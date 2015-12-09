<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "partgrabber";

    $conn = new mysqli($hostname, $username, $password, $dbname);

    if($conn->connect_error)
        die("Connection Failed: ".$conn->connect_error);
    else
        echo "";

?>

<?php $component_array = array("CPU", "GPU", "RAM", "Motherboard", "Storage", "Case", "PSU"); ?>

<style>
    body{
        background-image: url("image/circuit.jpg");
    }
    table{
        background-color: white;
    }
</style>

<link rel="icon" type="image/ico" href="image/favicon.ico"/>
