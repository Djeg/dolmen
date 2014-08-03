<?php

namespace Dolmen\View;

use Dolmen\Context\Contextable;

/**
 * Defined the behavior of a context view.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
interface ViewableContext
{
    /**
     * Display a context for a given view.
     *
     * @param Contextable $context
     *
     * @return mixed
     */
    public function display(Contextable $context);

    /**
     * @return string
     */
    public function getName();
}
