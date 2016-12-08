<?php
require_once (dirname(__FILE__) . "/../vendor/autoload.php");
use UToronto\Email\Merge\Template;
class TemplateTest extends \PHPUnit_Framework_TestCase {
    
    function testTemplate1() {
        $path = __DIR__.'/Fixtures';
    
        $tpl = new Template($path . '/test1.xml');
        $arr = array(
                "UTORID" => "qq12345",
                "EMAIL" => "qq12345@example.com",
                "FULLNAME" => "Walter Winchell"
        );
        $result = $tpl->getResult($arr, array("lang" => "en"));
        var_dump($result);
    }
    
    /**
     * @expectedException RuntimeException
     */
    function testMissingTemplate() {
        $path = __DIR__.'/Fixtures';
    
        $tpl = new Template($path . '/does-not-exist.xml');
    }
    
    static function main ()
    {
        $suite = new PHPUnit_Framework_TestSuite(__CLASS__);
        PHPUnit_TextUI_TestRunner::run($suite);
    }
}
if (! defined('PHPUnit_MAIN_METHOD')) {
    TemplateTest::main();
}