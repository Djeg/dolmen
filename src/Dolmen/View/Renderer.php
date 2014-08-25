<?php

namespace Dolmen\View;

use Dolmen\OptionsResolver\Factory\OptionsResolverFactory;
use Dolmen\View\ViewableContext;
use Dolmen\Context\Contextable;

/**
 * Render a given view.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class Renderer
{
    /**
     * @var OptionsResolverFactory
     */
    private $resolverFactory;

    /**
     * @param OptionsResolverFactory $resolverFactory
     */
    public function __construct(OptionsResolverFactory $resolverFactory = null)
    {
        $this->resolverFactory = $resolverFactory ?: new OptionsResolverFactory;
    }

    /**
     * @param ViewableContext $view
     * @param Contextable     $context
     * @param array           $options
     *
     * @return mixed, The view result
     */
    public function render(ViewableContext $view, Contextable $context, array $options)
    {
        $resolver = $this->resolverFactory->create();

        $view->configureOptions($resolver);

        $options = $resolver->resolve($options);

        return $view->display($context, $options);
    }
}
