<?php

require_once("../class/libs/parsedown.php");
$Parsedown = new Parsedown();

echo $Parsedown->text(htmlentities($_POST['content']));