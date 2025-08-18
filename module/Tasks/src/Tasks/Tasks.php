<?php namespace Tasks;

Use Application\Logs;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;use Laminas\Mvc\Application;

class Tasks
{
    protected $_name = 'tasks'; //db name
    protected $_id = 'TaskID'; //Primary Key
    protected $_order = array('TaskListOrdering' => 'ASC');
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
        if (isset($input['TaskTitle'])) { $data['UserID'] = trim($input['UserID']); }
        if (isset($input['TaskDescription'])) { $data['CourseName'] = trim($input['CourseName']); }
        if (isset($input['Complete'])) { $data['DisciplineID'] = trim($input['DisciplineID']); }
        if (isset($input['ListOrdering'])) { $data['CourseNumber'] = trim($input['CourseNumber']); }
        if (isset($input['TaskListID'])) { $data['TaskListID'] = trim($input['TaskListID']); }

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
        $data['Complete'] = 0;
        $data['ListOrdering'] = 1;
        $data['TaskListID'] = 0;

        $this->_log->LogInsert($this->_name, $data);

        $this->_db->insert($data);
    }

    private function update($taskid, $data) {
        $this->_log->LogUpdate($this->_name, $taskid, $data);

        $this->_db->update($data, array($this->_id => $taskid));
    }

    private function delete($taskid) {
        $this->_log->LogDelete($this->_name, $taskid, $this->getDetails($taskid));

        $this->_db->delete(array($this->_id => $taskid));
    }

    public function getDetails($taskid) {
        if(!empty($taskid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('TaskID', $taskid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
    public function getAll() {
        $this->select->from($this->_name)->order($this->_order);
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function getAllByTaskListID($tasklistid) {
        if(!empty($tasklistid)) {
            $this->select->from('tasks')->order($this->_order);
            $where = new Where();
            $where->equalTo('TaskListID', $tasklistid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getUnlistedByUserID($userid) {
        if(!empty($userid)) {
            $this->select->from('tasks_unlisted')->order($this->_order);
            $where = new Where();
            $where->equalTo('UserID', $userid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
}