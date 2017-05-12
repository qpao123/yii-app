<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb572b8006b60212df2b1217cd0cca3f4
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/workerman',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb572b8006b60212df2b1217cd0cca3f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb572b8006b60212df2b1217cd0cca3f4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
