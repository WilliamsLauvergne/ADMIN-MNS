<?php
session_start();
include 'includes/inc-top.php';

// Vérification des champs

?>

<div>
    <div>
        <form action="/login-POST.php" method="POST">
            <div>
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= isset($_SESSION['values']['email']) ? $_SESSION['values']['email'] : '' ?>">
                <?php if (isset($_SESSION['errors']['email'])) : ?>
                    <small><?= $_SESSION['errors']['email'] ?></small>
                <?php endif; ?>
            </div>
            <div>
                <label for="exampleInputPassword1">Password</label>
                <input type="password" id="exampleInputPassword1" name="password">
                <?php if (isset($_SESSION['errors']['password'])) : ?>
                    <small><?= $_SESSION['errors']['password'] ?></small>
                <?php endif; ?>
            </div>
            <input type="submit" name="submit" value="Se connecter">
        </form>

        <?php if (isset($_SESSION['error'])) : ?>
            <div>
                <p><?= $_SESSION['error'] ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/inc-bottom.php'; ?>