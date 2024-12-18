<?php
// Start session at the very beginning
session_start();

// Get controller and action from URL
$controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'auth';
$action = isset($_GET['action']) ? strtolower($_GET['action']) : 'login';

// If user is logged in and trying to access login/register, redirect to dashboard
if (isset($_SESSION['user_id']) && $controller === 'auth' && ($action === 'login' || $action === 'register')) {
    header("Location: index.php?controller=dashboard");
    exit();
}

// If user is not logged in and trying to access protected pages, redirect to login
if (!isset($_SESSION['user_id']) && $controller !== 'auth') {
    header("Location: index.php?controller=auth&action=login");
    exit();
}

$controllerName = ucfirst($controller) . "Controller";
$controllerFile = "controllers/" . $controllerName . ".php";

if(file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    
    if(method_exists($controller, $action)) {
        $controller->$action();
    } else {
        if(method_exists($controller, 'index')) {
            $controller->index();
        } else {
            die("Action not found and no default index action available");
        }
    }
} else {
    die("Controller not found");
} 