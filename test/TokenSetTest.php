<?php
require_once (dirname(__FILE__) . "/../vendor/autoload.php");

use UToronto\Email\Merge\TokenSet;

class TokenSetTest extends \PHPUnit_Framework_TestCase
{
    private $allowed = array(
                        "UTORID",
                        "EMAIL",
                        "FULLNAME"
                );

    function testContains ()
    {
        $tokenSet = new TokenSet($this->allowed);
        $this->assertTrue($tokenSet->contains("UTORID"));
        $this->assertFalse($tokenSet->contains("FOOO"));
    }

    static function main ()
    {
        $suite = new PHPUnit_Framework_TestSuite(__CLASS__);
        PHPUnit_TextUI_TestRunner::run($suite);
    }
}
if (! defined('PHPUnit_MAIN_METHOD')) {
    TokenSetTest::main();
}