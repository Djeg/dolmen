<?php

namespace Dolmen\Domain;

/**
 * Propose a simple implementation trait for a modelable object.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
trait DomainModel 
{
    /**
     * @var array
     */
    private $events = [];

    /**
     * @see \Dolmen\Domain\Modelable
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @see \Dolmen\Domain\Modelable
     */
    protected function addEvent($name, array $data = null)
    {
        $this->events[$name] = $data;

        return $this;
    }
}
