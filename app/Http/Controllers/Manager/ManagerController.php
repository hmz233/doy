<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/21
 * Time: 15:30
 */

namespace App\Http\Controllers\Manager;


use App\Repositories\AuthorityList;
use App\Repositories\Manager;
use App\Repositories\ManagerList;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function lists(Request $request)
    {
        $lists = new ManagerList();
        if ($request->get('keyword')) {
            $lists->keyword($request->get('keyword'));
        }

        $lists->paginate();
        $lists->load('auditingInfo');
        $data = [
            'list' => $lists->getItems()
        ];

        return view('manager.manager.list', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $this->validate(
                $request,
                [
                    'name' => 'required',
                    'username' => 'required|min:6|regex:/^[0-9a-zA-Z]+$/',
                    'password' => 'required|min:6|regex:/^[0-9a-zA-Z]+$/|confirmed',
                    'group_id' => 'required',
                ],
                [
                    'name.required'=>'请填写管理员姓名',
                    'username.required'=>'请填写登录账号',
                    'username.regex'=>'登录账号只能是字母或者数字',
                    'username.min'=>'登录账号最少为6位',
                    'password.required'=>'请填写登录密码',
                    'password.regex'=>'登录密码只能是字母或者数字',
                    'password.confirmed'=>'两次密码不一致',
                    'password.min'=>'登录密码最少为6位',
                    'group_id.required'=>'请选择权限组'
                ]
            );
            $data['auditing_id'] = $this->getManager()->id;
            $manage = Manager::create($data);
            $manage->setPassword($data['password']);
            $manage->save();
            return redirect()->route('managerList');
        }
        $group = AuthorityList::getAll();
        $data = [
            'groupList' => $group->getItems()
        ];
        return view('manager.manager.add', $data);
    }

    public function edit(Request $request, $id)
    {
        $info = Manager::initById($id);
        if ($request->isMethod('POST')) {
            $data = $this->validate(
                $request,
                [
                    'name' => 'required',
                    'username' => 'required|min:6|regex:/^[0-9a-zA-Z]+$/',
                    'password' => 'required|min:6|regex:/^[0-9a-zA-Z]+$/|confirmed',
                    'group_id' => 'required',
                ],
                [
                    'name.required'=>'请填写管理员姓名',
                    'username.required'=>'请填写登录账号',
                    'username.regex'=>'登录账号只能是字母或者数字',
                    'username.min'=>'登录账号最少为6位',
                    'password.required'=>'请填写登录密码',
                    'password.regex'=>'登录密码只能是字母或者数字',
                    'password.confirmed'=>'两次密码不一致',
                    'password.min'=>'登录密码最少为6位',
                    'group_id.required'=>'请选择权限组'
                ]
            );
            $data['auditing_id'] = $this->getManager()->id;
            if ($data['password']) {
                $info->setPassword($data['password']);
            } else {
                unset($data['password']);
            }
            $info->fill($data);
            $info->save();
            return redirect()->route('managerList');
        }
        $group = AuthorityList::getAll();
        $data = [
            'info' => $info,
            'groupList' => $group->getItems()
        ];

        return view('manager.manager.edit', $data);
    }


    public function delete($id)
    {
        $Manager = Manager::initById($id);
        $Manager->delete();
        return $this->returnJson(1, '删除成功');
    }

    public function handle($id)
    {
        $Manager = Manager::initById($id);
        $Manager->handle();
        return $this->returnJson(1, '操作成功');
    }

}