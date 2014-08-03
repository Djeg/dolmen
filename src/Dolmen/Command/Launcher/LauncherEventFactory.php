<?php

namespace Dolmen\Command\Launcher;

use Dolmen\Command\Commandable;
use Dolmen\Command\Event\CommandEvent;
use Dolmen\Context\Contextable;
use Dolmen\Context\Event\ContextValidationEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Create several eventsfor the launcher.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class LauncherEventFactory
{
    /**
     * @param Commandable $command
     *
     * @return CommandEvent
     */
    public function createCommandEvent(Commandable $command)
    {
        return new CommandEvent($command);
    }

    /**
     * @param Commandable $command
     * @param Contextable $context
     *
     * @return ContextValidationEvent
     */
    public function createContextValidationEvent(
        Commandable              $command,
        Contextable              $context,
        OptionsResolverInterface $resolver
    ) {
        return new ContextValidationEvent($command, $context, $resolver);
    }
}
