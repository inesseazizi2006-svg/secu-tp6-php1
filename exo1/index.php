<!DOCTYPE html>
<!-- Page HTML mélangée avec du PHP (vu dans les slides 27 et 58) -->
<html>
<head>
    <meta charset="UTF-8">
    <title>Exercice 1 - Etudiants-Note</title>
</head>
<body>
<?php
    // Début d'un script PHP : <?php ... ?> (vu dans le slide 58)
    // Chaque instruction se termine par un point-virgule (vu dans le slide 59)

    // Déclaration d'un tableau associatif : clé = nom de l'étudiant, valeur = moyenne
    // (vu dans le slide 64 : Les Tableaux Associatifs)
    $etudiantsNote = array(
        'JOHN'   => 9,
        'BOB'    => 15.5,
        'RAYANE' => 7,
        'ROSIE'  => 13
    );

    // Déclaration d'une fonction avec paramètre et retour (vu dans le slide 71)
    // Elle vérifie si la note est supérieure ou égale à 10
    function estAdmissible($note) {
        // Opérateur relationnel >= (vu dans le slide 66)
        // Le résultat est un booléen (true/false) (vu dans le slide 60)
        return $note >= 10;
    }

    // Couleurs imposées (variables, vu dans le slide 60)
    $rouge = "rgb(251,173,173)";
    $vert  = "rgb(136,248,136)";
?>

    <!-- Tableau HTML : id="table1" et border="1" -->
    <table id="table1" border="1">
        <tr>
            <th>Etudiant</th>
            <th>Note</th>
        </tr>
<?php
    // Boucle foreach sur un tableau associatif : clé => valeur (vu dans le slide 69)
    foreach ($etudiantsNote as $etudiant => $note) {

        // Condition if / else (vu dans le slide 67)
        // Appel de la fonction estAdmissible (vu dans le slide 71)
        if (estAdmissible($note)) {
            $couleur = $vert;   // admissible -> vert
        } else {
            $couleur = $rouge;  // non admissible -> rouge
        }

        // Génération dynamique des lignes <tr> avec echo (vu dans les slides 25, 27 et 28)
        // Concaténation avec le point (.) (vu dans le slide 60)
        // CSS inline : attribut style
        echo "<tr class=\"row\">";
        echo "<td class=\"etud\">" . $etudiant . "</td>";
        echo "<td class=\"note\" style=\"background-color:" . $couleur . ";\">" . $note . "</td>";
        echo "</tr>";
    }
?>
    </table>
</body>
</html>
