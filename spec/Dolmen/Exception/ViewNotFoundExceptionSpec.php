<?php

namespace spec\Dolmen\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ViewNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Exception\ViewNotFoundException');
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType('Exception');
    }
}
