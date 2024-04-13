<?php

// Load the initialization script that sets up autoloaders and basic configuration
require_once '../app/core/init.php';

// Load routes configuration
require_once '../app/core/routes.php';

// Load environment variables from .env file for configuration
$env = parse_ini_file('../.env');

// Load application configurations
require '../app/core/config.php';

// Import necessary classes
use app\core\Router;

// Load helper functions specific to Vite and asset handling
require_once __DIR__ . '/helpers.php';

// Initialize the router with predefined routes from routes.php
$router = new Router($routes);

// Serve the current route based on request
$router->serveRoute();
?>
