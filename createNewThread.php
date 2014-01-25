<?php

$newfile = fopen("threads/"+$_POST['name']+".cr", 'w');

fwrite($newfile, /*username*/+" "+date("d/m/Y")+ $_POST['content');

fclose($newfile);





?>
