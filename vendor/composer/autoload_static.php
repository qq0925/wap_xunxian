<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfe69f7a09abff127e59ac3ee20567245
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
        'c4e03ecd470d2a87804979c0a8152284' => __DIR__ . '/..' . '/react/async/src/functions_include.php',
        'cea474b4340aa9fa53661e887a21a316' => __DIR__ . '/..' . '/react/promise-stream/src/functions_include.php',
        '972fda704d680a3a53c68e34e193cb22' => __DIR__ . '/..' . '/react/promise-timer/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'React\\Stream\\' => 13,
            'React\\Socket\\' => 13,
            'React\\Promise\\Timer\\' => 20,
            'React\\Promise\\Stream\\' => 21,
            'React\\Promise\\' => 14,
            'React\\Http\\' => 11,
            'React\\EventLoop\\' => 16,
            'React\\Dns\\' => 10,
            'React\\Cache\\' => 12,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Http\\Message\\' => 17,
            'PhpOffice\\PhpSpreadsheet\\' => 25,
        ),
        'F' => 
        array (
            'Fig\\Http\\Message\\' => 17,
        ),
        'E' => 
        array (
            'Evenement\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'React\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/stream/src',
        ),
        'React\\Socket\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/socket/src',
        ),
        'React\\Promise\\Timer\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise-timer/src',
        ),
        'React\\Promise\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise-stream/src',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'React\\Http\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/http/src',
        ),
        'React\\EventLoop\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/event-loop/src',
        ),
        'React\\Dns\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/dns/src',
        ),
        'React\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/cache/src',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'PhpOffice\\PhpSpreadsheet\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpspreadsheet/src/PhpSpreadsheet',
        ),
        'Fig\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/fig/http-message-util/src',
        ),
        'Evenement\\' => 
        array (
            0 => __DIR__ . '/..' . '/evenement/evenement/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfe69f7a09abff127e59ac3ee20567245::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfe69f7a09abff127e59ac3ee20567245::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfe69f7a09abff127e59ac3ee20567245::$classMap;

        }, null, ClassLoader::class);
    }
}
