<?php

namespace Dolmen\Domain;

/**
 * Defined the behavior of a standard dolmen domain model object.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
interface DomainModelable 
{
    /**
     * Should return the event queu of that model and clear
     *
     * @return array
     */
    public function getEvents();
}
