<?php

    namespace Gedcomx\Rs\Client\Options;

    use GuzzleHttp\Psr7\Request;

    /**
     * Represents a generic query string parameter to use in REST API requests.
     *
     * Class QueryParameter
     *
     * @package Gedcomx\Rs\Client\Options
     */
    class QueryParameter implements StateTransitionOption
    {
        /**
         * The access token query parameter.
         */
        const ACCESS_TOKEN = "access_token";
        /**
         * The count query parameter.
         */
        const COUNT = "count";
        /**
         * The generations query parameter.
         */
        const GENERATIONS = "generations";
        /**
         * The search query parameter.
         */
        const SEARCH_QUERY = "q";
        /**
         * The start query parameter.
         */
        const START = "start";

        private $replace;
        private $name;
        private $value;

        /**
         * Constructs a new generic query parameter using the specified values.
         *
         * @param boolean $replace
         * @param string  $name
         * @param string  $value,...
         */
        public function __construct($replace, $name, $value)
        {
            $this->replace = $replace;
            $this->name = $name;
            if (func_num_args() > 3) {
                $args = func_get_args();
                array_shift(array_shift($args));
                $this->value = $args;
            } else {
                $this->value = $value;
            }
        }

        /**
         * This method adds the current parameter to the specified REST API request.
         *
         * @param \GuzzleHttp\Psr7\Request $request
         * @return Request
         */
        public function apply(Request $request)
        {
            $queryString = $request->getUri()->getQuery();
            $queryParts = \GuzzleHttp\Psr7\parse_query($queryString);
            $queryParts[$this->name] = $this->value;
            $queryString = \GuzzleHttp\Psr7\build_query($queryParts);
            return $request->withUri($request->getUri()->withQuery($queryString));
        }

        /**
         * Creates an access token query string parameter.
         *
         * @param string $value
         *
         * @return QueryParameter
         */
        public static function accessToken($value)
        {
            return new QueryParameter(true, self::ACCESS_TOKEN, $value);
        }

        /**
         * Creates a count query string parameter.
         *
         * @param string $value
         *
         * @return QueryParameter
         */
        public static function count($value)
        {
            return new QueryParameter(true, self::COUNT, $value);
        }

        /**
         * Creates a generations query string parameter.
         *
         * @param string $value
         *
         * @return QueryParameter
         */
        public static function generations($value)
        {
            return new QueryParameter(true, self::GENERATIONS, $value);
        }

        /**
         * Creates a search query string parameter.
         *
         * @param string $value
         *
         * @return QueryParameter
         */
        public static function searchQuery($value)
        {
            return new QueryParameter(true, self::SEARCH_QUERY, $value);
        }

        /**
         * Creates a start query string parameter.
         *
         * @param string $value
         *
         * @return QueryParameter
         */
        public static function start($value)
        {
            return new QueryParameter(true, self::START, $value);
        }
    }