<?php
namespace UToronto\Email\Merge;

class Template
{

    private $subject;

    private $htmlBody;

    private $tokenSet;

    /**
     *
     * @var UToronto\Email\Merge\TokenSet
     */
    protected static $_defaultTokenSet;

    function __construct ($subject, $htmlBody, TokenSet $tokens = null)
    {
        $this->subject = $subject;
        $this->htmlBody = $htmlBody;
        if (! $this->tokenSet) {
            $this->tokenSet = Template::$_defaultTokenSet;
        }
        $this->validate();
    }

    public static function setDefaultTokenSet (TokenSet $tokenSet)
    {
        Template::$_defaultTokenSet = $tokenSet;
    }

    public function getSubject ()
    {
        return $this->subject;
    }

    public function setSubject ($subject)
    {
        $this->subject = $subject;
    }

    public function getHtmlBody ()
    {
        return $this->htmlBody;
    }

    public function setHtmlBody ($htmlBody)
    {
        $this->htmlBody = $htmlBody;
    }

    public function setAllowedTokens (TokenSet $tokens)
    {
        $this->tokenSet = $tokens;
    }

    private function validate ()
    {
        $found = array();
        $errors = array();
        preg_match_all("/%([^%]+)%/", $this->htmlBody, $found);
        if (count($found) > 0) {
            for ($i = 1; $i < count($found); $i ++) {
                $m = $found[$i];
                if (! $this->tokenSet->contains($m[1])) {
                    $errors[] = $m[1];
                }
            }
        }
        
        if (count($errors) > 0) {
            throw new UnrecognizedTokenException(
                    "Unrecognized tokens: " + implode(", ", $errors));
        }
    }
}