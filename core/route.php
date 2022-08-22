<?php

use controllers\HomeController;
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$name = pathinfo($urlPath, PATHINFO_BASENAME);

new HomeController($name);
