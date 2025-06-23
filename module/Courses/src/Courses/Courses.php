<?php

namespace Courses;

use Application\ConfigurationTableGateway;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Update;
use Laminas\Db\Sql\Insert;
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
        $select = new Select();
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

    private function insert($data) {
        $data['EntryDate'] = date('Y-m-d H:i:s');
        $id = $this->_db->insert($data);
        return $id;
    }


}