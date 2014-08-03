<?php

namespace spec\Dolmen\Command\Launcher;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Dolmen\Command\Launcher\LauncherEventFactory;
use Dolmen\Command\Commandable;
use Dolmen\Context\Event\ContextValidationEvent;
use Dolmen\Command\Event\CommandEvent;
use Dolmen\Context\Contextable;
use Dolmen\Command\Launcher\LauncherEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dolmen\OptionsResolver\Factory\OptionsResolverFactory;

class LauncherSpec extends ObjectBehavior
{
    function let(
        EventDispatcher $dispatcher,
        LauncherEventFactory $eventFactory,
        CommandEvent $commandEvent,
        ContextValidationEvent $contextEvent,
        OptionsResolverFactory $resolverFactory
    )
    {
        $eventFactory->createCommandEvent(Argument::cetera())->willReturn($commandEvent);
        $eventFactory->createContextValidationEvent(Argument::cetera())->willReturn($contextEvent);

        $this->beConstructedWith($dispatcher, $eventFactory, $resolverFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Command\Launcher\Launcher');
    }

    function it_should_contains_commands(Commandable $command, Contextable $context)
    {
        $command->getName()->willReturn('foo');

        $this->addCommand($command);

        $this->shouldThrow('RuntimeException')->duringLaunch('bad command', $context);
        $this->shouldNotThrow('RuntimeException')->duringLaunch('foo', $context);
    }

    function it_raise_events_during_command_launchment(
        Commandable $command,
        Contextable $context,
        OptionsResolverInterface $resolver,
        $resolverFactory,
        $eventFactory,
        $dispatcher,
        $commandEvent,
        $contextEvent
    )
    {
        $resolverFactory->create()->shouldBeCalled()->willReturn($resolver);

        $eventFactory->createCommandEvent($command)->shouldBeCalled()->willReturn($commandEvent);
        $dispatcher->dispatch(LauncherEvents::PRE_EXECUTE, $commandEvent)->shouldBeCalled();
        $commandEvent->getCommand()->shouldBeCalled()->willReturn($command);

        $eventFactory->createContextValidationEvent($command, $context, $resolver)->shouldBeCalled()->willReturn($contextEvent);
        $dispatcher->dispatch(LauncherEvents::VALIDATE_INPUT, $contextEvent)->shouldBeCalled();
        $contextEvent->getContext()->shouldBeCalled()->willReturn($context);

        $context->toArray()->shouldBeCalled()->willReturn(['context parameters']);
        $resolver->resolve(['context parameters'])->shouldBeCalled()->willReturn(['resolved parameters']);
        $context->fromArray(['resolved parameters'])->shouldBeCalled();

        $command->execute($context)->shouldBeCalled();

        $dispatcher->dispatch(LauncherEvents::VALIDATE_OUTPUT, $contextEvent)->shouldBeCalled();

        $dispatcher->dispatch(LauncherEvents::POST_EXECUTE, $commandEvent)->shouldBeCalled();

        $command->getName()->willReturn('foo');
        $this->addCommand($command);

        $this->launch('foo', $context);
    }
}
