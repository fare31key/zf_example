<?php

class Application_Model_ElsewhereMapper
{
 protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Elsewhere');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Elsewhere $elsewhere)
    {
        $data = array(
            'prename'   => $elsewhere->prename,
            'aftername' => $elsewhere->aftername
        );
 
        if (null === ($id = $guestbook->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Elsewhere $elsewhere)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $elsewhere->id = $row->id;
        $elsewhere->prename = $row->prename;
        $elsewhere->aftername = $row->aftername;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Elsewhere();
            $entry->id = $row->id;
            $entry->prename = $row->prename;
            $entry->aftername = $row->aftername;
            $entries[] = $entry;
        }
        return $entries;
    }
}

