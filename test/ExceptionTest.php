<?php
require_once (dirname ( __FILE__ ) . "/../vendor/autoload.php");

use UToronto\Email\Merge\UnrecognizedTokenException as UnrecognizedTokenException;
use UToronto\Email\Merge\UTorontoEmailMergeException;
class ExceptionTest extends \PHPUnit_Framework_TestCase {
	public function testUnrecognizedTokenExceptionHierarchy() {
		try {
			throw new UnrecognizedTokenException ( "Unrecognized tokens: FOO, BAR" );
		} catch ( Exception $e ) {
			$this->assertTrue ( $e instanceof UTorontoEmailMergeException, "Parent class should be UTorontoEmailMergeException" );
		}
	}
	static function main() {
		$suite = new PHPUnit_Framework_TestSuite ( __CLASS__ );
		PHPUnit_TextUI_TestRunner::run ( $suite );
	}
}
if (! defined ( 'PHPUnit_MAIN_METHOD' )) {
	ExceptionTest::main ();
}