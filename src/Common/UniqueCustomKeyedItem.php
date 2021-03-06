<?php


    namespace Gedcomx\Common;

    use Gedcomx\Support\HasJsonKey;

    /**
     * Class UniqueCustomKeyedItem
     * @package Gedcomx\Common
     *
     *            A class to support custom keyed item
     */

    class UniqueCustomKeyedItem implements HasJsonKey
    {

        /**
         * @var string
         */
        private $key;
        /**
         * @var mixed
         */
        private $val1;
        /**
         * @var mixed
         */
        private $val2;

        /**
         * Create a new UniqueCustomKeyedItem and initialize the id with a GUID
         */
        public function __construct()
        {
            $this->key = guid();
        }

        /**
         * @return bool
         */
        public function isHasUniqueKey()
        {
            return true;
        }

        /**
         * Return the key value for a JSON string
         *
         * @return mixed
         */
        public function getJsonKey()
        {
            return $this->getKey();
        }

        /**
         * Set the key value for a JSON string
         *
         * @param string $jsonKey
         */
        public function setJsonKey($jsonKey)
        {
            $this->setKey($jsonKey);
        }

        /**
         * Return the key value for this object
         *
         * @return string
         */
        public function getKey()
        {
            return $this->key;
        }

        /**
         * Set the key value for this object
         *
         * @param string $key
         */
        public function setKey($key)
        {
            $this->key = $key;
        }

        /**
         * Return the first value of this object
         *
         * @return mixed
         */
        public function getVal1()
        {
            return $this->val1;
        }

        /**
         * Set the first value of this object
         *
         * @param $val1
         */
        public function setVal1($val1)
        {
            $this->val1 = $val1;
        }

        /**
         * Return the second value of this object
         *
         * @return mixed
         */
        public function getVal2()
        {
            return $this->val2;
        }

        /**
         * Set the second value of this object
         *
         * @param mixed $val2
         */
        public function setVal2($val2)
        {
            $this->val2 = $val2;
        }
    }
