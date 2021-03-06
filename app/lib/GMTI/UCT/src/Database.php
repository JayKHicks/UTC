<?php
/**
 * Created by DCDGroup.
 * User: JHICKS
 * Date: 3/15/14
 * Time: 4:13 PM
 */

namespace UCT;

class Database extends \PDO
{
    private $connection_string = NULL;
    private $con = false;
    private $log;

    public function __construct($logDir = LOGGING_DIR, $logLevel = LOGGING_LEVEL)
    {
        //$this->setLog($logDir, $logLevel);
        try {
            $this->connection_string = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8';
            parent::__construct($this->connection_string, DB_USER, DB_PASS);
            $this->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->con = true;
        } catch (\PDOException $e) {
            $logText = "Message:(" . $e->getMessage() . ") attempting to connect to database";
            //$this->log->logError($logText);
        }
    }

    public function setLog($logDir = LOGGING_DIR, $logLevel = LOGGING_LEVEL)
    {
        $this->log = \KLogger::instance($logDir, $logLevel);
    }

    /// Get an associative array of results for the sql.
    public function getAssoc($sql, $params = array())
    {
        $ret = false;
        try {
            $time_start = microtime(true);
            $stmt = $this->prepare($sql);
            $params = is_array($params) ? $params : array($params);
            $stmt->execute($params);

            //$this->log->logInfo('sql: ('.$sql,') took ('.(microtime(true) - $time_start).')');

            $ret = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $logText = "Message:(" . $e->getMessage() . ") problem with query ($sql)";
            //$this->log->logError($logText);
        }

        return $ret;
    }

    public function getCount($sql) {
        $ret = false;
        try {
            $time_start = microtime(true);
            $stmt = $this->prepare($sql);
            $stmt->execute();
            $this->log->logInfo('sql: ('.$sql.') took ('.(microtime(true) - $time_start).')');
            $ret = $stmt->fetchColumn();
        } catch (\PDOException $e) {
            $logText = "Message:(" . $e->getMessage() . ") problem with query ($sql)";
            $this->log->logError($logText);
        }

        return $ret;
    }
}