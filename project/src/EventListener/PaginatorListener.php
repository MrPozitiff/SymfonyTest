<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\EventListener;

use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class PaginatorListener
 */
class PaginatorListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'app.category.index' => 'includeCount',
            'app.product.index' => 'includeCount',
        ];
    }

    public function includeCount(ResourceControllerEvent $event)
    {
//        $subject = $event->getSubject();
//        if ($subject instanceof Pagerfanta) {
//            dd($subject->getAdapter()->getNbResults());
//        }
//        dd($subject);
    }
}
