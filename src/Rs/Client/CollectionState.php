<?php


namespace Gedcomx\Rs\Client;

use Gedcomx\Conclusion\Relationship;
use Gedcomx\Gedcomx;
use Gedcomx\Conclusion\Person;
use Gedcomx\Records\Collection;
use Gedcomx\Rs\Client\Util\GedcomxPersonSearchQueryBuilder;
use Gedcomx\Source\SourceDescription;
use Rize\UriTemplate;
use RuntimeException;

class CollectionState extends GedcomxApplicationState
{


    function __construct($client, $request, $response, $accessToken, $stateFactory)
    {
        parent::__construct($client, $request, $response, $accessToken, $stateFactory);
    }

    protected function reconstruct($request, $response)
    {
        return new CollectionState($this->client, $request, $response, $this->accessToken, $this->stateFactory);
    }

    protected function loadEntity()
    {
        $json = json_decode($this->response->getBody(), true);
        return new Gedcomx($json);
    }

    protected function getScope()
    {
        return $this->getCollection();
    }

    public function getCollection()
    {
        if ($this->entity) {
            $collections = $this->entity->getCollections();
            if (count($collections) > 0) {
                return $collections[0];
            }
        }

        return null;
    }

    /**
     * @return RecordsState|null
     */
    public function readRecords()
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @param Gedcomx $record
     * @return RecordState|null
     */
    public function addRecord($record)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

	/**
	 * @param array $options an optional list of parameters to add to the request object
	 * @return PersonState|null
	 */
	public function readPersonForCurrentUser( $options = array() )
	{
		$link = $this->getLink(Rel::CURRENT_USER_PERSON);
		if ($link !== null) {
			return null;
		}

		$request = $this->createAuthenticatedGedcomxRequest("GET", $link->getHref(), $options );
		return $this->stateFactory->buildPersonState($this->client, $request, $this->client->send($request), $this->accessToken );
	}

	/**
	 * @param array $options an optional list of parameters to add to the request object
     * @return PersonsState|null
     */
    public function readPersons( $options = array() )
    {
		/*
		 * Implemented in Java code, but there is no read (GET) for Persons
		 * only POST
		 */
    }

	/**
	 * @param String $uri optional only to gracefully handle hiccups in the code
	 * @param StateTransitionOption $opt,... 0 or more StateTransitionOption objects are allowed
	 * @returns PersonState|null
	 */
	public function readPerson( $uri = null, StateTransitionOption $opt = null ){
		if( $uri == null ){
			return null;
		}

		$transitionOptions = $this->getTransitionOptions( func_get_args() );

		$request = $this->createAuthenticatedGedcomxRequest("GET", $uri, $transitionOptions);
		return $this->stateFactory->buildPersonState($this->client, $request, $this->client->send($request), $this->accessToken);
	}

	/**
     * @param GedcomxSearchQuery|string $query
     * @param StateTransitionOption     $opt,... 0 or more StateTransitionOption objects are allowed
     *
     * @return PersonSearchResultsState|null
	 */
	public function searchForPersons($query, $opt = null )
	{
		$searchLink = $this->getLink(Rel::PERSON_SEARCH);
		if ($searchLink === null || $searchLink->getTemplate() === null) {
			return null;
		}
        if( $query instanceof GedcomxPersonSearchQueryBuilder ){
            $queryString = $query->build();
        } else {
            $queryString = $query;
        }

        $uri = array(
            $searchLink->getTemplate(),
            array(
                "q" => $queryString,
                "access_token" => $this->accessToken
            )
        );

		$transitionOptions = $this->getTransitionOptions( func_get_args() );
        $request = $this->createAuthenticatedFeedRequest("GET", $uri, $transitionOptions);

		return $this->stateFactory->buildPersonSearchResultsState( $this->client, $request, $this->client->send($request), $this->accessToken );
	}

    /**
     * @param Person|Gedcomx $person
     * @return PersonState|null
     */
    public function addPerson($person)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @return RelationshipsState|null
     */
    public function readRelationships()
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @param Relationship|Gedcomx $relationship
     * @return RelationshipState|null
     */
    public function addRelationship($relationship)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @param PersonState $person1
     * @param PersonState $person2
     * @return RelationshipState|null
     */
    public function addSpouseRelationship($person1, $person2)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @param PersonState $person1
     * @param PersonState $person2
     * @return RelationshipState|null
     */
    public function addParentRelationship($person1, $person2)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @param mixed $data The file
     * @param SourceDescription $description
     */
    public function addArtifact($data, $description = null)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @return SourceDescriptionsState|null
     */
    public function readSourceDescriptions()
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @param SourceDescription|Gedcomx $description
     * @return SourceDescriptionState|null
     */
    public function addSourceDescription($description)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @return CollectionState|null
     */
    public function readCollection()
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @return CollectionsState|null
     */
    public function readSubcollections()
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @param Collection|Gedcomx $collection
     * @return CollectionState|null
     */
    public function addCollection($collection)
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }

    /**
     * @return SourceDescriptionsState|null
     */
    public function readResourcesOfCurrentUser()
    {
        throw new RuntimeException("function currently not implemented."); //todo: implement
    }
}