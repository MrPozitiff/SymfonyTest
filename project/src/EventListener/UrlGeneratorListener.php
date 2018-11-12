<?php

namespace App\EventListener;

use App\Component\Model\CategoryInterface;
use App\Component\Model\ProductInterface;
use App\Utils\URLGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Event\PersistenceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Webmozart\Assert\Assert;

/**
 * Class UrlGeneratorListener
 */
class UrlGeneratorListener implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var URLGenerator
     */
    private $URLGenerator;

    /**
     * @param EntityManagerInterface $entityManager
     * @param URLGenerator $URLGenerator
     */
    public function __construct(EntityManagerInterface $entityManager, URLGenerator $URLGenerator)
    {
        $this->URLGenerator = $URLGenerator;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            'sonata.admin.event.persistence.pre_persist' => 'generateUrlPath',
            'sonata.admin.event.persistence.pre_update' => 'generateUrlPath',
        ];
    }

    /**
     * @param PersistenceEvent $event
     */
    public function generateUrlPath(PersistenceEvent $event): void
    {
        $subject = $event->getObject();
        if ($subject instanceof CategoryInterface) {
            $this->generateCategoryUrl($subject);
        }
        if ($subject instanceof ProductInterface) {
            $this->generateProductUrl($subject);
        }
    }

    private function generateCategoryUrl(CategoryInterface $category)
    {
        if (empty($category->getSlug())) {
            Assert::notEmpty($category->getName(), 'Cannot generate slug without a name.');
            $category->setSlug($this->URLGenerator->transliterate($category->getName()));
        }
        $url = $this->URLGenerator->generateForCategory($category);
        if ($url === $category->getUrl()) {
            return;
        }
        $category->setUrl($url);
        $this->entityManager->persist($category);
        if (!$category->getChildren()->isEmpty()) {
            foreach ($category->getChildren() as $child) {
                $this->generateCategoryUrl($child);
            }
        }
        if (!$category->getProducts()->isEmpty()) {
            foreach ($category->getProducts() as $product) {
                $this->generateProductUrl($product);
            }
        }
    }

    /**
     * @param ProductInterface $product
     *
     * @return string
     */
    private function generateProductUrl(ProductInterface $product)
    {
        if (empty($product->getSlug())) {
            Assert::notEmpty($product->getName(), 'Cannot generate slug without a name.');
            $product->setSlug($this->URLGenerator->transliterate($product->getName()));
        }
        $product->setUrl($this->URLGenerator->generateForProduct($product));
        $this->entityManager->persist($product);
    }
}
