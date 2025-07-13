<?php

namespace Assignments;

Use Application\Logs;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;use Laminas\Mvc\Application;

class Assignments
{
    protected $_name = 'assignments'; //db name
    protected $_id = 'AssignmentID'; //Primary Key
    protected $_order = array('AssignmentID' => 'ASC');
    protected $select;
    protected $_db;
    protected $_log;

    public function __construct() {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        $this->_log = new Logs;
        return $this->_db;
    }

    public function input($input) {
        $data = array();
        if (isset($input['AssignmentName'])) { $data['AssignmentName'] = trim($input['AssignmentName']); }
        if (isset($input['AssignmentDescription'])) { $data['AssignmentDescription'] = trim($input['AssignmentDescription']); }
        if (isset($input['CourseID'])) { $data['CourseID'] = trim($input['CourseID']); }
        if (isset($input['SourceName'])) { $data['SourceName'] = trim($input['SourceName']); }
        if (isset($input['SourceLink'])) { $data['SourceLink'] = trim($input['SourceLink']); }
        if (isset($input['DueDate'])) { $data['DueDate'] = date('Y-m-d H:i:s',strtotime(trim($input['DueDate']))); }
        if (isset($input['Complete'])) { $data['Complete'] = trim($input['Complete']); }


        if (isset($input[$this->_id])) {
            //If the inputted data has a CourseID
            $this->update($input[$this->_id], $data);
            return $input[$this->_id];
        } else {
            $memberid = $this->insert($data);
            return $memberid;
        }
    }

    private function insert($data) {
        $data['EntryDate'] = date('Y-m-d H:i:s');
        $data['Complete'] = '0';

        $this->_log->logInsertItem($this->_name, $data);

        $this->_db->insert($data);
    }

    private function update($assignmentid, $data) {
        $this->_log->logUpdateItem($this->_name, $assignmentid, $data);

        $this->_db->update($data, array($this->_id => $assignmentid));
    }

    private function delete($assignmentid) {
        $this->_log->logDeleteItem($this->_name, $assignmentid, $this->getDetails($assignmentid));

        $this->_db->delete(array($this->_id => $assignmentid));
    }

    public function getDetails($assignmentid) {
        if(!empty($assignmentid)) {
            $this->select->from('courses_disciplines');
            $where = new Where();
            $where->equalTo('CourseID', $assignmentid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getAll() {
        $this->select->from($this->_name)->order(array('DueDate' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }
    public function getAllByCourseID($courseid) {
        if(!empty($courseid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('CourseID', $courseid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
}