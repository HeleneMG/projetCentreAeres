<?php
function creerConnexionBDD()
{
    $database   = "cms";   // NE PAS OUBLIER DE LE CHANGER
    $user       = "root";
    $password   = "";
    // Data Source Name
    $dsn = "mysql:dbname=$database;host=localhost;charset=utf8mb4";
    // créer la connexion avec MySQL
    $dbh = new PDO($dsn, $user, $password);
    return $dbh;
}
// JE CREE UNE FONCTION POUR ENVOYER UNE REQUETE SQL
function envoyerRequeteSQL ($requeteSQLPreparee, $tabAssoColonneValeur)
{
    // ON APPELLE LA FONCTION 
    // POUR ACTIVER LE CODE DE CONNEXION A LA BDD
    $dbh = creerConnexionBDD();
    // LA REQUETE SE FAIT EN 2 TEMPS
    // ETAPE prepare
    $pdoStatement = $dbh->prepare($requeteSQLPreparee);
    // ETAPE execute
    $pdoStatement->execute($tabAssoColonneValeur);
    // RENVOYER $pdoStatement POUR LA LECTURE
    return $pdoStatement;
}
// CETTE FONCTION DOIT RENVOYER UN TABLEAU $tabLigne
function lireTable($nomTable)
{
    $requeteSQLPreparee =
<<<CODESQL
SELECT * FROM $nomTable
ORDER BY id DESC
CODESQL;
    $pdoStatement = envoyerRequeteSQL($requeteSQLPreparee, []);
    // https://www.php.net/manual/fr/class.pdostatement.php
    // $pdoStatement VA NOUS SERVIR A RECUPERER LES RESULTATS
    // https://www.php.net/manual/fr/pdostatement.fetchall.php
    $tabLigne = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $tabLigne;
}
// EN PHP: VERSION AVEC UN TABLEAU ASSOCIATIF
function concatenerTexteAsso ($nomTable, $tabAssoColonneValeur)
{
    // AJOUTER LE CODE MANQUANT
    $texteFinal = "";
    $texteToken = "";
    $indice     = 0;
    foreach($tabAssoColonneValeur as $cle => $valeur)
    {
        if ($indice > 0)
        {
            // ON AJOUTE LA VIRGULE AU TEXTE FINAL
            $texteFinal = "$texteFinal,$cle";
            $texteToken = "$texteToken,:$cle";
        }
        else
        {
            // ON N(AJOUTE PAS LA VIRGULE) AU TEXTE FINAL
            $texteFinal = "$texteFinal$cle";
            $texteToken = "$texteToken:$cle";
        }
        // J'INCREMENTE MOI MEME L'INDICE
        $indice++;
    }
    // JE COMPLETE LE TEXTE FINAL
    $texteFinal = "INSERT INTO $nomTable ( $texteFinal ) VALUES ($texteToken)";
    return $texteFinal;
}
// INSERER UNE LIGNE DANS N'IMPORTE QUELLE TABLE
function insererLigneTable($nomTable, $tabAssoColonneValeur)
{
    // ETAPE1: CREER UNE REQUETE SQL PREPAREE
    $requeteSQLPreparee = concatenerTexteAsso($nomTable, $tabAssoColonneValeur);
    // ETAPE2: ENVOYER LA REQUETE
    $pdoStatement = envoyerRequeteSQL($requeteSQLPreparee, $tabAssoColonneValeur);
    // renvoyer $pdoStatement
    return $pdoStatement;
}
// DELETE
function supprimerLigne($nomTable, $id)
{
    // IL FAUT PROTEGER $id POUR ASSURER QUE C'EST UN NOMBRE
    // https://www.php.net/manual/fr/function.intval.php
    // filtre pour convertir $id en nombre entier
    $id = intval($id);
    // CREER UNE REQUETE SQL PREPAREE
    $requeteSQLPreparee =
<<<CODESQL
DELETE FROM $nomTable
WHERE id = $id
CODESQL;
    // pas de jeton :id donc rien dans le tableau
    $tabAssoColonneValeur = [];
    // ENVOYER LA REQUETE SQL PREPAREE
    $pdoStatement = envoyerRequeteSQL($requeteSQLPreparee, $tabAssoColonneValeur);
    // renvoyer $pdoStatement
    return $pdoStatement;
}
// JE VEUX CREER UNE FONCTION modifierLigne 
// QUI VA PRENDRE EN PARAMETRES
// PARAM1: LE NOM DE LA TABLE
// PARAM2: id DE LA LIGNE A MODFIER
// PARAM3: UN TABLEAU ASSOCIATIF QUI DONNE POUR CHAQUE COLONNE LA NOUVELLE VALEUR
// exemple
// modifierLigne("blog", "1", ["titre" => "nouveau titre", "contenu" => "nouveau contenu"]);
/*
REQUETE SQL A CONSTRUIRE ?
UPDATE blog 
SET 
titre = 'nouveau titre',
contenu = 'nouveau contenu'
WHERE 
id = 1;
# REQUETE PREPAREE A CONSTRUIRE
UPDATE blog 
SET 
titre = :titre,
contenu = :contenu
WHERE 
id = 1;
*/
function modifierLigne($nomTable, $id, $tabAssoColonneValeur)
{
    $id = intval($id);
    $listeColonneToken = "";
    // LA LISTE DES COLONNES EST DANS LES CLES DU TABLEAU ASSOCIATIF $tabAssoColonneValeur
    $indice = 0;
    foreach($tabAssoColonneValeur as $colonne => $nouvelleValeur)
    {
        // est-ce qu'on est au début ?
        if ($indice > 0)
        {
            // pour les élements suivants, je rajoute une virgule
            $listeColonneToken = $listeColonneToken . ",$colonne = :$colonne";
        }
        else
        {
            // au début, je ne mets pas de virgule
            $listeColonneToken = $listeColonneToken . "$colonne = :$colonne";
        }
        
        $indice++;
    }
    // REQUETE SQL PREPAREE
    $requeteSQLPreparee =
<<<CODESQL
UPDATE $nomTable
SET
$listeColonneToken
WHERE id = $id
CODESQL;
    // ENVOYER LA REQUETE SQL PREPAREE
    $pdoStatement = envoyerRequeteSQL($requeteSQLPreparee, $tabAssoColonneValeur);
    // renvoyer $pdoStatement
    return $pdoStatement;
}