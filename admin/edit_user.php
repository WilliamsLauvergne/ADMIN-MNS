<?php
require '../includes/inc-db-connect.php';

// Vérifier si l'ID de l'utilisateur est présent dans l'URL
if (!isset($_GET['id'])) {
    // Rediriger vers la page de la liste des utilisateurs si l'ID n'est pas présent
    header("Location: index.php");
    die();
}

// Récupérer l'ID de l'utilisateur à partir de l'URL
$id = intval($_GET['id']);

// Requête SQL pour récupérer les informations de l'utilisateur sélectionné
$sql = "SELECT * FROM utilisateur WHERE id_utilisateur = :id";
$query = $dbh->prepare($sql);
$query->execute(['id' => $id]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe dans la base de données
if (!$user) {
    // Rediriger vers la page de la liste des utilisateurs si l'utilisateur n'existe pas
    header("Location: index.php");
    die();
}

// Si le formulaire a été soumis, mettre à jour les informations de l'utilisateur dans la base de données
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_naissance = $_POST['date_naissance'];

    // Requête SQL pour mettre à jour les informations de l'utilisateur dans la base de données
    $sql = "UPDATE utilisateur SET nom_utilisateur = :nom, prenom_utilisateur = :prenom, email_utilisateur = :email, date_naissance = :date_naissance WHERE id_utilisateur = :id";
    $query = $dbh->prepare($sql);
    $query->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'date_naissance' => $date_naissance, 'id' => $id]);

    // Rediriger vers la page de visualisation de l'utilisateur mis à jour
    header("Location: view_user.php?id=" . $id);
    die();
}
?>

<h1>Modifier l'utilisateur "<?php echo $user['prenom_utilisateur'] . " " . $user['nom_utilisateur']; ?>"</h1>
<button onclick="location.href='view_user.php'">Retour au dossier de l'utilisateur</button>
<form method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?php echo $user['nom_utilisateur']; ?>"><br>
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" value="<?php echo $user['prenom_utilisateur']; ?>"><br>
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" value="<?php echo $user['email_utilisateur']; ?>"><br>
    <label for="date_naissance">Date de naissance :</label>
    <input type="date" name="date_naissance" id="date_naissance" value="<?php echo $user['date_naissance']; ?>"><br>
    <label for="role">Rôle :</label>
    <select name="role" id="role">
        <option value="administratif" <?php if ($user['role'] == 'administratif') echo 'selected'; ?>>Administratif</option>
        <option value="stagiaire" <?php if ($user['role'] == 'stagiaire') echo 'selected'; ?>>Stagiaire</option>
        <option value="candidat" <?php if ($user['role'] == 'candidat') echo 'selected'; ?>>Candidat</option>
    </select><br>
    <input type="submit" name="enregistrer" value="Enregistrer">
</form>