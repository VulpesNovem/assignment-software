<?php

namespace Courses;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Courses
{
    protected $_name = 'courses'; //db name
    protected $_id = 'CourseID'; //Primary Key
    protected $_order = array('CourseID' => 'ASC');
    protected $select;
    protected $_db;

    public function __construct() {

        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        return $this->_db;
    }

    public function getDetails($id) {
        if(!empty($id)) {
            $this->select->from('courses_disciplines');
            $where = new Where();
            $where->equalTo('CourseID', $id);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getAll() {
        $this->select->from('courses_disciplines')->order(array('DisciplineCode' => 'ASC', 'CourseNumber' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function insert($data) {
        $data['EntryDate'] = date('Y-m-d H:i:s');
        $id = $this->_db->insert($data);
        return $id;
    }

    public function updateValues($id, $data) {
        $this->_db->update($data, array($this->_id => $id));
    }
}