<?php
require_once (dirname(__FILE__) . "/../vendor/autoload.php");

use UToronto\Email\Merge\Template;
use UToronto\Email\Merge\Parser;
use UToronto\Email\Merge\TokenSet;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    private $allowed = array(
                        "UTORID",
                        "EMAIL",
                        "FULLNAME"
                );
    function setUp ()
    {
        $tokenSet = new TokenSet($this->allowed);
        Template::setDefaultTokenSet($tokenSet);
    }

    function testTemplate ()
    {        
        $tpl = new Template("Hello %FULLNAME%", "Your id is <strong>%UTORID%</strong>. Repeat, %UTORID%", new TokenSet($this->allowed));
        $arr = array(
                "UTORID" => "qq12345",
                "EMAIL" => "qq12345@example.com",
                "FULLNAME" => "Walter Winchell"
        );
        $parser = new Parser($tpl);
        $result = $parser->getResult($arr);
        var_dump($result);
        echo json_encode($result);
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