<?php

namespace Courses;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Disciplines
{
    protected $_name = 'disciplines'; //db name
    protected $_id = 'DisciplineID'; //Primary Key
    protected $_order = array('DisciplineID' => 'ASC');
    protected $select;
    protected $_db;

    public function __construct()
    {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        return $this->_db;
    }

    public function getDetails($disciplineid) {
        if(!empty($disciplineid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('DisciplineID', $disciplineid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getAll() {
        $this->select->from($this->_name)->order(array($this->_id => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }
}