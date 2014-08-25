<?php

namespace Dolmen\View;

use Dolmen\Context\Contextable;
use Symfony\Component\Templating\EngineInterface;
use Dolmen\Exception\ViewNotFoundException;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Render the context on a given template.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
class TemplateView implements ViewableContext
{
    /**
     * @var EngineInterface
     */
    var $engine;

    /**
     * @param EngineInterface $engine
     */
    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * {@inheritdoc}
     */
    public function display(Contextable $context, array $options)
    {
        if (!$this->engine->exists($options['name'])) {
            throw new ViewNotFoundException(sprintf(
                'Unable to find the template name %s.',
                $options['name']
            ));
        }

        return $this->engine->render($options['name'], array_merge(
            $options['parameters'],
            ['context' => $context->toArray()]
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(['name']);
        $resolver->setDefaults([
            'parameters' => []
        ]);
        $resolver->setAllowedTypes([
            'name'       => 'string',
            'parameters' => 'array'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'template';
    }
}
