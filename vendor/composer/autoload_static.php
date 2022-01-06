<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit101e49fd88af6a9a20fe8d969ae5ba65
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit101e49fd88af6a9a20fe8d969ae5ba65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit101e49fd88af6a9a20fe8d969ae5ba65::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit101e49fd88af6a9a20fe8d969ae5ba65::$classMap;

        }, null, ClassLoader::class);
    }
}
