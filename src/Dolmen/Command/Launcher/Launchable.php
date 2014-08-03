<?php

namespace Dolmen\Command\Launcher;

use Dolmen\Context\Contextable;
use Dolmen\Command\Commandable;

/**
 * Defined how a suit of command can be launched.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
interface Launchable
{
    /**
     * Launch a command with the given context.
     *
     * @param string      $name
     * @param Contextable $context
     */
    public function launch($name, Contextable $context);

    /**
     * Add a command to this launcher.
     *
     * @param Commandable $command
     */
    public function addCommand(Commandable $command);
}
