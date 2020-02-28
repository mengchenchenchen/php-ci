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
        $db = $this->load->database('test');

    }

    /**
     * 添加项目
     * 将前端添加的项目参数经过判断后插入到数据库
     */
    public function add($name, $age)
    {
        $insert_data = array(
            'name' => $name,
            'age' => $age

        );
        $result = $this->db->insert("people", $insert_data);
    }

    public function all()
    {
        $query = $this->db->get('people');
        return $query->result_array();
    }
}