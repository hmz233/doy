<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/24
 * Time: 14:51
 */

namespace App\Http\Controllers\Manager;

use App\Repositories\Authority;
use App\Repositories\AuthorityList;
use App\Http\Controllers\Authority as Authority2;
use App\Repositories\ManagerList;
use Illuminate\Http\Request;

class AuthorityController extends Controller
{

    public function lists(Request $request)
    {
        $list = new AuthorityList();

        if ($request->get('keyword')) {
            $list->keyword($request->get('keyword'));
        }

        $list->paginate();
        $data = [
            'list' => $list->getItems(),
        ];

        return view('manager.authority.list', $data);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $this->validate(
                $request,
                [
                    'name' => 'required',
                    'spk' => ''
                ]
            );
            $department = Authority::create($data);
            $department->save();

            return redirect()->route('authorityList')->withErrors(['success'=>'添加成功！']);
        }

        return view('manager.authority.add');
    }

    public function edit(Request $request, $id)
    {
        $Authority = Authority::initById($id);
        if ($request->isMethod('post')) {
            $data = $this->validate(
                $request,
                [
                    'name' => 'required',
                    'spk' => '',
                ]
            );
            $Authority->fill($data);
            $Authority->save();
            return redirect()->route('authorityList')->withErrors(['success'=>'编辑成功！']);
        }
        $data = [
            'info' => $Authority,
        ];

        return view('manager.authority.edit', $data);
    }

    public function delete($id)
    {
        $department = Authority::initById($id);
        $managerList = ManagerList::getAll(['group_id'=>$id]);
        if($managerList->getItems()->count()){
            return $this->returnJson(-1,'有管理员被分配到该权限组,不可删除');
        }
        $department->delete();
        return $this->returnJson(1, '删除成功');
    }

    public function authority(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $autho = $request->input('id');
            if ($autho) {
                $autho = implode(',', $autho);
            }
            $group = Authority::initById($id);
            $group->fill(['autho' => $autho]);
            $group->save();

            return redirect()->route('authorityList');
        }
        $data = [
            'menuList' => Authority2::getMenuAll(),
            'userMenu' => Authority::getAuth($id)
        ];
        return view('manager.authority.authority', $data);
    }
}
