<?php

namespace spec\Dolmen\Context;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContextSpec extends ObjectBehavior
{
    private $iterations = ['a', 'b', 'c', 'd'];

    function it_is_initializable()
    {
        $this->shouldHaveType('Dolmen\Context\Context');
    }

    function it_is_a_context()
    {
        $this->shouldHaveType('Dolmen\Context\Contextable');
    }

    function it_is_iterable()
    {
        $this->shouldHaveType('IteratorAggregate');

        foreach ($this->iterations as $value) {
            $this->set($value, $value);
        }

        $this->getIterator()->shouldIterateOverIterations();
    }

    function it_contains_attributes()
    {
        $this->set('foo', 'some value');
        $this->get('foo')->shouldReturn('some value');
        $this->get('bar')->shouldReturn(null);
        $this->get('bar', 'default value')->shouldReturn('default value');
        $this->get('foo', 'default value')->shouldReturn('some value');

        $this->has('foo')->shouldReturn(true);
        $this->has('bar')->shouldReturn(false);
    }

    function it_can_be_export_as_an_array()
    {
        $this->set('foo', 'bar');

        $this->toArray()->shouldReturn(['foo' => 'bar']);
    }

    function it_can_import_array()
    {
        $this->fromArray([
            'foo' => 'plop ?'
        ]);

        $this->get('foo')->shouldReturn('plop ?');
    }

    function getMatchers()
    {
        return [
            'iterateOverIterations' => function ($subject) {
                foreach ($subject as $key => $value) {
                    if (!in_array($key, $this->iterations)) {
                        return false;
                    }

                    if (!in_array($value, $this->iterations)) {
                        return false;
                    }
                }

                return true;
            }
        ];
    }
}
