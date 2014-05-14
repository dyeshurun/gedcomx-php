<?php
/**
 *
 * 
 *
 * Generated by <a href="http://enunciate.codehaus.org">Enunciate</a>.
 *
 */

namespace Gedcomx\Extensions\FamilySearch\Tree;

/**
 * 
 */
class MergeAnalysis
{

    /**
     * (no documentation provided)
     *
     * @var \Gedcomx\Common\ResourceReference[]
     */
    private $survivorResources;

    /**
     * (no documentation provided)
     *
     * @var \Gedcomx\Common\ResourceReference[]
     */
    private $duplicateResources;

    /**
     * (no documentation provided)
     *
     * @var \Gedcomx\Extensions\FamilySearch\Tree\MergeConflict[]
     */
    private $conflictingResources;

    /**
     * (no documentation provided)
     *
     * @var \Gedcomx\Common\ResourceReference
     */
    private $survivor;

    /**
     * (no documentation provided)
     *
     * @var \Gedcomx\Common\ResourceReference
     */
    private $duplicate;

    /**
     * Constructs a MergeAnalysis from a (parsed) JSON hash
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
     * (no documentation provided)
     *
     * @return \Gedcomx\Common\ResourceReference[]
     */
    public function getSurvivorResources()
    {
        return $this->survivorResources;
    }

    /**
     * (no documentation provided)
     *
     * @param \Gedcomx\Common\ResourceReference[] $survivorResources
     */
    public function setSurvivorResources($survivorResources)
    {
        $this->survivorResources = $survivorResources;
    }
    /**
     * (no documentation provided)
     *
     * @return \Gedcomx\Common\ResourceReference[]
     */
    public function getDuplicateResources()
    {
        return $this->duplicateResources;
    }

    /**
     * (no documentation provided)
     *
     * @param \Gedcomx\Common\ResourceReference[] $duplicateResources
     */
    public function setDuplicateResources($duplicateResources)
    {
        $this->duplicateResources = $duplicateResources;
    }
    /**
     * (no documentation provided)
     *
     * @return \Gedcomx\Extensions\FamilySearch\Tree\MergeConflict[]
     */
    public function getConflictingResources()
    {
        return $this->conflictingResources;
    }

    /**
     * (no documentation provided)
     *
     * @param \Gedcomx\Extensions\FamilySearch\Tree\MergeConflict[] $conflictingResources
     */
    public function setConflictingResources($conflictingResources)
    {
        $this->conflictingResources = $conflictingResources;
    }
    /**
     * (no documentation provided)
     *
     * @return \Gedcomx\Common\ResourceReference
     */
    public function getSurvivor()
    {
        return $this->survivor;
    }

    /**
     * (no documentation provided)
     *
     * @param \Gedcomx\Common\ResourceReference $survivor
     */
    public function setSurvivor($survivor)
    {
        $this->survivor = $survivor;
    }
    /**
     * (no documentation provided)
     *
     * @return \Gedcomx\Common\ResourceReference
     */
    public function getDuplicate()
    {
        return $this->duplicate;
    }

    /**
     * (no documentation provided)
     *
     * @param \Gedcomx\Common\ResourceReference $duplicate
     */
    public function setDuplicate($duplicate)
    {
        $this->duplicate = $duplicate;
    }
    /**
     * Returns the associative array for this MergeAnalysis
     *
     * @return array
     */
    public function toArray()
    {
        $a = array();
        if ($this->survivorResources) {
            $ab = array();
            foreach ($this->survivorResources as $i => $x) {
                $ab[$i] = $x->toArray();
            }
            $a['survivorResources'] = $ab;
        }
        if ($this->duplicateResources) {
            $ab = array();
            foreach ($this->duplicateResources as $i => $x) {
                $ab[$i] = $x->toArray();
            }
            $a['duplicateResources'] = $ab;
        }
        if ($this->conflictingResources) {
            $ab = array();
            foreach ($this->conflictingResources as $i => $x) {
                $ab[$i] = $x->toArray();
            }
            $a['conflictingResources'] = $ab;
        }
        if ($this->survivor) {
            $a["survivor"] = $this->survivor->toArray();
        }
        if ($this->duplicate) {
            $a["duplicate"] = $this->duplicate->toArray();
        }
        return $a;
    }

