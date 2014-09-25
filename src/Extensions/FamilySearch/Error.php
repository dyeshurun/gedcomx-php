<?php
/**
 *
 * 
 *
 * Generated by <a href="http://enunciate.codehaus.org">Enunciate</a>.
 *
 */

namespace Gedcomx\Extensions\FamilySearch;

/**
 * A common representation of an error on the FamilySearch platform.
 */
class Error
{

    /**
     * The error code. Intepreted per &lt;a href=&quot;http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html&quot;&gt;RFC 2616, Section 10 (HTTP Status Code Definitions)&lt;/a&gt;.
     *
     * @var integer
     */
    private $code;

    /**
     * A text label associated with the error code.
     *
     * @var string
     */
    private $label;

    /**
     * A message associated with the error.
     *
     * @var string
     */
    private $message;

    /**
     * The back-end stack trace associated with the error, useful for debugging.
     *
     * @var string
     */
    private $stacktrace;

    /**
     * Constructs a Error from a (parsed) JSON hash
     *
     * @param mixed $o Either an array (JSON) or an XMLReader.
     */
    public function __construct($o = null)
    {
        if (is_array($o)) {
            $this->initFromArray($o);
        }
        else if ($o instanceof \XMLReader) {
            $success = true;
            while ($success && $o->nodeType != \XMLReader::ELEMENT) {
                $success = $o->read();
            }
            if ($o->nodeType != \XMLReader::ELEMENT) {
                throw new \Exception("Unable to read XML: no start element found.");
            }

            $this->initFromReader($o);
        }
    }

    /**
     * The error code. Intepreted per &lt;a href=&quot;http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html&quot;&gt;RFC 2616, Section 10 (HTTP Status Code Definitions)&lt;/a&gt;.
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * The error code. Intepreted per &lt;a href=&quot;http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html&quot;&gt;RFC 2616, Section 10 (HTTP Status Code Definitions)&lt;/a&gt;.
     *
     * @param integer $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
    /**
     * A text label associated with the error code.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * A text label associated with the error code.
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    /**
     * A message associated with the error.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * A message associated with the error.
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    /**
     * The back-end stack trace associated with the error, useful for debugging.
     *
     * @return string
     */
    public function getStacktrace()
    {
        return $this->stacktrace;
    }

    /**
     * The back-end stack trace associated with the error, useful for debugging.
     *
     * @param string $stacktrace
     */
    public function setStacktrace($stacktrace)
    {
        $this->stacktrace = $stacktrace;
    }
    /**
     * Returns the associative array for this Error
     *
     * @return array
     */
    public function toArray()
    {
        $a = array();
        if ($this->code) {
            $a["code"] = $this->code;
        }
        if ($this->label) {
            $a["label"] = $this->label;
        }
        if ($this->message) {
            $a["message"] = $this->message;
        }
        if ($this->stacktrace) {
            $a["stacktrace"] = $this->stacktrace;
        }
        return $a;
    }

    /**
     * Returns the JSON string for this Error
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Initializes this Error from an associative array
     *
     * @param array $o
     */
    public function initFromArray($o)
    {
        if (isset($o['code'])) {
            $this->code = $o["code"];
        }
        if (isset($o['label'])) {
            $this->label = $o["label"];
        }
        if (isset($o['message'])) {
            $this->message = $o["message"];
        }
        if (isset($o['stacktrace'])) {
            $this->stacktrace = $o["stacktrace"];
        }
    }

    /**
     * Initializes this Error from an XML reader.
     *
     * @param \XMLReader $xml The reader to use to initialize this object.
     */
    public function initFromReader($xml)
    {
        $empty = $xml->isEmptyElement;

        if ($xml->hasAttributes) {
            $moreAttributes = $xml->moveToFirstAttribute();
            while ($moreAttributes) {
                if (!$this->setKnownAttribute($xml)) {
                    //skip unknown attributes...
                }
                $moreAttributes = $xml->moveToNextAttribute();
            }
        }

        if (!$empty) {
            $xml->read();
            while ($xml->nodeType != \XMLReader::END_ELEMENT) {
                if ($xml->nodeType != \XMLReader::ELEMENT) {
                    //no-op: skip any insignificant whitespace, comments, etc.
                }
                else if (!$this->setKnownChildElement($xml)) {
                    $n = $xml->localName;
                    $ns = $xml->namespaceURI;
                    //skip the unknown element
                    while ($xml->nodeType != \XMLReader::END_ELEMENT && $xml->localName != $n && $xml->namespaceURI != $ns) {
                        $xml->read();
                    }
                }
                $xml->read(); //advance the reader.
            }
        }
    }


    /**
     * Sets a known child element of Error from an XML reader.
     *
     * @param \XMLReader $xml The reader.
     * @return bool Whether a child element was set.
     */
    protected function setKnownChildElement($xml) {
        $happened = false;
        if (($xml->localName == 'code') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = '';
            while ($xml->read() && $xml->hasValue) {
                $child = $child . $xml->value;
            }
            $this->code = $child;
            $happened = true;
        }
        else if (($xml->localName == 'label') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = '';
            while ($xml->read() && $xml->hasValue) {
                $child = $child . $xml->value;
            }
            $this->label = $child;
            $happened = true;
        }
        else if (($xml->localName == 'message') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = '';
            while ($xml->read() && $xml->hasValue) {
                $child = $child . $xml->value;
            }
            $this->message = $child;
            $happened = true;
        }
        else if (($xml->localName == 'stacktrace') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = '';
            while ($xml->read() && $xml->hasValue) {
                $child = $child . $xml->value;
            }
            $this->stacktrace = $child;
            $happened = true;
        }
        return $happened;
    }

    /**
     * Sets a known attribute of Error from an XML reader.
     *
     * @param \XMLReader $xml The reader.
     * @return bool Whether an attribute was set.
     */
    protected function setKnownAttribute($xml) {

        return false;
    }

    /**
     * Writes this Error to an XML writer.
     *
     * @param \XMLWriter $writer The XML writer.
     * @param bool $includeNamespaces Whether to write out the namespaces in the element.
     */
    public function toXml($writer, $includeNamespaces = true)
    {
        $writer->startElementNS('fs', 'error', null);
        if ($includeNamespaces) {
            $writer->writeAttributeNs('xmlns', 'fs', null, 'http://familysearch.org/v1/');
        }
        $this->writeXmlContents($writer);
        $writer->endElement();
    }

    /**
     * Writes the contents of this Error to an XML writer. The startElement is expected to be already provided.
     *
     * @param \XMLWriter $writer The XML writer.
     */
    public function writeXmlContents($writer)
    {
        if ($this->code) {
            $writer->startElementNs('fs', 'code', null);
            $writer->text($this->code);
            $writer->endElement();
        }
        if ($this->label) {
            $writer->startElementNs('fs', 'label', null);
            $writer->text($this->label);
            $writer->endElement();
        }
        if ($this->message) {
            $writer->startElementNs('fs', 'message', null);
            $writer->text($this->message);
            $writer->endElement();
        }
        if ($this->stacktrace) {
            $writer->startElementNs('fs', 'stacktrace', null);
            $writer->text($this->stacktrace);
            $writer->endElement();
        }
    }
}