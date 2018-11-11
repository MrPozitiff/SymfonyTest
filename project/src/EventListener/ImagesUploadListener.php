<?php

namespace App\EventListener;

use App\Component\Model\ImagesAwareInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Event\PersistenceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ImagesUploadListener
 */
class ImagesUploadListener implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            'sonata.admin.event.persistence.pre_persist' => 'uploadImages',
            'sonata.admin.event.persistence.pre_update' => 'uploadImages',
        ];
    }

    /**
     * @param PersistenceEvent $event
     */
    public function uploadImages(PersistenceEvent $event): void
    {
        $subject = $event->getObject();
        if ($subject instanceof ImagesAwareInterface) {
            $this->uploadSubjectImages($subject);
        }
    }

    /**
     * @param ImagesAwareInterface $subject
     */
    private function uploadSubjectImages(ImagesAwareInterface $subject): void
    {
        $images = $subject->getImages();
        foreach ($images as $image) {
            if ($image->hasFile()) {
                $this->em->persist($image);
            }

            // Upload failed? Let's remove that image.
            if (null === $image->getPath()) {
                $images->removeElement($image);
            }
        }
    }
}
