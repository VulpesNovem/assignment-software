<?php

namespace Courses;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Semesters
{
    protected $_name = 'semesters'; //db name
    protected $_id = 'SemesterID'; //Primary Key
    protected $_order = array('SemesterID' => 'ASC');
    protected $select;
    protected $_db;

    public function __construct()
    {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        return $this->_db;
    }

    public function getDetails($id) {
        if(!empty($id)) {
            $this->select->from('semesters');
            $where = new Where();
            $where->equalTo('SemesterID', $id);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getAll() {
        $this->select->from('semesters')->order(array('SemesterID' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function getCurrentSemester() {
        $today = date('Y-m-d H:i:s');
        $semesterlist = $this->getAll();
        foreach($semesterlist as $semester) {
            if($semester['StartDate'] <= $today && $today <= $semester['EndDate']) {
                return $semester['SemesterID'];
            }
        }
    }
}