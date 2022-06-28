<?php
require "../vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new App\Router();

$router
    ->get('/','accueil','accueil')
    ->match('/types','types','types')
    ->get('/type/[i:id]','type','type')
    ->post('/note','note','note')
    ->get('/activite','activite','activite')
    ->match('/client','client','client')
    ->match('/contact','contact','contact')
    ->match('/inscription','inscription','inscription')
    ->match('/connexion','connexion','connexion')
    ->match('/connexionAdmin','admin/connexionAdmin','connexionAdmin')
    ->match('/deconnexion','deconnexion','deconnexion')
    ->match('/reservation','reservation','reservation')
    ->get('/annuler/[i:id]','annuler','annuler')
    ->match('/addons','addons','addons')
    ->match('/recapitulatif','recapitulatif','recap')
    ->get('/admin','admin/admin','admin')
    ->get('/admin/clients','admin/clients','admin_clients')
    ->get('/admin/reservations','admin/reservations','admin_reservations')
    ->get('/admin/messages','admin/messages','admin_messages')
    ->match('/admin/chambres','admin/chambres','admin_chambres')
    ->run();
