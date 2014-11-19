<?php
/**
 *
 * 
 *
 * Generated by <a href="http://enunciate.codehaus.org">Enunciate</a>.
 *
 */

namespace Gedcomx\Conclusion;

use Gedcomx\Common\Attributable;
use Gedcomx\Common\EvidenceReference;
use Gedcomx\Common\ExtensibleData;
use Gedcomx\Source\SourceReference;

/**
 * The <tt>Subject</tt> data type defines the abstract concept of a genealogical <em>subject</em>. A <em>subject</em> is something with a unique and
 * intrinsic identity, e.g., a person, a location on the surface of the earth. We identify that <em>subject</em> in time and space using various supporting
 * <em>conclusions</em>, e.g. for a person: things like name, birth date, age, address, etc. We aggregate these supporting <em>conclusions</em> to form an
 * apparently-unique identity by which we can distinguish our <em>subject</em> from all other possible <em>subjects</em>.
 */
class Subject extends Conclusion implements Attributable
{

    /**
     * Whether this subject has been identified as &quot;extracted&quot;.
     *
     * @var boolean
     */
    private $extracted;

    /**
     * References to the evidence being referenced.
     *
     * @var EvidenceReference[]
     */
    private $evidence;

    /**
     * References to multimedia resources associated with this subject.
     *
     * @var SourceReference[]
     */
    private $media;

    /**
     * The list of identifiers for the subject.
     *
     * @var Identifier[]
     */
    private $identifiers;

    /**
     * Constructs a Subject from a (parsed) JSON hash
     *
     * @param mixed $o Either an array (JSON) or an XMLReader.
     *
     * @throws \Exception
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
     * Whether this subject has been identified as &quot;extracted&quot;.
     *
     * @return boolean
     */
    public function getExtracted()
    {
        return $this->extracted;
    }

    /**
     * Whether this subject has been identified as &quot;extracted&quot;.
     *
     * @param boolean $extracted
     */
    public function setExtracted($extracted)
    {
        $this->extracted = $extracted;
    }
    /**
     * References to the evidence being referenced.
     *
     * @return EvidenceReference[]
     */
    public function getEvidence()
    {
        return $this->evidence;
    }

    /**
     * References to the evidence being referenced.
     *
     * @param EvidenceReference[] $evidence
     */
    public function setEvidence($evidence)
    {
        $this->evidence = $evidence;
    }
    /**
     * References to multimedia resources associated with this subject.
     *
     * @return SourceReference[]
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * References to multimedia resources associated with this subject.
     *
     * @param SourceReference[] $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }
    /**
     * The list of identifiers for the subject.
     *
     * @return Identifier[]
     */
    public function getIdentifiers()
    {
        return $this->identifiers;
    }

    /**
     * The list of identifiers for the subject.
     *
     * @param Identifier[] $identifiers
     */
    public function setIdentifiers($identifiers)
    {
        $this->identifiers = $identifiers;
    }
    /**
     * Returns the associative array for this Subject
     *
     * @return array
     */
    public function toArray()
    {
        $a = parent::toArray();
        if ($this->extracted) {
            $a["extracted"] = $this->extracted;
        }
        if ($this->evidence) {
            $ab = array();
            foreach ($this->evidence as $i => $x) {
                $ab[$i] = $x->toArray();
            }
            $a['evidence'] = $ab;
        }
        if ($this->media) {
            $ab = array();
            foreach ($this->media as $i => $x) {
                $ab[$i] = $x->toArray();
            }
            $a['media'] = $ab;
        }
        if ($this->identifiers) {
            $ab = array();
            foreach ($this->identifiers as $i => $x) {
                $ab[$x->getType()] = array($x->getValue());
            }
            $a['identifiers'] = $ab;
        }
        return $a;
    }


