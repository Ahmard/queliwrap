<?php
use Queliwrap\Client;
require('vendor/autoload.php');
require('src/Helpers/CookieHelper.php');
require('src/TheClient.php');
require('src/Client.php');

/*
Request::withCookie()
    ->redirects(function($wrp){
        $wrp->max(5);
        $wrp->strict();
        $wrp->referer('http://goo.gl');
        $wrp->protocol('http');
        $wrp->trackRedirects();
        $wrp->onRedirect(function(){
            echo "Redirection detected!";
        });
    });
*/

Request::get('https://google.com')
    ->auth('ahmard', '1234')
    ->body()
    ->connectTimeout(2)
    ->debug()
    ->forceIPResolve()
    ->exec();