<?php
$user = $sgbd->request("SELECT * FROM user WHERE email=?",array($_SESSION["user"]["email"]))[0];

if(isset($_POST["updateUser"])){
   
    $firstname = (isset($_POST['firstname']) && $_POST['firstname']!="") ? $_POST['firstname'] : $user["firstname"];
    $lastname = (isset($_POST['lastname']) && $_POST['lastname']!="") ? $_POST['lastname'] : $user["lastname"];
    $email = (isset($_POST['email']) && $_POST['email']!="") ? $_POST['email'] : $user["email"];

    $sgbd->request("UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE email=?", array($_SESSION["user"]["email"]) );

    header("refresh:0");    
}

$pageContent = array('user' => $user);