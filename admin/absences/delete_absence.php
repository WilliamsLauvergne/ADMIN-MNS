<?php
require '../includes/inc-db-connect.php';

// Vérifier si l'ID de l'absence est présent dans l'URL
if (!isset($_GET['id'])) {
    // Rediriger vers la page de la liste des absences si l'ID n'est pas présent
    header("Location: view_absence.php");
    die();
}

// Récupérer l'ID de l'absence à partir de l'URL
$absence_id = intval($_GET['id']);

// Requête SQL pour récupérer les informations de l'absence sélectionnée
$sql = "SELECT * FROM absences WHERE id_absence = :id";
$query = $dbh->prepare($sql);
$query->execute(['id' => $absence_id]);
$absence = $query->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'absence existe dans la base de données
if (!$absence) {
    // Rediriger vers la page de la liste des absences si l'absence n'existe pas
    header("Location: view_absence.php");
    die();
}

// Si l'utilisateur confirme la suppression, supprimer l'utilisateur de la base de données
if (isset($_POST['supprimer'])) {
    // Requête SQL pour supprimer l'absence
    $sql = "DELETE FROM absences WHERE id_absence = :id";
    $query = $dbh->prepare($sql);
    $query->execute(['id' => $absence_id]);

    // Rediriger vers la page de la liste des absences
    header("Location: view_absence.php");
    die();
}
?>

<h1>Supprimer une absence</h1>

<p>Voulez-vous vraiment supprimer l'absence du <?php echo $absence['date_debut_absence']; ?> au <?php echo $absence['date_fin_absence']; ?> pour le motif "<?php echo $absence['motif']; ?>" ?</p>

<form method="post">
    <input type="submit" name="supprimer" value="supprimer">
    <button type="button" onclick="history.back()">Annuler</button>
</form>