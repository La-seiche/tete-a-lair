<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit50ba9bb869ee16033662ec4cff722b8d
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit50ba9bb869ee16033662ec4cff722b8d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit50ba9bb869ee16033662ec4cff722b8d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
