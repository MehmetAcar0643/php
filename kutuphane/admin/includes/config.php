<?php
ob_start();
error_reporting(0);
Class dbConfig{
	protected $dbConfig = array();
    protected function createConfig() {
        $this->dbConfig['host'] = 'localhost';
        $this->dbConfig['username'] = 'root';
        $this->dbConfig['password'] = 'root';
        $this->dbConfig['dbname'] = 'kutuphane';
	}
}
session_start();




?>