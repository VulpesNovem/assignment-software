<?php

namespace Settings;

use Application\ConfigurationTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class Themes
{
    protected $_name = 'themes'; //db name
    protected $_id = 'ThemeID'; //Primary Key
    protected $_order = array('ThemeID' => 'ASC');
    protected $select;
    protected $_db;

    public function __construct()
    {
        $this->_db = new ConfigurationTableGateway($this->_name);
        $this->select = new Select();
        return $this->_db;
    }

    public function getDetails($themeeid)
    {
        if (!empty($courseid)) {
            $this->select->from($this->_name);
            $where = new Where();
            $where->equalTo('ThemeID', $themeeid);
            return $this->_db->selectWith($this->select->where($where))->toArray();
        }
        return false;
    }

    public function getAll()
    {
        $this->select->from($this->_name)->order(array('ThemeID' => 'ASC'));
        return $this->_db->selectWith($this->select)->toArray();
    }
}