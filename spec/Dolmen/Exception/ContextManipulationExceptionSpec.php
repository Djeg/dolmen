<?php

namespace spec\Dolmen\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContextManipulationExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Exception\ContextManipulationException');
    }

    function it_shoould_be_an_exception()
    {
        $this->shouldHaveType('Exception');
    }
}
