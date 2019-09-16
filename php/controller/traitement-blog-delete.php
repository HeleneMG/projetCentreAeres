<?php

$id              = $_REQUEST["id"] ?? "";
$nomTable        = $_REQUEST["nomTable"] ?? "";

require "php/mes-fonctions.php";

supprimerLigne($nomTable, $id);

$confirmation = "article supprimé ($id)";