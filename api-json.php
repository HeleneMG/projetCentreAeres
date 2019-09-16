<?php
// ICI ON VA TRAITER LES FORMULAIRES
// ET ON VA RENVOYER UNE REPONSE AU FORMAT JSON
$tabAssoJson = [];
// on ajoute des infos pour nous aider à développer
$tabAssoJson["date"]    = date("Y-m-d H:i:s");
$tabAssoJson["request"] = $_REQUEST;
// AJOUTER LE TRAITEMENT DES FORMULAIRES
// ON SE BASE SUR idFormulaire POUR DECLENCHER UN TRAITEMENT
$idFormulaire = $_REQUEST["idFormulaire"];
if ($idFormulaire != "")
{
    // ON DOIT TRAITER UN FORMULAIRE
    if ($idFormulaire == "blog-create")
    {
        // ON VA CHARGER LE FICHIER DE TRAITEMENT CORRESPONDANT
        require "php/controller/traitement-blog-create.php";
    }
    if ($idFormulaire == "blog-delete")
    {
        // ON VA CHARGER LE FICHIER DE TRAITEMENT CORRESPONDANT
        require "php/controller/traitement-blog-delete.php";
    }
    if ($idFormulaire == "blog-update")
    {
        // ON VA CHARGER LE FICHIER DE TRAITEMENT CORRESPONDANT
        require "php/controller/traitement-blog-update.php";
    }
}
// on ajoute le message de confirmation
$tabAssoJson["confirmation"] = $confirmation ?? "";
// on convertit le tableau associatif PHP en texte JSON
// https://www.php.net/manual/fr/function.json-encode.php
$texteJson = json_encode($tabAssoJson, JSON_PRETTY_PRINT);
// affiche le texte JSON
echo $texteJson;