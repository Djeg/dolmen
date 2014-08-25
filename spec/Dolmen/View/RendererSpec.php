<?php

namespace spec\Dolmen\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Dolmen\OptionsResolver\Factory\OptionsResolverFactory;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dolmen\View\ViewableContext;
use Dolmen\Context\Contextable;

class RendererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\View\Renderer');
    }

    function it_render_a_view_with_a_given_context_and_options(
        OptionsResolverFactory $resolverFactory,
        OptionsResolverInterface $resolver,
        ViewableContext $view,
        Contextable $context
    )
    {
        $this->beConstructedWith($resolverFactory);
        $resolverFactory->create()->shouldBeCalled()->willReturn($resolver);

        $view->configureOptions($resolver)->shouldBeCalled();

        $resolver->resolve(['some options'])->shouldBeCalled()->willReturn(['valid options']);

        $view->display($context, ['valid options'])->shouldBeCalled()->willReturn('view content');

        $this->render($view, $context, ['some options'])->shouldReturn('view content');
    }
}
