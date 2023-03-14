<h1>Gestion des retard</h1>
<?php
require '../includes/inc-db-connect.php';

// Vérifier si l'ID de l'utilisateur est présent dans l'URL
if (!isset($_GET['id'])) {
    // Rediriger vers la page de la liste des utilisateurs si l'ID n'est pas présent
    header("Location: view_user.php");
    die();
}

// Récupérer l'ID de l'utilisateur à partir de l'URL
$user_id = intval($_GET['id']);

// Requête SQL pour récupérer les informations de l'utilisateur sélectionné
$sql = "SELECT * FROM utilisateur WHERE id_utilisateur = :id";
$query = $dbh->prepare($sql);
$query->execute(['id' => $user_id]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe dans la base de données
if (!$user) {
    // Rediriger vers la page de la liste des utilisateurs si l'utilisateur n'existe pas
    header("Location: ./index.php");
    die();
}

// Requête SQL pour récupérer les absences de l'utilisateur sélectionné
$sql = "SELECT * FROM retards WHERE id_utilisateur = :user_id ORDER BY date_retard DESC";
$query = $dbh->prepare($sql);
$query->execute(['user_id' => $user_id]);
$retards = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Retards de <?php echo $user['prenom_utilisateur'] . " " . $user['nom_utilisateur']; ?></h1>

<?php if (empty($retards)) : ?>
    <p>Aucun retard enregistré pour cet utilisateur.</p>
<?php else : ?>
    <table>
        <thead>
            <tr>
                <th>Date de retard</th>
                <th>Motif</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($retards as $retard) : ?>
                <tr>
                    <td><?php echo $retard['date_retard']; ?></td>
                    <td><?php echo $retard['motif']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<button onclick="location.href='new_retards.php?id=<?php echo $user['id_utilisateur']; ?>'">ajouter un retard</button>
<button onclick="location.href='../view_user.php?id=<?php echo $user_id; ?>'">Retour à la page de l'utilisateur</button>