<?php

declare (strict_types = 1);

session_start();

require 'config.php';

//Load Composer
require ROOT . '/vendor/autoload.php';

//Load Core functions
require ROOT . '/core/functions/file.php';
require ROOT . '/core/functions/form/core.php';
require ROOT . '/core/functions/html/generators.php';

//Load App Functions
require ROOT . '/app/functions/form/validators.php';

$app = new App\App();