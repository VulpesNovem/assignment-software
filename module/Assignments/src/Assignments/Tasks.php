<?php

namespace Assignments;

Use Application\Logs;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;use Laminas\Mvc\Application;

class Assignments
{
    protected $_name = 'tasks'; //db name
    protected $_id = 'TaskID'; //Primary Key
    protected $_order = 'TaskID ASC';
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
        if (isset($input['TaskName'])) { $data['TaskName'] = trim($input['TaskName']); }
        if (isset($input['TaskDescription'])) { $data['TaskDescription'] = trim($input['TaskDescription']); }
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
        $data['UserID'] = $_SESSION['AssignmentSession']['User'][0]['UserID'];
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

    public function GetDetails($taskid) {
        if(!empty($taskid)) {
            $this->select->from('tasks');
            $where = new Where();
            $where->equalTo($this->_id, $taskid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function GetAll() {
        $this->select->from($this->_name)->order($this->_order);
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function GetAllByUserID($userid) {
        if(!empty($userid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('UserID', $userid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
}