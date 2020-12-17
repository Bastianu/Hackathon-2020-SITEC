<?php

$alert = "";

if(isset($_POST['email']) && isset($_POST['passwd'])) {
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $user = $sgbd->request(
            "SELECT * FROM user WHERE email=?",
            array($_POST['email'])
        )[0];

        if(!empty($user) && password_verify($_POST['passwd'], $user['passwd'])) {
            unset($user['passwd']);
            $_SESSION['user'] = $user;
            header("Refresh:0");
        } else {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Authentification impossible.<br>Merci de vérifier les informations saisie.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    } else {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            L\'adresse E-mail spécifié est invalide.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

$pageContent = array(
    'form' => $_POST,
    'alert' => $alert
);