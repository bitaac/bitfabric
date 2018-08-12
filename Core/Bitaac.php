<?php

namespace Bitaac\Core;

use Closure;

class Bitaac
{
    /**
     * Holding all the extended class methods.
     *
     * @var array
     */
    protected static $extended = [];

    /**
     * Holding the account name field.
     *
     * @var string
     */
    protected $accountNameField = 'name';

    /**
     * Extend given class method.
     *
     * @param  string   $namespace
     * @param  closure  $callback
     * @return void
     */
    public static function extend($namespace, Closure $callback)
    {
        static::$extended[$namespace] = $callback;
    }

    /**
     * Get all the extended class methods.
     *
     * @param  null|string  $namespace
     * @return array
     */
    public static function extended($namespace = null)
    {
        return is_null($namespace) ? static::$extended : static::$extended[$namespace];
    }

    /**
     * Set the account name field.
     *
     * @return string
     */
    public function setAccountNameField($field)
    {
        $this->accountNameField = $field;
    }

    /**
     * Get the account name field.
     *
     * @return string
     */
    public function getAccountNameField()
    {
        return $this->accountNameField;
    }
}
