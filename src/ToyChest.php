<?php

namespace ToyChest;

/**
 * @author Dave Smith-Hayes <me@davesmithhayes.com>
 */

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\NotFoundException;
use ArrayAccess;

/**
 * A very small dependency container.
 */
class ToyChest implements ArrayAccess, ContainerInterface
{
    /**
     * @var array
     *      The container which holds all objects
     */
    private $container;

    /**
     * @param string $name
     *      The key of the dependency
     * @return mixed
     *      The dependency
     * @throws \Interop\Container\Exception\NotFoundException
     *      When trying to acccess an invalid member of the container
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param string $name
     *      They to set for the dependency
     * @param mixed $value
     *      The dependency
     * @throws |Exception
     *      When trying to set an invalid member of the container
     */
    public function __set($name, $value)
    {
        $this->container[$name] = $value;
    }

    /**
     * @return bool
     *      True if the key exists in the container
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param string $offset
     *      The key for the dependency
     * @return mixed
     *      The dependency

     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param string $offset
     *      The key to set for the dependency
     * @param mixed $value
     *      The dependency to set
     */
    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }

    /**
     * @param string $offset
     *      The key to the depenency to remove
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * @param string $id
     *      The key of the dependency
     * @return mixed
     *      The dependency
     * @throws \Interop\Container\Exception\NotFoundException
     *      When the dependency doesn't exist
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException("'{$id}' not found...");
        }

        if (is_callable($this->container[$id])) {
            return $this->container[$id]($this);
        }

        return $this->container[$id];
    }

    /**
     * @param string $id
     *      The key of the dependency
     * @return bool
     *      True if it exists
     */
    public function has($id)
    {
        return array_key_exists($id, $this->container);
    }
}
