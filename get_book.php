<?php 

$book= $_GET['book'];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,
"https://www.googleapis.com/books/v1/volumes?q=".$book
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);


echo($result);

?>