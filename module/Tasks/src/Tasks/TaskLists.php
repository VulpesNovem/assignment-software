<?php namespace Tasks;

Use Application\Logs;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;use Laminas\Mvc\Application;

class TaskLists
{
    protected $_name = 'task_lists'; //db name
    protected $_id = 'TaskListID'; //Primary Key
    protected $_order = array('TaskListID' => 'ASC');
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
        if (isset($input['TaskListTitle'])) { $data['UserID'] = trim($input['UserID']); }

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

        $this->_log->logInsertItem($this->_name, $data);

        $this->_db->insert($data);
    }

    private function update($tasklistid, $data) {
        $this->_log->logUpdateItem($this->_name, $tasklistid, $data);

        $this->_db->update($data, array($this->_id => $tasklistid));
    }

    private function delete($tasklistid) {
        $this->_log->logDeleteItem($this->_name, $tasklistid, $this->getDetails($tasklistid));

        $this->_db->delete(array($this->_id => $tasklistid));
    }

    public function getDetails($tasklistid) {
        if(!empty($tasklistid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('TaskListID', $tasklistid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getAll() {
        $this->select->from($this->_name)->order($this->_order);
        return $this->_db->selectWith($this->select)->toArray();
    }

    public function getAllByUserID($userid) {
        if(!empty($userid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('UserID', $userid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }
}