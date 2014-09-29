<?php


namespace Gedcomx\Rs\Client;

use Gedcomx\Atom\Entry;
use Gedcomx\Atom\Feed;
use Gedcomx\Conclusion\Person;
use Gedcomx\Gedcomx;

class PersonSearchResultsState extends GedcomxApplicationState
{

    function __construct($client, $request, $response, $accessToken, $stateFactory)
    {
        parent::__construct($client, $request, $response, $accessToken, $stateFactory);
    }

    protected function reconstruct($request, $response)
    {
        return new PersonSearchResultsState($this->client, $request, $response, $this->accessToken, $this->stateFactory);
    }

    protected function loadEntity()
    {
        $json = json_decode($this->response->getBody(), true);
        return new Gedcomx($json);
    }

    protected function getScope()
    {
        return $this->getResults();
    }

    /**
     * @return Feed
     */
    public function getResults()
    {
        return $this->getEntity();
    }

    /**
     * @param Entry $person
     * @param StateTransitionOption $transitionOption,... zero or more StateTransitionOption objects
     *
     * @return PersonState|null
     */
    public function readPerson( Entry $person, $transitionOption = null ) {
        $link = $person->getLink(Rel::PERSON);
        if( $link === null ){
            $link = $person->getLink(Rel::SELF);
        }
        if ($link === null || $link->getHref() === null) {
            return null;
        }

        $transitionOptions = $this->getTransitionOptions( func_get_args() );
        $request = $this->createAuthenticatedGedcomxRequest("GET", $link->getHref(), $transitionOptions);
        return $this->stateFactory->newPersonState($this->client, $request, $this->client->send($request), $this->accessToken);
    }

    /**
     * @param Entry $person
     * @param StateTransitionOption $transitionOption,... zero or more StateTransitionOption objects
     *
     * @return RecordState|null
     */
    public function readRecord( Entry $person, StateTransitionOption $transitionOption = null )
    {
        $link = $person->getLink(Rel::RECORD);
        if( $link === null ){
            $link = $person->getLink(Rel::SELF);
        }
        if ($link === null || $link->getHref() === null) {
            return null;
        }

        $transitionOptions = $this->getTransitionOptions( func_get_args() );
        $request = $this->createAuthenticatedGedcomxRequest("GET", $link->getHref(), $transitionOptions);
        return $this->stateFactory->newRecordState($this->client, $request, $this->client->send($request), $this->accessToken);
    }

    public function readNextPage()
    {
        return parent::readNextPage();
    }

    public function readPreviousPage()
    {
        return parent::readPreviousPage();
    }

    public function readFirstPage()
    {
        return parent::readFirstPage();
    }

    public function readLastPage()
    {
        return parent::readLastPage();
    }


}