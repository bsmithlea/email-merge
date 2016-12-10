<?php
require_once (dirname(__FILE__) . "/../vendor/autoload.php");

use UToronto\Email\Merge\Template;
use UToronto\Email\Merge\Parser;
use UToronto\Email\Merge\TokenSet;

class TemplateTest extends \PHPUnit_Framework_TestCase
{

    private $allowed = array(
            "USER_ID",
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
    	$tpl = new Template("Hello %FULLNAME%",
    			"Your id is <strong>%USER_ID%</strong>. Repeat, %USER_ID%",
    			new TokenSet($this->allowed));
    	$parser = new Parser($tpl);
    
    	$arr = array(
    			"USER_ID" => "qq12345",
    			"EMAIL" => "qq12345@example.com",
    			"FULLNAME" => "Miles Blundell"
    	);
    
    	$result = $parser->getResult($arr);
    	$this->assertEquals("Hello Miles Blundell", $result->getSubject(),
    			"interpolated subject line");
    	$this->assertEquals(
    			"Your id is <strong>qq12345</strong>. Repeat, qq12345",
    			$result->getHtmlBody(), "interpolated html body");
    }
    
    /**
     * @expectedException UToronto\Email\Merge\UTorontoEmailMergeException
     */
    function testUnrecognizedToken ()
    {
    	$tpl = new Template("Hello %FULLNAME%",
    			"Your id is <strong>%ACCOUNT%</strong>. Repeat, %ACCOUNT%",
    			new TokenSet($this->allowed));
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