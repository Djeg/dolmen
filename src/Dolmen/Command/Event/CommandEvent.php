<?php

namespace Dolmen\Command\Event;

use Dolmen\Command\Commandable;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event Raise by a command launcher.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class CommandEvent extends Event
{
    /**
     * @var Commandable
     */
    private $command;

    /**
     * @param Commandable $command
     */
    public function __construct(Commandable $command)
    {
        $this->command = $command;
    }

    /**
     * Return the command subject.
     *
     * return Commandable
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param Commandable $command
     *
     * @return CommandEvent
     */
    public function setCommand(Commandable $command)
    {
        $this->command = $command;

        return $this;
    }
}
