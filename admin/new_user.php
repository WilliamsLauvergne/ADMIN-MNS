<?php
require '../includes/inc-db-connect.php';

// Si le formulaire a été soumis, ajouter l'utilisateur à la base de données
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_naissance = $_POST['date_naissance'];

    // Requête SQL pour ajouter un nouvel utilisateur dans la base de données
    $sql = "INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, email_utilisateur, date_naissance) VALUES (:nom, :prenom, :email, :date_naissance)";
    $query = $dbh->prepare($sql);
    $query->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'date_naissance' => $date_naissance]);

    // Rediriger vers la page de la liste des utilisateurs
    header("Location: index.php");
    die();
}
?>

<h1>Ajouter un nouvel utilisateur</h1>
<button onclick="location.href='index.php'">Retour à la liste des utilisateurs</button>
<form method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom"><br>
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom"><br>
    <label for="email">Email :</label>
    <input type="email" name="email" id="email"><br>
    <label for="date_naissance">Date de naissance :</label>
    <input type="date" name="date_naissance" id="date_naissance"><br>
    <input type="submit" name="submit" value="submit">
</form>