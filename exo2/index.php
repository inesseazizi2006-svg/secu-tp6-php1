<!DOCTYPE html>
<!-- Page HTML mélangée avec du PHP (vu dans les slides 27 et 58) -->
<html>
<head>
    <meta charset="UTF-8">
    <title>Exercice 2 - Monitoring de serveurs</title>
</head>
<body>
<?php
    // Début d'un script PHP (vu dans le slide 58)

    // Tableau associatif "serveurs" : clé = nom du serveur,
    // valeur = tableau associatif (cpu, ram, status) (vu dans le slide 64)
    // status : "1" = online, "0" = offline
    $serveurs = array(
        'api-01'   => array('cpu' => 45, 'ram' => 60, 'status' => "1"),
        'api-02'   => array('cpu' => 92, 'ram' => 78, 'status' => "1"),
        'db-prod'  => array('cpu' => 70, 'ram' => 95, 'status' => "1"),
        'web-01'   => array('cpu' => 30, 'ram' => 40, 'status' => "1"),
        'web-02'   => array('cpu' => 55, 'ram' => 65, 'status' => "0"),
        'cache-01' => array('cpu' => 88, 'ram' => 92, 'status' => "1")
    );

    // Fonction avec paramètres et retour (vu dans le slide 71)
    // score = 100 - (cpu + ram) / 2  (opérateurs arithmétiques, slide 66)
    function calculerScore($cpu, $ram) {
        return 100 - ($cpu + $ram) / 2;
    }

    // Fonction : un serveur est critique si cpu > 85 OU ram > 90
    // Opérateurs relationnels et logique || (vu dans le slide 66)
    function estCritique($cpu, $ram) {
        return ($cpu > 85) || ($ram > 90);
    }

    // Variables pour le résumé (initialisation, vu dans le slide 60)
    $totalOnline   = 0;      // nombre de serveurs online
    $sommeScores   = 0;      // somme des scores (pour la moyenne)
    $meilleurNom   = "";     // nom du meilleur serveur
    $meilleurScore = null;   // meilleur score (null au départ, slide 60)
?>

    <!-- Tableau HTML : id="table1" et border="1" -->
    <table id="table1" border="1">
        <tr>
            <th>Serveur</th>
            <th>CPU%</th>
            <th>RAM%</th>
            <th>Status</th>
            <th>Score</th>
            <th>État</th>
        </tr>
<?php
    // Boucle foreach sur un tableau associatif : clé => valeur (vu dans le slide 69)
    foreach ($serveurs as $nom => $infos) {

        // Accès au contenu d'un tableau associatif par sa clé (vu dans le slide 64)
        $cpu    = $infos['cpu'];
        $ram    = $infos['ram'];
        $status = $infos['status'];

        // Appel de fonction (vu dans le slide 71)
        $score = calculerScore($cpu, $ram);

        // Texte du status : condition if / else (vu dans le slide 67)
        if ($status == "1") {
            $statusTexte = "online";
        } else {
            $statusTexte = "offline";
        }

        // Calcul de l'état : if / elseif / else (vu dans le slide 67)
        if (estCritique($cpu, $ram)) {
            $etat = "CRITIQUE";
        } elseif ($score >= 50) {
            $etat = "OK";
        } else {
            $etat = "ATTENTION";
        }

        // Couleur de fond conditionnelle (ordre de priorité de l'énoncé) (slide 67)
        if ($status == "0") {
            $couleur = "rgb(200,200,200)";      // offline -> gris
        } elseif ($etat == "CRITIQUE") {
            $couleur = "rgb(255,180,180)";      // critique -> rouge
        } elseif ($score >= 50) {
            $couleur = "rgb(180,255,180)";      // score >= 50 -> vert
        } else {
            $couleur = "rgb(255,220,150)";      // sinon -> orange
        }

        // Mise à jour du résumé
        if ($status == "1") {
            $totalOnline++;                     // incrémentation (slide 66)
        }
        $sommeScores = $sommeScores + $score;   // cumul pour la moyenne
        // Recherche du meilleur score (condition, slide 67)
        if ($meilleurScore === null || $score > $meilleurScore) {
            $meilleurScore = $score;
            $meilleurNom   = $nom;
        }

        // Génération de la ligne avec echo + concaténation (slides 25, 27, 60)
        // CSS inline : attribut style sur le <tr>
        echo "<tr class=\"row\" style=\"background-color:" . $couleur . ";\">";
        echo "<td class=\"serveur\">" . $nom . "</td>";
        echo "<td class=\"cpu\">" . $cpu . "</td>";
        echo "<td class=\"ram\">" . $ram . "</td>";
        echo "<td class=\"status\">" . $statusTexte . "</td>";
        echo "<td class=\"score\">" . $score . "</td>";
        echo "<td class=\"etat\">" . $etat . "</td>";
        echo "</tr>";
    }

    // count() : nombre d'éléments d'un tableau (vu dans le slide 65)
    $moyenneScores = $sommeScores / count($serveurs);
?>
    </table>

    <h3>Résumé</h3>
    <!-- Valeurs du résumé affichées avec echo (slide 25) -->
    <p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
    <p>Score moyen: <span id="moy_scores"><?php echo $moyenneScores; ?></span></p>
    <p>Meilleur serveur: <span id="best_serv"><?php echo $meilleurNom . " (" . $meilleurScore . ")"; ?></span></p>
</body>
</html>
