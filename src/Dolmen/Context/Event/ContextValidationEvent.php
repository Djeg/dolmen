<?php

namespace Dolmen\Context\Event;

use Dolmen\Command\Commandable;
use Dolmen\Context\Contextable;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Event raised by the command launcher. Allow the context to be validate.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class ContextValidationEvent extends Event
{
    /**
     * @var Commandable
     */
    private $command;

    /**
     * @var Contextable
     */
    private $context;

    /**
     * @var OptionsResolverInterface
     */
    private $resolver;

    /**
     * @param Commandable $command
     * @param Contextable $context
     */
    public function __construct(
        Commandable $command,
        Contextable $context,
        OptionsResolverInterface $resolver
    ) {
        $this->command  = $command;
        $this->context  = $context;
        $this->resolver = $resolver;
    }

    /**
     * @return Commandable
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return Contextable
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param Contextable $context
     *
     * @return ContextValidationEvent
     */
    public function setContext(Contextable $context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return OptionsResolverInterface
     */
    public function getResolver()
    {
        return $this->resolver;
    }
}
