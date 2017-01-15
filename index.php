<?php
require('lib/latte/src/latte.php');
require('lib/mongo-php/src/mongo.php');
require('classes/get.php');
require('classes/render.php');

$latte = new Latte\Engine;

$latte->setTempDirectory('temp/cache/latte');

$render = new Render();
$get = new Get();

$parameters=['tree'=>$render->strom(),'widgets'=>'widgets','log'=>'log','form'=>'form'];

$latte->render('templates/index.latte', $parameters);
