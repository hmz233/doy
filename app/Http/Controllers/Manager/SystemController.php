<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/12/18
 * Time: 17:44
 */

namespace App\Http\Controllers\Manager;


use App\Repositories\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function edit(Request $request)
    {
        $system = System::initById(1);
        if ($request->isMethod('POST')) {
            $data = $this->validate(
                $this->request,
                [
                    'title' => '',
                    'internet_number' => '',
                    'intro' => '',
                    'service_tel' => '',
                    'service_qq' => '',
                    'email' => 'nullable|email',
                    'logo_id'=>'',
                ],
                [
                    'email.email'=>'请输入正确的邮箱格式',
                ]
            );
            $system->save($data);
            return $this->returnJson();
        }
        $data = [
            'info' => $system
        ];
        return view('manager.system.edit', $data);
    }

}