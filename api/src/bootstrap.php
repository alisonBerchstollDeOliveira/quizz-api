<?php

//-- Importa el framework silex
require_once (BASE_DIR . '/vendor/silex.phar');

//-- Importamos redbeanphp
require_once (BASE_DIR . '/vendor/rb.php');

//-- Crea una nueva aplicación silex
$app = new Silex\Application();

//-- Setup database access by redbeanphp
//R::setup(HOST,USER,PASS);
//to sqlite storage
 R::setup( 'sqlite:../api/src/dbfile.db' );
