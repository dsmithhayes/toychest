<?php

namespace ToyChest;

use Interop\Container\ContainerInterface;
use ArrayAccess;

/**
 * A very small dependency container.
 */
class ToyChest implements ArrayAccess, ContainerInterface
{
    /*
     * @var array
     *      The container which holds all objects
     */
    private static $container;

    /**
     * @param string $name
     * @return mixed|null
     *      Returns null if the dependency isn't set
     */
    public function __get($name)
    {
        if (!array_key_exists($name, self::$container)) {
            throw new \Exception('Key not found: ' . $name);
        }

        return $this->get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param |Exception
     */
    public function __set($name, $value)
    {
        if (!array_key_exists($name, self::$container)) {
            throw new \Exception('Key not found: ' . $name);
        }

        self::$container[$name] = $value;
    }

    /**
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param string $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        self::$container[$offset] = $value;
    }

    /**
     * @param string $offset
     */
    public function offsetUnset($offset)
    {
        unset(self::$container[$offset]);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function get($id)
    {
        if (is_callable(self::$container[$id])) {
            return self::$container[$id]($this);
        }

        return self::$container[$id];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists($id, self::$container);
    }
}
