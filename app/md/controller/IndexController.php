<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\md\controller;

use cmf\controller\HomeBaseController;
use think\Db;
use app\md\model\ModelStoreModel;
class IndexController extends HomeBaseController
{
    public function index()
    {
        $keyword= $this->request->param('keyword','');
        if ($keyword!=''){
            $where['title']=['like',"%$keyword%"];
        }else{
            $where['id']=['neq',0];
        }
        $Model = new ModelStoreModel();
        $data = $Model->with('user')->where($where)->order('update_time desc')->paginate(20);
        $this->assign('data', $data->items());
        $this->assign('page', $data->render());
        return $this->fetch(':index');
    }
}
