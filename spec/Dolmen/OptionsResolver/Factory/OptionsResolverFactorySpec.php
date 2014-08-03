<?php

namespace spec\Dolmen\OptionsResolver\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OptionsResolverFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\OptionsResolver\Factory\OptionsResolverFactory');
    }

    function it_create_new_instance_of_options_resolver()
    {
        $this->create()->shouldHaveType('Symfony\Component\OptionsResolver\OptionsResolver');
    }
}
