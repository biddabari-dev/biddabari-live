<?php
die();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

$servername = "localhost";
$database = "biddabari_staging";
$username = "root";
$password = "";
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check the connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

$pdfs_query = "select * from existing_pdfs where id>13853";
$pdfs_results = mysqli_query($conn, $pdfs_query);
while($pdfs_data = mysqli_fetch_array($pdfs_results)){

    if($pdfs_data['link']){

        $url = 'https://bidda-bari.sgp1.cdn.digitaloceanspaces.com/'.$pdfs_data['link']; 
        $file_name = basename($url); 

        if (file_put_contents($file_name, file_get_contents($url))) { 
            echo $pdfs_data['id'].'<br/>'; 
        } 
        else{ 
            echo $pdfs_data['id']."-F."; 
        } 
    }
    
}
echo 'done';
mysqli_close($conn);