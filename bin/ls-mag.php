<?php
global $loader;
if ( is_file( $autoload = getcwd() . '/vendor/autoload.php' ) ) {
    /** @noinspection PhpIncludeInspection */
    $loader = require $autoload;
} elseif ( is_file( $autoload = getcwd() . '/../../autoload.php' ) ) {
    /** @noinspection PhpIncludeInspection */
    $loader = require $autoload;
}

if ( is_file( $autoload = __DIR__ . '/../vendor/autoload.php' ) ) {
    /** @noinspection PhpIncludeInspection */
    $loader = require( $autoload );
} elseif ( is_file( $autoload = __DIR__ . '/../../../autoload.php' ) ) {
    /** @noinspection PhpIncludeInspection */
    $loader = require( $autoload );
} else {
    fwrite( STDERR,
            'You must set up the project dependencies, run the following commands:' . PHP_EOL .
            'curl -s http://getcomposer.org/installer | php' . PHP_EOL .
            'php composer.phar install' . PHP_EOL
    );
    exit( 1 );
}

$application = new Ls\Core\Console\Application();
$application->run();
