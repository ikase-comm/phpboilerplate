<?php
/**
 * Public Entry Point
 * Location: /www/index.php
 */

declare(strict_types=1);

// 1. Secure Session Initialization
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_use_only_cookies', '1');
ini_set('session.cookie_secure', '1'); // Enable if your local/live site uses HTTPS

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Load the Application Code (Via Composer or manual fallback)
$autoloader = __DIR__ . '/../vendor/autoload.php';

if (!file_exists($autoloader)) {
    http_response_code(500);
    exit('Run "composer install" or set up PSR-4 autoloading to run this app.');
}

require_once $autoloader;

// 3. Ultra-Lightweight URL Routing Engine
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = rtrim($requestUri, '/') ?: '/'; // Clean slashes

switch ($requestUri) {
    case '/':
        $controller = new App\Controller\HomeController();
        $controller->index();
        break;

    case '/login':
        $controller = new App\Controller\HomeController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->loginSubmit();
        } else {
            $controller->loginView();
        }
        break;

    case '/logout':
        $controller = new App\Controller\HomeController();
        $controller->logout();
        break;

    default:
        // Fallback catch-all for missing pages
        http_response_code(404);
        echo "<h1>404 Page Not Found</h1>";
        break;
}
