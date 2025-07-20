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
    protected $_order = 'DueDate ASC';
    protected $select;
    protected $_db;
    protected $_log;

    public function __construct() {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        $this->_log = new Logs;
        return $this->_db;
    }

    public function Input($input) {
        $data = array();
        if (isset($input['AssignmentTypeID'])) { $data['AssignmentTypeID'] = trim($input['AssignmentTypeID']); }
        if (isset($input['AssignmentName'])) { $data['AssignmentName'] = trim($input['AssignmentName']); }
        if (isset($input['AssignmentDescription'])) { $data['AssignmentDescription'] = trim($input['AssignmentDescription']); }
        if (isset($input['CourseID'])) { $data['CourseID'] = trim($input['CourseID']); }
        if (isset($input['SourceLink'])) { $data['SourceLink'] = trim($input['SourceLink']); }
        if (isset($input['DueDate'])) { $data['DueDate'] = date('Y-m-d H:i:s',strtotime(trim($input['DueDate']))); }
        if (isset($input['Complete'])) { $data['Complete'] = trim($input['Complete']); }


        if (isset($input[$this->_id])) {
            //If the inputted data has a CourseID
            $this->Update($input[$this->_id], $data);
            return $input[$this->_id];
        } else {
            $memberid = $this->Insert($data);
            return $memberid;
        }
    }

    private function Insert($data) {
        $data['EntryDate'] = date('Y-m-d H:i:s');
        $data['Complete'] = '0';

        $this->_log->logInsertItem($this->_name, $data);

        $this->_db->insert($data);
    }

    private function Update($assignmentid, $data) {
        $this->_log->logUpdateItem($this->_name, $assignmentid, $data);

        $this->_db->update($data, array($this->_id => $assignmentid));
    }

    private function Delete($assignmentid) {
        $this->_log->logDeleteItem($this->_name, $assignmentid, $this->GetDetails($assignmentid));

        $this->_db->delete(array($this->_id => $assignmentid));
    }

    public function GetDetails($assignmentid) {
        if(!empty($assignmentid)) {
            $this->select->from('assignments_full');
            $where = new Where();
            $where->equalTo($this->_id, $assignmentid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function GetAll() {
        $this->select->from($this->_name)->order(array('DueDate' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function GetAssignmentTypes() {
        $this->select->from('assignment_types')->order(array('AssignmentTypeID' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function GetAllByCourseID($courseid) {
        if(!empty($courseid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('CourseID', $courseid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function GetPast() {
        $this->select->from('assignments_past');
        $this->select->order($this->_order);
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function GetUpcoming() {
        $this->select->from('assignments_upcoming');
        $this->select->order($this->_order);
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function GetOverdue() {
        $this->select->from('assignments_overdue');
        $this->select->order($this->_order);
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function GetPastByCourseID($courseid) {
        if(!empty($courseid)) {
            $this->select->from('assignments_past');
            $where = new Where();
            $where->equalTo('CourseID', $courseid);
            $this->select->order($this->_order);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function GetUpcomingByCourseID($courseid) {
        if(!empty($courseid)) {
            $this->select->from('assignments_upcoming');
            $where = new Where();
            $where->equalTo('CourseID', $courseid);
            $this->select->order($this->_order);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
}