<?php
function creerConnexionBDD()
{
    // TODO: IL FAUDRAIT ISOLER CE CODE 
    // POUR NE PAS AVOIR A MODIFIER LE FICHIER mes-fonctions.php
    // INFOS A CHANGER POUR CHAQUE PROJET
    $database   = "cms";   // NE PAS OUBLIER DE LE CHANGER
    $user       = "root";
    $password   = "";

    // Data Source Name
    $dsn = "mysql:dbname=$database;host=localhost;charset=utf8mb4";
    // crÃ©er la connexion avec MySQL
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
}

/*

function insererLigneBlog ($tabAssoColonneValeur)
{
    // ETAPE1: CREER UNE REQUETE SQL PREPAREE
    $requeteSQLPreparee =
<<<CODESQL

INSERT INTO blog
(titre, contenu, photo)
VALUES
( :titre, :contenu, :photo )

CODESQL;

    // ETAPE2: ENVOYER LA REQUETE
    $pdoStatement = envoyerRequeteSQL($requeteSQLPreparee, $tabAssoColonneValeur);

}

// DEFINIR/DECLARER LA FONCTION
function insererLigneContact ($tabAssoColonneValeur)
{
    // ETAPE1: CREER UNE REQUETE SQL PREPAREE
    $requeteSQLPreparee =
<<<CODESQL

INSERT INTO contact
(nom, email, message)
VALUES
( :nom, :email, :message )

CODESQL;
    // ETAPE2: ENVOYER LA REQUETE
    $pdoStatement = envoyerRequeteSQL($requeteSQLPreparee, $tabAssoColonneValeur);

}

*/
        /*        


        $requeteSQL =
<<<CODESQL

INSERT INTO contact
(nom, email, message)
VALUES
( '$nom', '$email', '$message' )

CODESQL;
        // MANIERE RAPIDE MAIS PAS SECURISEE CONTRE LES INJECTIONS SQL... 
        // https://www.php.net/manual/fr/pdo.exec.php
        // $dbh->exec($requeteSQL);

        */
