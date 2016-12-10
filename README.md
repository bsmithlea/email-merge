# email-merge
PHP component for handling email templates with placeholder tokens. The email templates are assumed to be user-editable. Creating a new template requires declaring the set of allowable placeholder tokens. An exception will be thrown if the template text contains something that looks like a token but which is not expected. 

# Basic usage
```php
// Define allowed token names
$tokens = new TokenSet(array("USERNAME", "FOO", "BAR"));

// Email subject line may contain tokens also
$subject = "Hello %USERNAME%";

// HTML email body
$htmlBody = <<<HTML_BODY
<p>Here is a list of interpolated values
  <ul>
    <li>Foo: %FOO%</li>
    <li>Bar: %BAR%</li>
  </ul>
</p>	
HTML_BODY;

// Create a template in which all tokens must be "allowed"
$tpl = new Template($subject, $htmlBody, $tokens);

$parser = new Parser($tpl);

$data = array(
    "USERNAME" => "qq12345",
    "FOO" => "my foo value",
    "BAR" => "my bar value"
);

// A Parser instance will return Template objects containing interpolated values
$result = $parser->getResult($data);
```
# Unexpected token
```php
// Define allowed token names
$tokens = new TokenSet(array("USERNAME", "FOO", "BAR"));

// token name not in allowed set
$subject = "Hello %NOT_A_LEGAL_TOKEN%";

// throws UnrecognizedTokenException
$tpl = new Template($subject, "", $tokens);
```
