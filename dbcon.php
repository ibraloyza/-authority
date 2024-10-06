<?php 
    define("HOTSNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","");
    define("DB_NAME", "authority");
    
    $conn= mysqli_connect(HOTSNAME,USERNAME,PASSWORD,DB_NAME);
    if(!$conn)
    {
        die("connection failed");
    }

?>