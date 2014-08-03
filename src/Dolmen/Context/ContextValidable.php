<?php

namespace Dolmen\Context;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Add resolution of the context data on input/output.
 *
 * @see Commandable
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
interface ContextValidable
{
    /**
     * Defined the data and it's integrity before the context'm sent to this
     * command.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function configureContextInputOptions(OptionsResolverInterface $resolver);

    /**
     * Defined the data and it's integrity after the context'm execution.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function configureContextOutputOptions(OptionsResolverInterface $resolver);
}
