<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/2
 * Time: 14:36
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;

class Authority extends Controller
{

    public static function getUserMenu($userAuth = [])
    {
        $allMenu = static::getMenuAll();
        $menuArray = [];
        //超级管理员
        if ($userAuth == '*') {
            //循环管理组
            foreach ($allMenu as $key => $vo) {
                //如果该管理组在用户权限中 则循环该管理组下面的菜单栏
                if (array_key_exists('_child', $vo)) {
                    foreach ($vo['_child'] as $k => $v) {
                        $menuArray[] = $v['url'];
                        if (array_key_exists('_child', $v)) {
                            foreach ($v['_child'] as $k0 => $v0) {
                                    $menuArray[] = $v0['url'];
                            }
                        }

                    }
                }
            }
            Session::put('menuArray', $menuArray);
            return $allMenu;
        }
        //循环管理组
        foreach ($allMenu as $key => $vo) {
            //如果该管理组在用户权限中 则循环该管理组下面的菜单栏
            if (in_array($key, $userAuth)) {
                if (array_key_exists('_child', $vo)) {
                    foreach ($vo['_child'] as $k => $v) {
                        //如果用户拥有这个菜单栏的权限 则循环执行是否有该菜单的增删改查
                        if (in_array($k, $userAuth)) {
                            $menuArray[] = $v['url'];
                            if (array_key_exists('_child', $v)) {
                                foreach ($v['_child'] as $k0 => $v0) {
                                    //不存在该功能权限 则移除
                                    if (!in_array($k0, $userAuth)) {
                                        unset($allMenu[$key]['_child'][$k]['_child'][$k0]);
                                    } else {
                                        $menuArray[] = $v0['url'];
                                    }
                                }
                            }
                        } else {
                            //用户没有这个菜单栏的权限 则移除这个菜单栏
                            unset($allMenu[$key]['_child'][$k]);
                        }
                    }
                }
            } else {
                //用户没有这个管理组权限 则移除这个数组
                unset($allMenu[$key]);
            }
        }
        Session::put('menuArray', $menuArray);

        return $allMenu;
    }

    /**
     * 获取全部菜单
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function getMenuAll()
    {
        return config('authority.menu');
    }

    public static function chekMenu($route)
    {
        $menuArrar = Session::get('menuArray');
        if ($menuArrar) {
            if (!in_array($route, $menuArrar)) {
                return true;
            }
        } else {
            return true;
        }
    }
}