    /**
     * Returns the JSON string for this MergeAnalysis
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Initializes this MergeAnalysis from an associative array
     *
     * @param array $o
     */
    public function initFromArray($o)
    {
        $this->survivorResources = array();
        if (isset($o['survivorResources'])) {
            foreach ($o['survivorResources'] as $i => $x) {
                $this->survivorResources[$i] = new \Gedcomx\Common\ResourceReference($x);
            }
        }
        $this->duplicateResources = array();
        if (isset($o['duplicateResources'])) {
            foreach ($o['duplicateResources'] as $i => $x) {
                $this->duplicateResources[$i] = new \Gedcomx\Common\ResourceReference($x);
            }
        }
        $this->conflictingResources = array();
        if (isset($o['conflictingResources'])) {
            foreach ($o['conflictingResources'] as $i => $x) {
                $this->conflictingResources[$i] = new \Gedcomx\Extensions\FamilySearch\Tree\MergeConflict($x);
            }
        }
        if (isset($o['survivor'])) {
            $this->survivor = new \Gedcomx\Common\ResourceReference($o["survivor"]);
        }
        if (isset($o['duplicate'])) {
            $this->duplicate = new \Gedcomx\Common\ResourceReference($o["duplicate"]);
        }
    }

    /**
     * Initializes this MergeAnalysis from an XML reader.
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
                else if (!$xml->isEmptyElement && !$this->setKnownChildElement($xml)) {
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
     * Sets a known child element of MergeAnalysis from an XML reader.
     *
     * @param \XMLReader $xml The reader.
     * @return bool Whether a child element was set.
     */
    protected function setKnownChildElement($xml) {
        $happened = false;
        if (($xml->localName == 'survivorResource') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = new \Gedcomx\Common\ResourceReference($xml);
            if (!isset($this->survivorResources)) {
                $this->survivorResources = array();
            }
            array_push($this->survivorResources, $child);
            $happened = true;
        }
        else if (($xml->localName == 'duplicateResource') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = new \Gedcomx\Common\ResourceReference($xml);
            if (!isset($this->duplicateResources)) {
                $this->duplicateResources = array();
            }
            array_push($this->duplicateResources, $child);
            $happened = true;
        }
        else if (($xml->localName == 'conflictingResource') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = new \Gedcomx\Extensions\FamilySearch\Tree\MergeConflict($xml);
            if (!isset($this->conflictingResources)) {
                $this->conflictingResources = array();
            }
            array_push($this->conflictingResources, $child);
            $happened = true;
        }
        else if (($xml->localName == 'survivor') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = new \Gedcomx\Common\ResourceReference($xml);
            $this->survivor = $child;
            $happened = true;
        }
        else if (($xml->localName == 'duplicate') && ($xml->namespaceURI == 'http://familysearch.org/v1/')) {
            $child = new \Gedcomx\Common\ResourceReference($xml);
            $this->duplicate = $child;
            $happened = true;
        }
        return $happened;
    }

    /**
     * Sets a known attribute of MergeAnalysis from an XML reader.
     *
     * @param \XMLReader $xml The reader.
     * @return bool Whether an attribute was set.
     */
    protected function setKnownAttribute($xml) {

        return false;
    }

    /**
     * Writes this MergeAnalysis to an XML writer.
     *
     * @param \XMLWriter $writer The XML writer.
     * @param bool $includeNamespaces Whether to write out the namespaces in the element.
     */
    public function toXml($writer, $includeNamespaces = true)
    {
        $writer->startElementNS('fs', 'mergeAnalysis', null);
        if ($includeNamespaces) {
            $writer->writeAttributeNs('xmlns', 'gx', null, 'http://gedcomx.org/v1/');
            $writer->writeAttributeNs('xmlns', 'fs', null, 'http://familysearch.org/v1/');
        }
        $this->writeXmlContents($writer);
        $writer->endElement();
    }

    /**
     * Writes the contents of this MergeAnalysis to an XML writer. The startElement is expected to be already provided.
     *
     * @param \XMLWriter $writer The XML writer.
     */
    public function writeXmlContents($writer)
    {
        if ($this->survivorResources) {
            foreach ($this->survivorResources as $i => $x) {
                $writer->startElementNs('fs', 'survivorResource', null);
                $x->writeXmlContents($writer);
                $writer->endElement();
            }
        }
        if ($this->duplicateResources) {
            foreach ($this->duplicateResources as $i => $x) {
                $writer->startElementNs('fs', 'duplicateResource', null);
                $x->writeXmlContents($writer);
                $writer->endElement();
            }
        }
        if ($this->conflictingResources) {
            foreach ($this->conflictingResources as $i => $x) {
                $writer->startElementNs('fs', 'conflictingResource', null);
                $x->writeXmlContents($writer);
                $writer->endElement();
            }
        }
        if ($this->survivor) {
            $writer->startElementNs('fs', 'survivor', null);
            $this->survivor->writeXmlContents($writer);
            $writer->endElement();
        }
        if ($this->duplicate) {
            $writer->startElementNs('fs', 'duplicate', null);
            $this->duplicate->writeXmlContents($writer);
            $writer->endElement();
        }
    }
}
