<?php

namespace Dolmen\Domain;

use Dolmen\Domain\Modelable;

/**
 * A basic implementation of the Modelable interface with the model trait. It's
 * just use in order to test the Model trait implementation.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class MockModel implements DomainModelable
{
    use DomainModel;

    public function doSomething()
    {
        $this->addEvent('do_something', ['some event options']);
    }
}
