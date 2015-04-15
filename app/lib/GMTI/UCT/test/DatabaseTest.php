<?php
/**
 * Created by PhpStorm.
 * User: JHICKS
 * Date: 4/15/2015
 * Time: 3:28 PM
 */

namespace UCT;


class DatabaseTest extends PHPUnit_Framework_TestCase {

    public function testDbAbleToConnect() {
        $db = new \UCT\Database();
        $this->assertTrue($db);
    }

}