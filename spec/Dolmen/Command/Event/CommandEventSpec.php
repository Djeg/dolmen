<?php

namespace spec\Dolmen\Command\Event;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Dolmen\Command\Commandable;

class CommandEventSpec extends ObjectBehavior
{
    function let(Commandable $command)
    {
        $this->beConstructedWith($command);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Command\Event\CommandEvent');
    }

    function it_should_be_an_event()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\Event');
    }

    function it_contains_a_command_that_can_be_override($command, Commandable $command2)
    {
        $this->getCommand()->shouldReturn($command);
        $this->setCommand($command2);

        $this->getCommand()->shouldReturn($command2);
    }
}
