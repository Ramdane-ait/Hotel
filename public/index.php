<?php
require "../vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new App\Router();

$router
    ->get('/','accueil','accueil')
    ->get('/chambres','chambres','chambres')
    ->match('/contact','contact','contact')
    ->match('/inscription','inscription','inscription')
    ->match('/connexion','connexion','connexion')
    ->match('/connexionAdmin','admin/connexionAdmin','connexionAdmin')
    ->match('/deconnexion','deconnexion','deconnexion')
    ->get('/admin','admin/admin','admin')
    ->match('/reservation','reservation','reservation')
    ->match('/paiement','paiement','paiement')
    ->match('/recapitulatif','recapitulatif','recap')
    ->match('/admin/ajouter','admin/ajouter','nouvelle_chambre')
    ->match('/admin/modifier/[i:id]','/admin/modifier','modifier_chambre')
    ->get('/admin/supprimer/[i:id]','/admin/supprimer','supprimer_chambre')
    ->run();
