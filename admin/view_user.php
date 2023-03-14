<?php
require '../includes/inc-db-connect.php';

// Vérifier si l'ID de l'utilisateur est présent dans l'URL
if (!isset($_GET['id'])) {
    // Rediriger vers la page de la liste des utilisateurs si l'ID n'est pas présent
    header("Location: index.php");
    die();
}

// Récupérer l'ID de l'utilisateur à partir de l'URL
$id = intval($_GET['id']); //la ligne $id = intval($_GET['id']); permet de récupérer l'ID de l'utilisateur et de le convertir en entier. Cela permet de s'assurer que l'ID est bien un nombre entier et évite les injections SQL.

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

// Afficher les informations de l'utilisateur
echo "<h1>Dossier de l'utilisateur " . $user['prenom_utilisateur'] . " " . $user['nom_utilisateur'] . "</h1>"; ?>
<button onclick="location.href='index.php'">Retour à la liste des utilisateurs</button>
<?php
echo "<table>";
echo "<tr><td>Nom :</td><td>" . $user['nom_utilisateur'] . "</td></tr>";
echo "<tr><td>Prénom :</td><td>" . $user['prenom_utilisateur'] . "</td></tr>";
echo "<tr><td>Email :</td><td>" . $user['email_utilisateur'] . "</td></tr>";
echo "<tr><td>telephone :</td><td>" . $user['date_naissance'] . "</td></tr>";
echo "</table>";

// Ajouter des liens pour modifier ou supprimer l'utilisateur
echo "<p><a href='edit_user.php?id=" . $user['id_utilisateur'] . "'>Modifier</a> | <a href='delete_user.php?id=" . $user['id_utilisateur'] . "'>Supprimer</a></p>";
?>
<button onclick="location.href='absences/view_absence.php?id=<?php echo $user['id_utilisateur']; ?>'">absences</button>
<button onclick="location.href='retards/index.php?id=<?php echo $user['id_utilisateur']; ?>'">retards</button>