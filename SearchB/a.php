<?php

$tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
echo $tableName;

?>