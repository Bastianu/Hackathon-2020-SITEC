<?php

define("DB_CFG", array(
    'HOST'     => "localhost",
    'DB_NAME'  => "SITEC",
    'USER'     => "root",
    'PASSWORD' => ""
));

define("PHPMAILER_CFG", array(
    'HOST' => "smtp.gmail.com",
    'PORT' => 587,
    'USER' => "equipe8.hackaton2020@gmail.com",
    'PASS' => "hackaton2020"
));

define("TWIG_CFG", array(
    'dev' => array(
        'cache' => false,
        'autoescape' => "html",
        'debug'=>true
    ),
    'prod' => array(
        'cache' => "cache",
        'autoescape' => "html",
        'debug'=>false
    )
));