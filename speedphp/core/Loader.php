<?php

namespace speedphp\core;

class Loader
{
    // 类名映射
    protected static $map = [];

    // 自动加载
    public static function autoload($class)
    {
        if (!empty(self::$map[$class])) {
            // 类库映射
            return self::$map[$class];
        }
        $file = ROOT_PATH . str_replace('\\', '/', $class) . EXT;
        include $file;
        self::$map[$class] = $class;
    }

    // 注册自动加载机制
    public static function register($autoload = '')
    {
        // 注册系统自动加载
        spl_autoload_register('speedphp\core\Loader::autoload', true, true);

    }
}