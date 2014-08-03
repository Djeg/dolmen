<?php

namespace Dolmen\OptionsResolver\Factory;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Create new instances of options resolver.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class OptionsResolverFactory
{
    /**
     * @return OptionsResolver
     */
    public function create()
    {
        return new OptionsResolver;
    }
}
