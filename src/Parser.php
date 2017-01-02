<?php

namespace UToronto\Email\Merge;

class Parser
{

    private $_template_data;

    function __construct ($tpl)
    {
        $this->_template_data = $tpl;
    }

    /**
     * Returns the result and restores the template to the last restore point.
     * optionally accepts bind values
     * 
     * @param array $select
     *            (optional)
     * @param array $bind_array
     *            (optional)
     */
    public function getResult (array $arr = array())
    {
        $out = clone $this->_template_data;
        $out->setSubject($this::substitute_vars($this->_template_data->getSubject(), $arr));
        $out->setHtmlBody($this::substitute_vars($this->_template_data->getHtmlBody(), $arr));
        return $out;
    }

    public static function substitute_vars ($str, array $arr)
    {
        // first process the keys of arr
        $n_arr = array();
        foreach ($arr as $key => $value) {
            $n_arr[strtoupper($key)] = $value;
        }
        
        return strtr($str, $n_arr);
    }
}