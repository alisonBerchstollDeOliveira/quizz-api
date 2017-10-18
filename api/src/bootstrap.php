<?php

//-- Importa el framework silex
require_once (BASE_DIR . '/vendor/silex.phar');

//-- Importamos redbeanphp
require_once (BASE_DIR . '/vendor/rb.php');

//-- Crea una nueva aplicación silex
$app = new Silex\Application();

//-- Setup database access by redbeanphp
R::setup(HOST,USER,PASS);
//R::setup("mysql:host=localhost;dbname=quizz","root","");
//R::setup("mysql:host=johnny.heliohost.org;dbname=alisonde_quizz","alisonde_admin","admin");
//to sqlite storage
 //R::setup( 'sqlite:alisonde.heliohost.org/Quizz.db' );
