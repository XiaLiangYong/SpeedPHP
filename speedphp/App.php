<?php
/**
 * Created by PhpStorm.
 * User: xialiangyong
 * Date: 2017/6/9
 * Time: 10:35
 */

namespace speedphp;


class App
{
    /**
     * 执行应用
     */
    public static function run()
    {
        $module = $controller = $action = 'index';
        try {
            if (isset($_SERVER['PATH_INFO'])) {
                $pathInfo = $_SERVER['PATH_INFO'];
                $pathInfo = str_replace('//', '/', $pathInfo);
                $pathinfo_arr = explode('/', $pathInfo);
                $pathinfo_arr = array_values(array_filter($pathinfo_arr));
                $count = count($pathinfo_arr);
                if ($count > 2) {
                    $module = $pathinfo_arr[0];
                    $controller = $pathinfo_arr[1];
                    $action = $pathinfo_arr[2];
                } else if ($count == 2) {
                    $controller = $pathinfo_arr[0];
                    $action = $pathinfo_arr[1];
                }
            }
            $class = '\\app\\' . $module . '\\' . 'controller\\' . $controller;
            $action = 'action' . strtoupper(substr($action, '0', 1)) . substr($action, '1');
            if (is_callable([$class, $action])) {
                call_user_func_array([$class, $action], []);
            } else {
                throw new \Exception('操作不存在');
            }
        } catch (\Exception $e) {
            //统一处理
            echo $e->getMessage();
        }
    }
}