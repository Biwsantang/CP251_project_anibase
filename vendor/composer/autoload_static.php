<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb11587d44fdc8ee325fbd74898eee705
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mermshaus\\CRC\\Tests\\' => 20,
            'mermshaus\\CRC\\' => 14,
        ),
        'K' => 
        array (
            'KS\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mermshaus\\CRC\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/kittinan/php-crc/tests',
        ),
        'mermshaus\\CRC\\' => 
        array (
            0 => __DIR__ . '/..' . '/kittinan/php-crc/src',
        ),
        'KS\\' => 
        array (
            0 => __DIR__ . '/..' . '/kittinan/php-promptpay-qr/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'BaconQrCode' => 
            array (
                0 => __DIR__ . '/..' . '/bacon/bacon-qr-code/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb11587d44fdc8ee325fbd74898eee705::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb11587d44fdc8ee325fbd74898eee705::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitb11587d44fdc8ee325fbd74898eee705::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
