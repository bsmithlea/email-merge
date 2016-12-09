<?php namespace UToronto\Email\Merge;
class TokenSet {
    private $names = array();
    
    public function __construct($names = array()) {
        for($i = 0; $i < count($names); $i++) {
            $this->names[] = strtoupper(trim($names[$i]));
        }
        $this->names = $names;
    }
    
    public function contains($name) {
        if(in_array(strtoupper(trim($name)), $this->names)) {
            return true;
        }
        return false;
    }
}