<?php

namespace spec\Dolmen\Command\Event\Subscriber;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Dolmen\Context\ContextValidable;
use Dolmen\Context\Event\ContextValidationEvent;
use Dolmen\Context\Contextable;
use Dolmen\OptionsResolver\Factory\OptionsResolverFactory;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dolmen\Command\Commandable;
use Dolmen\Command\Launcher\LauncherEvents;

class ValidableCommandSubscriberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Command\Event\Subscriber\ValidableCommandSubscriber');
    }

    function it_is_an_event_subscriber()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    function it_resolve_the_input_options_of_a_context_validable_command(
        ContextValidationEvent $event,
        ContextValidable $command,
        OptionsResolverInterface $resolver
    )
    {
        $event->getCommand()->shouldBeCalled()->willReturn($command);
        $event->getResolver()->shouldBeCalled()->willReturn($resolver);

        $command->configureContextInputOptions($resolver)->shouldBeCalled()->willReturn(null);

        $this->resolveInputContextOptions($event);
    }

    function it_resolve_the_output_options_of_a_context_validable_command(
        ContextValidationEvent $event,
        ContextValidable $command,
        OptionsResolverInterface $resolver
    )
    {
        $event->getCommand()->shouldBeCalled()->willReturn($command);
        $event->getResolver()->shouldBeCalled()->willReturn($resolver);

        $command->configureContextOutputOptions($resolver)->shouldBeCalled()->willReturn(null);

        $this->resolveOutputContextOptions($event);
    }

    function it_does_not_support_non_calidable_command(
        ContextValidationEvent $event,
        Commandable $command,
        $resolverFactory
    )
    {
        $event->getCommand()->shouldBeCalled()->willReturn($command);
        $event->getResolver()->shouldNotBeCalled();

        $this->resolveInputContextOptions($event);

        $event->getCommand()->shouldBeCalled()->willReturn($command);
        $event->getResolver()->shouldNotBeCalled();

        $this->resolveOutputContextOptions($event);
    }

    function it_subscribe_to_the_launcher_context_validation_events()
    {
        $this::getSubscribedEvents()->shouldReturn([
            LauncherEvents::VALIDATE_INPUT => [
                ['resolveInputContextOptions', 20]
            ],
            LauncherEvents::VALIDATE_OUTPUT => [
                ['resolveOutputContextOptions', 20]
            ]
        ]);
    }
}
