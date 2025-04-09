<?php

  $host = 'localhost';
  $db = 'test';
  $user = 'postgres';
  $password = 'Surabko2305';

  $conn = pg_connect("host=$host port = 5432 dbname=$db user=$user password=$password");
   
?>