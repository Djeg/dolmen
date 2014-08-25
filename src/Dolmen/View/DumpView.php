<?php

namespace Dolmen\View;

use Dolmen\Context\Contextable;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * A simple dump view renderer for a context. It display the context
 * context in its integrality.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class DumpView implements ViewableContext
{
    /**
     * {@inheritdoc}
     */
    public function display(Contextable $context, array $options)
    {
        ob_start();

        var_dump($context);

        return ob_get_flush();
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolverInterface $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'text';
    }
}
