<?php

namespace Dolmen\Context;

/**
 * A basic context implementation.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class Context implements Contextable, \IteratorAggregate
{
    /**
     * @var array
     */
    private $attributes;

    public function __construct()
    {
        $this->attributes = [];
    }

    /**
     * {@inheritdoc}
     */
    public function get($offset, $defaultValue = null)
    {
        return isset($this->attributes[$offset]) ?
            $this->attributes[$offset] :
            $defaultValue
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function set($offset, $value)
    {
        $this->attributes[$offset] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has($offset)
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function fromArray(array $data)
    {
        $this->attributes = $data;

        return $this;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->attributes);
    }
}
