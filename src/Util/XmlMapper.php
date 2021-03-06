<?php

namespace Gedcomx\Util;

/**
 * Class XmlMapper
 *
 * @package Gedcomx\Util
 *
 *          Store the mapping between XML tag names and class names.
 */
class XmlMapper
{
    private static $collection;

    /**
     * Initialize the collection with the map data
     */
    private static function init(){
        self::$collection = new Collection(array(
            'Gedcomx\Gedcomx' => 'gedcomx',
            'Gedcomx\Agent\Agent' => 'agents',
            'Gedcomx\Atom\Entry' => 'entries',
            'Gedcomx\Common\Attribution' => 'attribution',
            'Gedcomx\Common\CustomKeyedItem' => 'customKeys',
            'Gedcomx\Common\EvidenceReference' => 'evidence',
            'Gedcomx\Common\Note' => 'notes',
            'Gedcomx\Common\ResourceReference' => 'resourceReference',
            'Gedcomx\Common\UniqueCustomKeyedItem' => 'ucustomKeys',
            'Gedcomx\Conclusion\Document' => 'documents',
            'Gedcomx\Conclusion\Event' => 'events',
            'Gedcomx\Conclusion\Fact' => 'facts',
            'Gedcomx\Conclusion\Gender' => 'genders',
            'Gedcomx\Conclusion\Name' => 'names',
            'Gedcomx\Conclusion\Person' => 'persons',
            'Gedcomx\Conclusion\Relationship' => 'relationships',
            'Gedcomx\Extensions\FamilySearch\FamilySearchPlatform' => 'familysearch',
            'Gedcomx\Extensions\FamilySearch\Platform\Error' => 'errors',
            'Gedcomx\Extensions\FamilySearch\Platform\HealthConfig' => 'healthConfig',
            'Gedcomx\Extensions\FamilySearch\Platform\Tag' => 'tags',
            'Gedcomx\Extensions\FamilySearch\Platform\Artifacts\ArtifactMetadata' => 'artifactMetaData',
            'Gedcomx\Extensions\FamilySearch\Platform\Discussions\Discussion' => 'discussions',
            'Gedcomx\Extensions\FamilySearch\Platform\Tree\ChangeInfo' => 'changeInfo',
            'Gedcomx\Extensions\FamilySearch\Platform\Tree\ChildAndParentsRelationship' => 'child-and-parents-relationships',
            'Gedcomx\Extensions\FamilySearch\Platform\Tree\DiscussionReference' => 'discussion-references',
            'Gedcomx\Extensions\FamilySearch\Platform\Tree\MatchInfo' => 'matchInfo',
            'Gedcomx\Extensions\FamilySearch\Platform\Tree\Merge' => 'merge',
            'Gedcomx\Extensions\FamilySearch\Platform\Tree\MergeAnalysis' => 'mergeAnalysis',
            'Gedcomx\Extensions\FamilySearch\Platform\Tree\mergeConflict' => 'mergeConflict',
            'Gedcomx\Extensions\FamilySearch\Platform\Users\User' => 'users',
            'Gedcomx\Links\Link' => 'links',
            'Gedcomx\Records\Collection' => 'collections',
            'Gedcomx\Records\CollectionContent' => 'collectionContent',
            'Gedcomx\Records\Field' => 'fields',
            'Gedcomx\Records\RecordDescription' => 'recordDescriptors',
            'Gedcomx\Records\RecordSet' => 'records',
            'Gedcomx\Source\Coverage' => 'coverage',
            'Gedcomx\Source\SourceDescription' => 'sourceDescriptions',
            'Gedcomx\Source\SourceReference' => 'sourceReferences',
        ));
    }

    /**
     * Return the collection, initializing if necessary
     *
     * @return Collection
     */
    private static function collection(){
        if (self::$collection == null) {
            self::init();
        }

        return self::$collection;
    }

    /**
     * Return whether or not we recognize the tag name
     *
     * @param string $tagName
     *
     * @return bool
     */
    public static function isKnownType($tagName){
        return self::collection()->contains($tagName);
    }

    /**
     * Return the tag name for a given class
     *
     * @param string $class
     *
     * @return string | null
     */
    public static function getTagName($class)
    {
        return self::collection()->get($class);
    }

    /**
     * Return the class for a given tag name
     *
     * @param $tagName
     *
     * @return string | null
     */
    public static function getClassName($tagName)
    {
        return self::collection()->getKey($tagName);
    }
}