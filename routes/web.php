<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    ['prefix' => 'file'],
    function () {
        Route::post('upload-img', 'FileController@uploadImg')->name('uploadImg');
        Route::post('upload-imgs', 'FileController@uploadImgs')->name('uploadImgs');
        Route::any('weixinImgUpload', 'FileController@wexinUpload')->name('weixinImgUpload');
    }
);

//提示页
Route::get('tips', 'TipsController@index')->name('tips');

Route::group(
    ['prefix' => 'manager', 'namespace' => 'Manager'],
    function () {
        Route::any('login', 'AccountController@showLoginForm')->name('login');//登录
        Route::group(
            ['middleware' => 'auth:manager'],
            function () {
                Route::get('', 'IndexController@index')->name('manager');
                Route::any('work', 'IndexController@work')->name('work');

                Route::group(
                    ['middleware' => 'authority'],
                    function () {
                        //管理员
                        Route::group(
                            ['prefix' => 'manager'],
                            function () {
                                Route::any('', 'ManagerController@lists')->name('managerList');
                                Route::any('add', 'ManagerController@add')->name('managerAdd');
                                Route::any('{id}/eit', 'ManagerController@edit')->name('managerEdit');
                                Route::delete('{id}', 'ManagerController@delete')->name('managerDel');
                                Route::get('{id}/handel', 'ManagerController@handle')->name('managerHandle');
                            }
                        );

                        //权限组管理
                        Route::group(
                            ['prefix' => 'authority'],
                            function () {
                                Route::any('', 'AuthorityController@lists')->name('authorityList');
                                Route::any('add', 'AuthorityController@add')->name('authorityAdd');
                                Route::any('{id}/eit', 'AuthorityController@edit')->name('authorityEdit');
                                Route::delete('{id}', 'AuthorityController@delete')->name('authorityDel');
                                Route::get('{id}/handel', 'AuthorityController@handle')->name('authorityHandle');
                                Route::any('{groupId}/authority', 'AuthorityController@authority')->name('authority');
                            }
                        );

                        //成员管理
                        Route::group(
                            ['prefix' => 'doyUser'],
                            function () {
                                Route::any('', 'DoyUserController@lists')->name('doyUserList');
                                Route::any('doyUserAdd', 'DoyUserController@add')->name('doyUserAdd');
                            }
                        );
                    }
                );

                //系统设置
                Route::group(
                    ['prefix' => 'system'],
                    function () {
                        Route::any('', 'SystemController@edit')->name('system');
                    }
                );
                //退出登陆
                Route::group(
                    ['prefix' => 'account'],
                    function () {
                        Route::get('logout', 'AccountController@logout')->name('manageLogout');
                        Route::any('changePassword', 'AccountController@changePassword')->name('changePassword');
                    }
                );
            }
        );
    }
);
//Route::get('/', function () {
//    return view('welcome');
//});
