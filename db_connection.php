<?php

#create variable to connect to the database which name is database-2013214
$connection = new PDO('mysql:host=localhost;dbname=database-2013214', 'happy', 'happy');
#for error handling
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
