<?php

namespace App\Http\Controllers;

use App\Repositories\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadImg(Request $request)
    {
        $file = $request->allFiles();
        if (($file = reset($file)) == null) {
            return $this->returnJson(-1, '没有文件上传');
        }
        $fielName=$file->getClientOriginalName();
        $files = File::upload($file);

        return $this->returnJson(1, 'ok', ['id' => $files->data->id,'fileName'=>$fielName, 'url' => $files->url(), 'path' => $files->data->path]);
    }


    public function uploadImgs(Request $request)
    {
        $fileList = $request->allFiles();
        if (!$fileList) {
            return $this->returnJson(-1, '没有文件上传');
        }

        $result = [];
        foreach ($fileList as $k => $file) {
            $file = File::upload($file);
            $result[] = [
                'id'  => $file->data->id,
                'url' => $file->data->url,
            ];
        } 

        return $this->returnJson(1, 'ok', $result);
    }
}
