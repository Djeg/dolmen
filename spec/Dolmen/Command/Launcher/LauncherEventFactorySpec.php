<?php

namespace spec\Dolmen\Command\Launcher;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Dolmen\Command\Event\CommandEvent;
use Dolmen\Context\Event\ContextValidationEvent;
use Dolmen\Command\Commandable;
use Dolmen\Context\Contextable;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LauncherEventFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Command\Launcher\LauncherEventFactory');
    }

    function it_create_a_command_event(Commandable $command)
    {
        $this->createCommandEvent($command)->shouldReturnFilledCommandEvent($command);
    }

    function it_create_a_context_validation_event(Commandable $command, Contextable $context, OptionsResolverInterface $resolver)
    {
        $this
            ->createContextValidationEvent($command, $context, $resolver)
            ->shouldReturnFilledContextValidationEvent($command, $context, $resolver)
        ;
    }

    function getMatchers()
    {
        return [
            'returnFilledCommandEvent' =>  function ($subject, $command) {
                return ($subject instanceof CommandEvent && $subject->getCommand() === $command);
            },
            'returnFilledContextValidationEvent' => function ($subject, $command, $context, $resolver) {
                return (
                    $subject instanceof ContextValidationEvent &&
                    $subject->getCommand() === $command &&
                    $subject->getContext() === $context &&
                    $subject->getResolver() === $resolver
                );
            }
        ];
    }
}
