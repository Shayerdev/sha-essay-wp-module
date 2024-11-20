<?php

/**
 * Plugin Name: Shayer Edu Essay Plugin
 * Description: A brief description of the Plugin.
 * Version: 1.0
 * Author: Shayer Developer
 * Author URI: http://shayerdev.com
 * Requires PHP: 8.1
 */

declare(strict_types=1);

use Shayer\EduEssayPlugin\App;
use Symfony\Component\Config\FileLocator;

require 'bootstrap.php';
include_once ABSPATH . 'wp-admin/includes/plugin.php';

$http = new App\Http();

try {
    $http->run([
        'plugin_file_path' => __FILE__,
        'plugin_dir_path' => plugin_dir_path(__FILE__),
		'plugin_url' => plugin_dir_url(__FILE__),
        'config.services.path' => new FileLocator(__DIR__ . '/config'),
        'config.services.file' => 'services.yaml'
    ]);
} catch (Exception $exception) {
    var_dump($exception);
}
