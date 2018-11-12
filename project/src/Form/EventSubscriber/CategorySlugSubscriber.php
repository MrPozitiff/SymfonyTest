<?php
/** */
namespace App\Form\EventSubscriber;

use App\Utils\URLGenerator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class CategorySlugSubscriber
 */
class CategorySlugSubscriber implements EventSubscriberInterface
{
    /**
     * @var URLGenerator
     */
    private $slugGenerator;

    /**
     * @param URLGenerator $slugGenerator
     */
    public function __construct(URLGenerator $slugGenerator)
    {
        $this->slugGenerator = $slugGenerator;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'checkSlug',
        ];
    }

    public function checkSlug(FormEvent $event)
    {
//        $resource = $event->getData();
//        if ()
    }
}
