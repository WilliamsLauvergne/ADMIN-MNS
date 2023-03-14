<?php
require '../includes/inc-db-connect.php';

$sql = "SELECT * FROM utilisateur";
$result = $dbh->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Liste des utilisateurs</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border: 1px solid black;
        }

        th {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1>Liste des utilisateurs</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php while ($user = $result->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $user['id_utilisateur']; ?></td>
                <td><?php echo $user['nom_utilisateur']; ?></td>
                <td><?php echo $user['prenom_utilisateur']; ?></td>
                <td><?php echo $user['email_utilisateur']; ?></td>
                <td>
                    <a href='view_user.php?id=<?php echo $user['id_utilisateur']; ?>'>voir dossier</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href='new_user.php'>Ajouter un utilisateur</a></p>
</body>

</html>