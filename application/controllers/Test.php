<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// header("Access-Control-Allow-Origin: *");
function ret($ret, $data = null)
{
    echo json_encode(array("ret" => $ret, "data" => $data), JSON_UNESCAPED_UNICODE);
}

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();              //构造函数里要调用父类的构造方法
        $this->load->model('TestModel');           //引用model层的project_model.php文件

    }

    public function index()
    {
        echo "testtest";
    }

    public function add()
    {
        $name = $this->input->post('name', true);
        $phone = $this->input->post('phone', true);
        $this->TestModel->add($name, $age);
        return ret('200', 'success');

    }

    public function all()
    {
        $res = $this->TestModel->all();
        echo json_encode($res);
    }
}
