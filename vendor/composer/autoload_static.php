<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit36c0ec5b52c79b3cfac9000ae4edd52e
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mimey\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mimey\\' => 
        array (
            0 => __DIR__ . '/..' . '/ralouphie/mimey/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit36c0ec5b52c79b3cfac9000ae4edd52e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit36c0ec5b52c79b3cfac9000ae4edd52e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit36c0ec5b52c79b3cfac9000ae4edd52e::$classMap;

        }, null, ClassLoader::class);
    }
}
