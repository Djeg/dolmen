<?php

namespace spec\Dolmen\Command\Event\Subscriber;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Dolmen\Context\Event\ContextValidationEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dolmen\Context\Contextable;
use Dolmen\Command\Launcher\LauncherEvents;

class MixtContextSubscriberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Command\Event\Subscriber\MixtContextSubscriber');
    }

    function it_is_an_event_subscriber()
    {
        $this->shouldHaveType('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    function it_set_up_all_context_data_as_default_option(
        ContextValidationEvent $event,
        OptionsResolverInterface $resolver,
        Contextable $context
    ) {
        $event->getResolver()->shouldBeCalled()->willReturn($resolver);
        $event->getContext()->shouldBeCalled()->willReturn($context);
        $context->toArray()->shouldBeCalled()->willReturn(['context' => 'parameters']);
        $resolver->setOptional(['context'])->shouldBeCalled();

        $this->mixtContextOptions($event);
    }

    function it_subscrive_to_launcher_validation_events()
    {
        $this::getSubscribedEvents()->shouldReturn([
            LauncherEvents::VALIDATE_INPUT => [
                ['mixtContextOptions', 19],
            ],
            LauncherEvents::VALIDATE_OUTPUT => [
                ['mixtContextOptions', 19],
            ]
        ]);
    }
}
