<?php

namespace Courses;

Use Application\Logs;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;use Laminas\Mvc\Application;

class Courses
{
    protected $_name = 'courses'; //db name
    protected $_id = 'CourseID'; //Primary Key
    protected $_order = array('CourseID' => 'ASC');
    protected $select;
    protected $_db;
    protected $_log;

    public function __construct() {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        $this->_log = new Logs;
        return $this->_db;
    }

    public function input($input){
        $data = array();
        if (isset($input['UserID'])) { $data['UserID'] = trim($input['UserID']); }
        if (isset($input['CourseName'])) { $data['CourseName'] = trim($input['CourseName']); }
        if (isset($input['DisciplineID'])) { $data['DisciplineID'] = trim($input['DisciplineID']); }
        if (isset($input['CourseNumber'])) { $data['CourseNumber'] = trim($input['CourseNumber']); }
        if (isset($input['SectionNumber'])) { $data['SectionNumber'] = trim($input['SectionNumber']); }
        if (isset($input['SemesterID'])) { $data['SemesterID'] = trim($input['SemesterID']); }
        if (isset($input['CardColor'])) { $data['CardColor'] = ltrim($input['CardColor'], '#'); }

        if(isset($input[$this->_id])){
            //If the inputted data has a CourseID
            $this->update($input[$this->_id], $data);
            return $input[$this->_id];
        }else{
            $memberid = $this->insert($data);
            return $memberid;
        }
    }

    private function insert($data) {
        $data['UserID'] = $_SESSION['AssignmentSession']['User'][0]['UserID'];
        $data['EntryDate'] = date('Y-m-d H:i:s');
        $data['CardColor'] = '000000';

        $this->_log->LogInsert($this->_name, $data);

        $this->_db->insert($data);
    }

    private function update($courseid, $data) {
        $this->_log->LogUpdate($this->_name, $courseid, $data);

        $this->_db->update($data, array($this->_id => $courseid));
    }

    private function delete($courseid) {
        $this->_log->LogDelete($this->_name, $courseid, $this->getDetails($courseid));

        $this->_db->delete(array($this->_id => $courseid));
    }

    public function getDetails($courseid) {
        if(!empty($courseid)) {
            $this->select->from('courses_disciplines');
            $where = new Where();
            $where->equalTo('CourseID', $courseid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
    public function getAll() {
        $this->select->from('courses_disciplines')->order(array('DisciplineCode' => 'ASC', 'CourseNumber' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }
    public function getAllByUserID($userid) {
        if(!empty($userid)) {
            $this->select->from('courses_disciplines');
            $where = new Where();
            $where->equalTo('UserID', $userid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
}