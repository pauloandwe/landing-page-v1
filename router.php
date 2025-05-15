<?php
// Define as rotas disponíveis
$routes = [
    '/' => 'home',
    '/home' => 'home',
    '/quem-somos' => 'quem-somos',
    '/produtos' => 'produtos',
    '/contato' => 'contato',
    '/loja' => 'loja'
];

// Pegar a URL atual
$request_uri = $_SERVER['REQUEST_URI'];

// Remover parâmetros de consulta da URL se existirem
$request_uri = strtok($request_uri, '?');

// Remover trailing slash se não for a rota raiz
if ($request_uri != '/' && substr($request_uri, -1) == '/') {
    $request_uri = rtrim($request_uri, '/');
}

// Obter o caminho base da aplicação
$base_path = dirname($_SERVER['SCRIPT_NAME']);

// Se o caminho base não for apenas '/', remova-o da URI
if ($base_path !== '/') {
    $request_uri = str_replace($base_path, '', $request_uri);
    // Se depois de remover o caminho base a URI estiver vazia, defina-a como '/'
    if ($request_uri === '') {
        $request_uri = '/';
    }
}

// Verificar se a rota existe
if (array_key_exists($request_uri, $routes)) {
    $page = $routes[$request_uri];
} else {
    // Rota não encontrada - redireciona para página 404 ou home
    $page = '404';
    // Alternativa: redirecionar para home
    // header('Location: /');
    // exit;
}

// Incluir o layout que conterá o container com navbar e footer
require_once 'layout.php';