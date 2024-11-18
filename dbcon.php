<?php



$conn = mysqli_connect('localhost','root','','School');
    // define("HOTSNAME","localhost");
    // define("USERNAME","root");
    // define("PASSWORD","");
    // define("DB_NAME", "School");
    
    // $conn= mysqli_connect(HOTSNAME,USERNAME,PASSWORD,DB_NAME);
    if(!$conn)
    {
        die("connection failed");
    }

?>