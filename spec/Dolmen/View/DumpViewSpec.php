<?php

namespace spec\Dolmen\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DumpViewSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\View\DumpView');
    }

    function it_is_a_view()
    {
        $this->shouldHaveType('Dolmen\View\ViewableContext');
    }
}
