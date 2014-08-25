<?php

namespace spec\Dolmen\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dolmen\Context\Contextable;

class TemplateViewSpec extends ObjectBehavior
{
    function let(EngineInterface $engine)
    {
        $this->beConstructedWith($engine);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\View\TemplateView');
    }

    function it_is_a_template_view()
    {
        $this->getName()->shouldReturn('template');
    }

    function it_contains_templates_options(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(['name'])->shouldBeCalled();
        $resolver->setDefaults(['parameters' => []])->shouldBeCalled();
        $resolver->setAllowedTypes(['name' => 'string', 'parameters' => 'array'])->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    function it_render_a_given_template(Contextable $context, $engine)
    {
        $context->toArray()->shouldBeCalled()->willReturn(['context content']);
        $engine->exists('template name')->shouldBeCalled()->willReturn(true);
        $engine->render('template name', [
            'additional' => 'parameters',
            'context'    => ['context content'],
        ])->shouldBeCalled()->willReturn('template content');

        $this->display($context, [
            'name' => 'template name',
            'parameters' => [
                'additional' => 'parameters'
            ]
        ]);
    }
}
