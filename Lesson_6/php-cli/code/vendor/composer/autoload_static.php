<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9222b02ebd125285d43f40f8cc1f95c6
{
    public static $files = array (
        '73a76277cdd754516bf94aa9c0aa6bb3' => __DIR__ . '/../..' . '/src/main.function.php',
        '2c30778c83e7cf1ab5d05f6fb053a212' => __DIR__ . '/../..' . '/src/template.function.php',
        '4497162affd5dbda9202a35ac3a5f40d' => __DIR__ . '/../..' . '/src/file.function.php',
        'ea21631de1595c7b0d102daf7532833b' => __DIR__ . '/../..' . '/src/date.function.php',
        'd718addf0b98df84604e42e2e70645d8' => __DIR__ . '/../..' . '/src/name.function.php',
        '233d4aaf2577ca8d4449d44fcc3672b2' => __DIR__ . '/../..' . '/src/search.function.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit9222b02ebd125285d43f40f8cc1f95c6::$classMap;

        }, null, ClassLoader::class);
    }
}
