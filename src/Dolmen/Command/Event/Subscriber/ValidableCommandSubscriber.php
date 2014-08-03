<?php

namespace Dolmen\Command\Event\Subscriber;

use Dolmen\Command\Launcher\LauncherEvents;
use Dolmen\Context\Event\ContextValidationEvent;
use Dolmen\Context\ContextValidable;
use Dolmen\Command\Commandable;
use Dolmen\OptionsResolver\Factory\OptionsResolverFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Subscribe validation events.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class ValidableCommandSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            LauncherEvents::VALIDATE_INPUT => [
                ['resolveInputContextOptions', 20],
            ],
            LauncherEvents::VALIDATE_OUTPUT => [
                ['resolveOutputContextOptions', 20]
            ]
        ];
    }

    /**
     * Resolve and ensure that the context respect the options.
     *
     * @param ContextValidationEvent $event
     */
    public function resolveInputContextOptions(ContextValidationEvent $event)
    {
        $command = $event->getCommand();

        if (!$command instanceof ContextValidable) {
            return;
        }

        $command->configureContextInputOptions($event->getResolver());
    }

    /**
     * Resolve and ensure that the context respect the output options.
     *
     * @param ContextValidationEvent $event
     */
    public function resolveOutputContextOptions(ContextValidationEvent $event)
    {
        $command = $event->getCommand();

        if (!$command instanceof ContextValidable) {
            return;
        }

        $command->configureContextOutputOptions($event->getResolver());
    }
}
