<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

function res($ret, $data = null)
{
    echo json_encode(array("ret" => $ret, "data" => $data), JSON_UNESCAPED_UNICODE);
}


function adminAuthority()
{

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
        echo "1234";
    }
    
    //添加数据  这个与前端联系，得到前端传来的参数 返回给TestModel

    public function add()
    {
        $name = $this->input->post('name', true);
        $phone = $this->input->post('phone', true);
        // add 为TestModel 的方法名字
        $this->TestModel->add($name, $age);
        return res('200', 'success');

    }

    //查询数据  
    public function all()
    {
        // $res = $this->TestModel->all();
        $res = $this->TestModel->get_all_user();

        echo json_encode($res);
    }
    //登录
    public function login()
    {
        $telephone = $this->input->post('telephone', true);
        $password = $this->input->post('password', true);
        $permissions = $this->input->post('permissions', true);
        $res = $this->TestModel->login($telephone, $password,$permissions);

        // echo json_encode($res);

        if (count($res)) {
            res("200", array("msg" => "success"));
        } else {
            res("500", $res);
        }
    }

    //注册
    public function register()
    {
        try {
            $name = $this->input->post('name', true);
            $telephone = $this->input->post('telephone', true);
            $password = $this->input->post('password', true);
            $permissions = $this->input->post('permissions', true);
            $flag = $this->TestModel->getUserByPhone($telephone);

            if (count($flag) != 0) {
                // eee("300", '已有该用户');
                $res = $flag[0]->permissions;

                // echo json_encode($permissions);
                // echo json_encode($flag[0]->permissions);

                $domain = strstr($res,$permissions);
                // echo $domain;
                if ($domain) {
                    res("600", '您已有权限');
                    die();
                }
                $update_data = $permissions.$res;
                $res = $this->TestModel->update($name,$telephone,$password,$update_data);
                res('200', array("msg" => "success"));
            }else if(count($flag) == 0){
                //没有账号
                $res = $this->TestModel->register($name,$telephone,$password,$permissions);
                res('200', array("msg" => "success"));
            }
        } catch (Exception $e) {
            res("400", $e);
        }

    }

    //查询  
    public function user_info(){
        $telephone = $this->input->post('telephone', true);
        $userInfo =  $this->TestModel->getUserByPhone($telephone);
        echo json_encode($userInfo);
    }
    

    //查询地址数据
    public function address()
    {
        // $res = $this->TestModel->all();
        $res = $this->TestModel->get_all_address();
        echo json_encode($res);
    }

    //添加地址
    public function add_address()
    {
        try {
            $name = $this->input->post('name', true);
            $phone = $this->input->post('phone', true);
            $addr = $this->input->post('addr', true);
            $gate = $this->input->post('gate', true);
            $res = $this->TestModel->addAddress($name,$phone,$addr,$gate);
            res('200', array("msg" => "success"));
        } catch (Exception $e) {
            res("400", $e);
        }

    }

    //查询订单
    public function order()
    {
        $res = $this->TestModel->get_all_order();
        echo json_encode($res);
    }

    //添加订单
    public function add_order()
    {
        try {
            $title = $this->input->post('title', false);
            $provenance = $this->input->post('provenance', false);
            $destination = $this->input->post('destination', true);
            $price = $this->input->post('price', true);
            $remarks = $this->input->post('remarks', true);
            $phone = $this->input->post('phone', true);
            $orderNumber = $this->input->post('orderNumber', true);

            $res = $this->TestModel->addOrder($title,$provenance,$destination,$price,$remarks,$phone,$orderNumber);
            res('200', array("msg" => "success"));
        } catch (Exception $e) {
            res("400", $e);
        }
    }


    //查询快递员 名字
    public function rider_name()
    {
        $res = $this->TestModel->get_all_riderName();
        echo json_encode($res);
    }

    //添加预约时间
    public function add_appointmentTime()
    {
        try {
            $name = $this->input->post('name', false);
            $phone = $this->input->post('phone', false);
            $address = $this->input->post('address', true);
            $appointmentTime = $this->input->post('appointmentTime', true);
            $chooseRider = $this->input->post('chooseRider', true);

            $res = $this->TestModel->addAppointmentTime($name,$phone,$address,$appointmentTime,$chooseRider);
            res('200', array("msg" => "success"));
        } catch (Exception $e) {
            res("400", $e);
        }
    }

    //查询预约 订单
    public function appoint_order()
    {
        $res = $this->TestModel->get_all_appointOrder();
        echo json_encode($res);
    }

    //搜索订单 202003271585300865000
    public function searchOrder()
    {
        try {
            $orderNumber = $this->input->post('orderNumber', true);
            $res = $this->TestModel->searchOrder($orderNumber);
            res("200", $res);

        } catch (Exception $e) {
            res("400", $e);
        }
    }

    //添加评价
    public function add_evaluation()
    {
        try {
            $orderNumber = $this->input->post('orderNumber', false);
            $evaluation = $this->input->post('evaluation', false);

            $res = $this->TestModel->addEvaluation($orderNumber,$evaluation);
            res('200', array("msg" => "success"));
        } catch (Exception $e) {
            res("400", $e);
        }
    }

    //删除 预约订单
    public function deleteAppointOrder()
    {
        try {
            // $this->adminAuthority();
            $name = $this->input->post('name', true);
            $res = $this->TestModel->deleteAppointOrder($name);
            res("200", $res);

        } catch (Exception $e) {
            res("400", $e);
        }
    }

    //修改订单状态
    public function updateOrderStatus()
    {
        try {
            $title = $this->input->post('title', false);
            $provenance = $this->input->post('provenance', false);
            $destination = $this->input->post('destination', true);
            $price = $this->input->post('price', true);
            $remarks = $this->input->post('remarks', true);
            $phone = $this->input->post('phone', true);
            $orderNumber = $this->input->post('orderNumber', true);
            $status = $this->input->post('status', true);
            $this->TestModel->updateOrderStatus($status,$orderNumber,$title,$provenance,$destination,$price,$remarks,$phone);
            res("200", 'success');

        } catch (Exception $e) {
            res('400', $e);
        }
    }

}
