<?php
namespace UToronto\Email\Merge;
use DOMDocument;

class XmlTemplate extends DOMDocument {
    /**
     *
     * @var DOMDocument
     */
    private $_template_data;

    public function __construct ($filename)
    {
        $filename = realpath($filename);
        if (file_exists($filename)) {
            $this->_template_data = new DOMDocument();
            $this->_template_data->preserveWhiteSpace = true;
            $this->_template_data->load($filename);
            // note the above instruction to NOT preserve whitespace is
            // required. PHP does not handle cdata sections properly if there is
            // *any* text around them. this could obviously mess up a <pre>
            // section if you have one
        } else {
            throw new \RuntimeException("File not found: " . $filename);
        }
    }
}