    /**
     * Initializes this Subject from an associative array
     *
     * @param array $o
     */
    public function initFromArray($o)
    {
        if (isset($o['extracted'])) {
            $this->extracted = $o["extracted"];
            unset($o['extracted']);
        }
        $this->evidence = array();
        if (isset($o['evidence'])) {
            foreach ($o['evidence'] as $i => $x) {
                $this->evidence[$i] = new EvidenceReference($x);
            }
            unset($o['evidence']);
        }
        $this->media = array();
        if (isset($o['media'])) {
            foreach ($o['media'] as $i => $x) {
                $this->media[$i] = new SourceReference($x);
            }
            unset($o['media']);
        }
        $this->identifiers = array();
        if (isset($o['identifiers'])) {
            $this->identifiers = array();
            foreach ($o['identifiers'] as $i => $x) {
                if (!is_array($x)) {
                    $x = array($x);
                }
                foreach($x as $idValue){
                    $identifier = new Identifier();
                    $identifier->setType($i);
                    $identifier->setValue($idValue);
                    array_push($this->identifiers, $identifier);
                }
            }
            unset($o['identifiers']);
        }
        parent::initFromArray($o);
    }

    /**
     * Sets a known child element of Subject from an XML reader.
     *
     * @param \XMLReader $xml The reader.
     * @return bool Whether a child element was set.
     */
    protected function setKnownChildElement($xml) {
        $happened = parent::setKnownChildElement($xml);
        if ($happened) {
          return true;
        }
        else if (($xml->localName == 'evidence') && ($xml->namespaceURI == 'http://gedcomx.org/v1/')) {
            $child = new EvidenceReference($xml);
            if (!isset($this->evidence)) {
                $this->evidence = array();
            }
            array_push($this->evidence, $child);
            $happened = true;
        }
        else if (($xml->localName == 'media') && ($xml->namespaceURI == 'http://gedcomx.org/v1/')) {
            $child = new SourceReference($xml);
            if (!isset($this->media)) {
                $this->media = array();
            }
            array_push($this->media, $child);
            $happened = true;
        }
        else if (($xml->localName == 'identifier') && ($xml->namespaceURI == 'http://gedcomx.org/v1/')) {
            $child = new Identifier($xml);
            if (!isset($this->identifiers)) {
                $this->identifiers = array();
            }
            array_push($this->identifiers, $child);
            $happened = true;
        }
        return $happened;
    }

    /**
     * Sets a known attribute of Subject from an XML reader.
     *
     * @param \XMLReader $xml The reader.
     * @return bool Whether an attribute was set.
     */
    protected function setKnownAttribute($xml) {
        if (parent::setKnownAttribute($xml)) {
            return true;
        }
        else if (($xml->localName == 'extracted') && (empty($xml->namespaceURI))) {
            $this->extracted = $xml->value;
            return true;
        }

        return false;
    }

    /**
     * Writes the contents of this Subject to an XML writer. The startElement is expected to be already provided.
     *
     * @param \XMLWriter $writer The XML writer.
     */
    public function writeXmlContents($writer)
    {
        if ($this->extracted) {
            $writer->writeAttribute('extracted', $this->extracted);
        }
        parent::writeXmlContents($writer);
        if ($this->evidence) {
            foreach ($this->evidence as $i => $x) {
                $writer->startElementNs('gx', 'evidence', null);
                $x->writeXmlContents($writer);
                $writer->endElement();
            }
        }
        if ($this->media) {
            foreach ($this->media as $i => $x) {
                $writer->startElementNs('gx', 'media', null);
                $x->writeXmlContents($writer);
                $writer->endElement();
            }
        }
        if ($this->identifiers) {
            foreach ($this->identifiers as $i => $x) {
                $writer->startElementNs('gx', 'identifier', null);
                $x->writeXmlContents($writer);
                $writer->endElement();
            }
        }
    }

    /**
     * Merges data from provided object with current object
     *
     * @param Subject|ExtensibleData $subject Assumes \Gedcomx\Conclusion\Subject or a subclass
     */
    protected function embed(ExtensibleData $subject) {
        $this->extracted = $this->extracted == null ? $subject->extracted : $this->extracted;

        if ($subject->identifiers != null) {
            if( $this->identifiers == null ) {
                $this->identifiers = array();
            } else {
                $this->identifiers = array_merge($this->identifiers, $subject->identifiers);
            }
        }
        if ($subject->media != null) {
            if( $this->media == null ){
                $this->media = array();
            } else {
                $this->media = array_merge($this->media, $subject->media);
            }
        }
        if ($subject->evidence != null) {
            if( $this->evidence == null ){
                $this->evidence = array();
            } else {
                $this->evidence = array_merge($this->evidence, $subject->evidence);
            }
        }

        parent::embed($subject);
    }

}
