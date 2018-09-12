<?php
#@author 1043744868zxg@gmail.com

namespace App\Repositories;

use App\Models\Area as AreaModel;

class AreaList extends BaseList
{
    public static $model = AreaModel::class;

    public static function getTree()
    {
        $list = new static();
        $list->province();
        $list->all();
        $list->load([
            'children.children'
        ]);
        return $list;
    }

    public static function getNewTree()
    {
        $list = new static();
        $areaRights = SysConfig::getValueByKey('area');
        $list->where('level',2)->whereIn('id',\GuzzleHttp\json_decode($areaRights->data->value,true))->orderBy('areaname','Chinese_PRC_CI_AI_KI_WI');
        $list->all();
        $list->load([
            'children'
        ]);
        return $list;
    }

    public function forNewMat()
    {
        $re = [];
        foreach($this->getItems() as $v){
            $data = [
                'value'=>$v->id,
                'text'=>$v->areaname,
            ];
            foreach($v->children as $value){
                $data['children'][] = [
                    'value'=>$value->id,
                    'text'=>$value->areaname
                ];
            }
            $re[] = $data;
        }
        return $re;
    }

    public function format()
    {
        $re = [];
        foreach ($this->getItems() as $v) {
            $data = [
                'value' => $v->id,
                'text' => $v->areaname,
            ];
            foreach ($v->children as $child) {
                $c = [];
                    foreach ($child->children as $value) {
                        $c[] = [
                            'value' => $value->id,
                            'text' => $value->areaname,
                        ];
                    }

                if ($c) {
                    $data['children'][] = [
                        'value' => $child->id,
                        'text' => $child->areaname,
                        'children' => $c
                    ];
                } else {
                    $data['children'][] = [
                        'value' => $child->id,
                        'text' => $child->areaname,
                    ];

                }
            }
            $re[] = $data;
        }
        return $re;
    }

    //获取省
    public function province()
    {
        $this->getBuilder()->where('level', 1);
        return $this;
    }
}