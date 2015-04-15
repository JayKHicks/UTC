<?php
/**
 * Created by PhpStorm.
 * User: JHICKS
 * Date: 4/15/2015
 * Time: 8:58 AM
 */

class DataBaseTest extends PHPUnit_Framework_TestCase {

    public function testDbAbleToConnect() {
        $db = new \UCT\Database();
        $this->assertTrue();
    }

}