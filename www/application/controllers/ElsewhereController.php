<?php

class ElsewhereController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        echo "INDEX";
        $eMapper = new Application_Model_ElsewhereMapper();
        $this->view->entries = $eMapper->fetchAll();
    }


}

