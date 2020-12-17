<?php

$clients = $sgbd->request("SELECT * FROM user WHERE rol != 'administrateur'");

$pageContent = array(
    'clts' => $clients
);