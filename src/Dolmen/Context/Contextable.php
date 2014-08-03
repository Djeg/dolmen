<?php

namespace Dolmen\Context;

/**
 * Provide a simple way to pass data thrue commands, events etc ...
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
interface Contextable
{
    /**
     * Retrieve a context data.
     *
     * @param string $offset
     * @param string $defaultValue
     *
     * @return mixed|nul
     */
    public function get($offset, $defaultValue = null);

    /**
     * Set a context data.
     *
     * @param string $offset
     * @param mixed  $value
     *
     * @return Contextable
     */
    public function set($offset, $value);

    /**
     * Ask for a given data offset existence.
     *
     * @param string $offset
     *
     * @return boolean
     */
    public function has($offset);

    /**
     * Return the context data as an array.
     *
     * @return array
     */
    public function toArray();

    /**
     * Import and replace the context data by the given array.
     *
     * @param array $data
     *
     * @return Contextable
     */
    public function fromArray(array $data);
}
