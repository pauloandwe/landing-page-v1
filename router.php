<?php
$routes = [
    '/' => 'home',
    '/home' => 'home',
    '/quem-somos' => 'quem-somos',
    '/produtos' => 'produtos',
    '/contato' => 'contato',
    '/loja' => 'loja'
];

$request_uri = $_SERVER['REQUEST_URI'];

$request_uri = strtok($request_uri, '?');

if ($request_uri != '/' && substr($request_uri, -1) == '/') {
    $request_uri = rtrim($request_uri, '/');
}

$base_path = dirname($_SERVER['SCRIPT_NAME']);

if ($base_path !== '/') {
    $request_uri = str_replace($base_path, '', $request_uri);
    if ($request_uri === '') {
        $request_uri = '/';
    }
}

if (array_key_exists($request_uri, $routes)) {
    $page = $routes[$request_uri];
} else {
    $page = '404';
}

require_once 'layout.php';