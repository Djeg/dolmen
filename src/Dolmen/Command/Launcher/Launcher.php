<?php

namespace Dolmen\Command\Launcher;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Dolmen\Command\Commandable;
use Dolmen\Context\Contextable;
use Dolmen\OptionsResolver\Factory\OptionsResolverFactory;

/**
 * Contains a list of commands and can launch the command properly.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class Launcher implements Launchable
{
    /**
     * @var array
     */
    private $commands;

    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @var LauncherEventFactory
     */
    private $eventFactory;

    /**
     * @var OptionsResolverFactory
     */
    private $resolverFactory;

    /**
     * @param EventDispatcher $dispatcher
     */
    public function __construct(
        EventDispatcher        $dispatcher,
        LauncherEventFactory   $eventFactory = null,
        OptionsResolverFactory $resolverFactory = null
    ) {
        $this->dispatcher      = $dispatcher;
        $this->commands        = [];
        $this->eventFactory    = $eventFactory ?: new LauncherEventFactory;
        $this->resolverFactory = $resolverFactory ?: new OptionsResolverFactory;
    }

    /**
     * @param Commandable $command
     *
     * @return Launcher
     */
    public function addCommand(Commandable $command)
    {
        $this->commands[$command->getName()] = $command;

        return $this;
    }

    /**
     * Execute the command with the given name.
     *
     * @throws \RuntimeException, If the command doesn't exists.
     *
     * @param string      $name
     * @param Contextable $context
     */
    public function launch($name, Contextable $context)
    {
        if (!isset($this->commands[$name])) {
            throw new \RuntimeException(sprintf(
                'Trying to execute a non existent command named %s.',
                $name
            ));
        }

        $command = $this->commands[$name];

        // raise the first events
        $event = $this->eventFactory->createCommandEvent($command);
        $this->dispatcher->dispatch(LauncherEvents::PRE_EXECUTE, $event);
        $command = $event->getCommand();

        // validate the context before executes the command
        $resolver = $this->resolverFactory->create();
        $event = $this->eventFactory->createContextValidationEvent($command, $context, $resolver);
        $this->dispatcher->dispatch(LauncherEvents::VALIDATE_INPUT, $event);
        $context = $event->getContext();

        // validate context
        $parameters = $resolver->resolve($context->toArray());
        $context->fromArray($parameters);

        // execute the command
        $command->execute($context);

        // validate the context after the command execution
        $resolver = $this->resolverFactory->create();
        $event = $this->eventFactory->createContextValidationEvent($command, $context, $resolver);
        $this->dispatcher->dispatch(LauncherEvents::VALIDATE_OUTPUT, $event);
        $context = $event->getContext();

        // validate context again
        $parameters = $resolver->resolve($context->toArray());
        $context->fromArray($parameters);

        // finally dispatch a post execution event
        $event = $this->eventFactory->createCommandEvent($command);
        $this->dispatcher->dispatch(LauncherEvents::POST_EXECUTE, $event);
        $this->commands[$name] = $event->getCommand();
    }
}
