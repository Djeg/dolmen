<?php

namespace spec\Dolmen\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MockModelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Domain\MockModel');
    }

    function it_is_a_modelable_object()
    {
        $this->shouldHaveType('Dolmen\Domain\DomainModelable');
    }

    function it_stack_events_when_it_does_something()
    {
        $this->getEvents()->shouldReturn([]);

        $this->doSomething();

        $this->getEvents()->shouldReturn(['do_something' => ['some event options']]);
    }
}
