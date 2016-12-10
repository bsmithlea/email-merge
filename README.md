# email-merge
PHP component for handling email templates with placeholder tokens. The email templates are assumed to be user-editable. Creating a new template requires declaring the set of allowable placeholder tokens. An exception will be thrown the token text contains something that looks like a token which is not recognized. 

```php
$tokens = new TokenSet(array("FOO", "BAR"));

$htmlBody = <<<HTML_BODY
&lt;p&gt;Here is a list of interpolated values
	&lt;ul&gt;
	&lt;/ul&gt;
&lt;/p&gt;	
HTML_BODY;

$tpl = new Template($html, $tokens);
```