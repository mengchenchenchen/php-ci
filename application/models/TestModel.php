<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-3-2
 * Time: 下午4:30
 */

class TestModel extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $db = $this->load->database('phpsql');

    }

    /**
     * 添加项目
     * 将前端添加的项目参数经过判断后插入到数据库
    */

    //往里面保存数据，注册用 people 为表名

    public function add($name, $age)
    {
        $insert_data = array(
            'name' => $name,
            'age' => $age
        );
        $result = $this->db->insert("people", $insert_data);
    }
    
    //获取数据库的数据   mounted()时候用
    public function all()
    {
        $query = $this->db->get('people');
        return $query->result_array();
    }
    // 这里进行数据库操作
    public function get_all_user(){
        // 使用数据库 引用
        $query = $this->db->get('user');
        return $query->result_array();
    }

    //登录
    public function login($telephone, $password, $permissions)
    {
        $this->db->where('telephone', $telephone);
        $this->db->where('password', $password);
        $this->db->like('permissions', $permissions);

        // $this->db->where('permissions', $permissions);
      
      try{
        $this->db->from('user');
        $query = $this->db->get();
        $res = $query->result();
      }catch(Exception $e){
        echo $e;
    }
        return $res;
    }
    // 用手机号  查询  重复
    public function getUserByPhone($telephone)
    {
        $this->db->where('telephone', $telephone);
        $this->db->from('user');
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    //用权限查询重复
    public function getUserByPermissions($permissions)
    {
        $this->db->like('permissions', $permissions);
        $this->db->from('user');
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    // 注册新用户
    public function register($name,$telephone,$password,$permissions)
    {
        $insert_data = array(
            'name' => $name,
            'telephone' => $telephone,
            'password' => $password,
            'permissions' => $permissions,
        );
        $res = $this->db->insert("user", $insert_data);
    }

    //更新 用户 权限数据
    public function update($name,$telephone,$password,$update_data)
    {
        $insert_data = array(
            'telephone' => $telephone,
            'name' => $name,
            'password' => $password,
            'permissions' => $update_data,
        );
        $res = $this->db->replace("user", $insert_data);
    }

    //查询地址
    public function get_all_address(){
        // 使用数据库 引用
        $query = $this->db->get('address');
        return $query->result_array();
    }

    //添加新地址
    public function addAddress($name,$phone,$addr,$gate)
    {
        $insert_data = array(
            'name' => $name,
            'phone' => $phone,
            'addr' => $addr,
            'gate' => $gate,
        );
        $res = $this->db->insert("address", $insert_data);
    }

     //查询地址
     public function get_all_order(){
        // 使用数据库 引用
        $query = $this->db->get('order');
        return $query->result_array();
    }

     //添加新地址
     public function addOrder($title,$provenance,$destination,$price,$remarks,$phone,$orderNumber)
     {
         $insert_data = array(
             'title' => $title,
             'provenance' => $provenance,
             'destination' => $destination,
             'price' => $price,
             'remarks' => $remarks,
             'phone' => $phone,
             'orderNumber' => $orderNumber,
         );
         $res = $this->db->insert("order", $insert_data);
     }

     //查询快递员名字
     public function get_all_riderName(){
        // 使用数据库 引用
        $query = $this->db->get('rider');
        return $query->result_array();
    }

    //添加预约时间
    public function addAppointmentTime($name,$phone,$address,$appointmentTime,$chooseRider)
    {
        $insert_data = array(
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'appointmentTime' => $appointmentTime,
            'rider' => $chooseRider,
        );
        $res = $this->db->insert("appointmentorder", $insert_data);
    }

    //查询快递员名字
    public function get_all_appointOrder(){
        // 使用数据库 引用
        $query = $this->db->get('appointmentorder');
        return $query->result_array();
    }
    // 搜索订单
    public function searchOrder($orderNumber)
    {

        $this->db->where('orderNumber', $orderNumber);
        $this->db->from('order');
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }
    
    //添加评价
    public function addEvaluation($orderNumber,$evaluation)
    {
        $insert_data = array(
            'orderNumber' => $orderNumber,
            'evaluation' => $evaluation,
        );
        $res = $this->db->insert("evaluationOrder", $insert_data);
    }

    //删除 预约订单
    public function deleteAppointOrder($name)
    {
        $this->db->where('name', $name);
        $this->db->delete('appointmentorder');
    }

    //修改订单状态

    public function updateOrderStatus($status,$orderNumber,$title,$provenance,$destination,$price,$remarks,$phone)
    {
        $data = array(
            'title' => $title,
             'provenance' => $provenance,
             'destination' => $destination,
             'price' => $price,
             'remarks' => $remarks,
             'phone' => $phone,
             'orderNumber' => $orderNumber,
            'status' => $status
        );

        $this->db->replace('order', $data);
    }
}