<?php
use Proxy\Proxy;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Laminas\Diactoros\ServerRequestFactory;
require_once __DIR__."/vendor/autoload.php";
$forward = require_once __DIR__."/forward.php";
$request = ServerRequestFactory::fromGlobals();
$guzzle = new GuzzleHttp\Client();
$proxy = new Proxy(new GuzzleAdapter($guzzle));
$proxy->filter(new RemoveEncodingFilter());
$uri = $request->getUri();
$path = $uri->getPath();
$host = $uri->getHost();
$to = $forward[$host];
try {
    $response = $proxy->forward($request)->to($to);
    ob_start();
    (new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
    $output = ob_get_contents(); 
    ob_end_clean();
    echo $output;
    return;
    if($path == "/"){
        echo '<script src="/inject.js"></script>';
        echo '<link rel="stylesheet" type="text/css" href="/css.css">';
    }
} catch(\GuzzleHttp\Exception\BadResponseException $e) {
    (new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($e->getResponse());
}