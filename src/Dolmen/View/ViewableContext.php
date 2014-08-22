<?php

namespace Dolmen\View;

use Dolmen\Context\Contextable;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
     * @param array       $options
     *
     * @return mixed
     */
    public function display(Contextable $context, array $options);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolverInterface $resolver);
}
