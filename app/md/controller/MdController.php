<?php
/**
 * Created by PhpStorm.
 * User: skboy
 * Date: 2018/7/10
 * Time: 9:49
 */

namespace app\md\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use app\md\model\ModelStoreModel;

class MdController extends AdminBaseController
{

    public function md_list()
    {
        $Model = new ModelStoreModel();
        $data = $Model->with('user')->order('update_time desc')->paginate(20);


        $this->assign('data', $data->items());
        $this->assign('page', $data->render());
        return $this->fetch('index');
    }

    public function add()
    {

        return $this->fetch();
    }

    public function addPost()
    {

        $post = $this->request->post();
        if (!isset($post['file_urls'])){
            $this->error('文件附件不能为空');
        }
        $data['title'] = $post['title'];
        $data['avatar'] = $post['avatar'];

        $data['model'] = $post['file_urls'][0];
        $data['model_name'] = $post['file_names'][0];
        $data['author'] = $session_admin_id = session('ADMIN_ID');
        $data['create_time'] = time();
        $data['update_time'] = time();

        Db::name('model_store')->insert($data);
        //dump($post);exit;
        $this->success('添加成功!', url('md_list'));
    }

    public function edit()
    {
        $model_id = $this->request->param('id', 0, 'intval');
        $Model = new ModelStoreModel();
        $model = $Model->find($model_id);
        $this->assign('model', $model);
        //dd($model->toArray());
        return $this->fetch();
    }

    public function editPost()
    {

        $post = $this->request->post();
        if (!isset($post['file_urls'])){
            $this->error('文件附件不能为空');
        }
        $data['title'] = $post['title'];
        $data['avatar'] = $post['avatar'];
        $data['model'] = $post['file_urls'][0];
        $data['model_name'] = $post['file_names'][0];
        $data['update_time'] = time();
        $res = Db::name('model_store')->where(['id' => $post['id']])->update($data);
        if ($res === false) {
            $this->error('修改失败!', url('md_list'));
        } else {
            $this->success('修改成功!', url('md_list'));
        }

    }

    public function delete()
    {
        $model_id = $this->request->param('id', 0, 'intval');
        $res = Db::name('model_store')->where(['id' => $model_id])->delete();
        if ($res === false) {
            $this->error('删除失败!');
        } else {
            $this->success('删除成功!');
        }
    }
}
