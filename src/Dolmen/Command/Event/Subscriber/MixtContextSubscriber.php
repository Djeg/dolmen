<?php

namespace Dolmen\Command\Event\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Dolmen\Context\Event\ContextValidationEvent;
use Dolmen\Command\Launcher\LauncherEvents;
use Dolmen\OptionsResolver\Factory\OptionsResolverFactory;

class MixtContextSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            LauncherEvents::VALIDATE_INPUT => [
                ['mixtContextOptions', 19]
            ],
            LauncherEvents::VALIDATE_OUTPUT => [
                ['mixtContextOptions', 19]
            ]
        ];
    }

    /**
     * Loop on each context data and make it as an optional option in the resolver.
     *
     * @param ContextValidationEvent $event
     */
    public function mixtContextOptions(ContextValidationEvent $event)
    {
        $resolver        = $event->getResolver();
        $optionalOptions = array_keys($event->getContext()->toArray());

        $resolver->setOptional($optionalOptions);
    }
}
