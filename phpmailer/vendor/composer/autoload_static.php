<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit592d812d6785f9d072ef765cb417ea13
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit592d812d6785f9d072ef765cb417ea13::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit592d812d6785f9d072ef765cb417ea13::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit592d812d6785f9d072ef765cb417ea13::$classMap;

        }, null, ClassLoader::class);
    }
}