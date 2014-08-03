<?php

namespace Dolmen\Command;

use Dolmen\Context\Contextable;

/**
 * The command is the entry point of a Dolmen application. It has the purpose
 * to handle a certain part of a Domain.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
interface Commandable
{
    /**
     * @param Contextable $context
     */
    public function execute(Contextable $context);

    /**
     * Return a simple command identifier.
     *
     * @return string
     */
    public function getName();
}
