<?php

namespace spec\Dolmen\Context\Event;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Dolmen\Command\Commandable;
use Dolmen\Context\Contextable;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContextValidationEventSpec extends ObjectBehavior
{
    function let(Commandable $command, Contextable $context, OptionsResolverInterface $resolver)
    {
        $this->beConstructedWith($command, $context, $resolver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Context\Event\ContextValidationEvent');
    }

    function it_should_be_an_event()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\Event');
    }

    function it_contains_a_command_a_context_and_a_resolver($command, $context, $resolver)
    {
        $this->getCommand()->shouldReturn($command);
        $this->getContext()->shouldReturn($context);
        $this->getResolver()->shouldReturn($resolver);
    }

    function it_can_alterate_the_context(Contextable $context2)
    {
        $this->setContext($context2);

        $this->getContext()->shouldReturn($context2);
    }
}
