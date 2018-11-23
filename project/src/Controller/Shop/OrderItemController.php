<?php

namespace App\Controller\Shop;

use App\Component\Model\OrderInterface;
use App\Component\Model\OrderItemInterface;
use App\Order\CartManager;
use App\Order\OrderModifierInterface;
use FOS\RestBundle\View\View;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderItemController extends ResourceController
{
    public const ADD = 'add';
    public const REMOVE = 'remove';

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request): Response
    {
        $cart = $this->getCurrentCart();
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, self::ADD);
        /** @var OrderItemInterface $orderItem */
        $orderItem = $this->newResourceFactory->create($configuration, $this->factory);

        $this->getOrderModifier()->addToOrder($cart, $orderItem);

        $cartManager = $this->getCartManager();
        $cartManager->saveCart($cart);

        $resourceControllerEvent = $this->eventDispatcher->dispatchPostEvent(self::ADD, $configuration, $orderItem);
        if ($resourceControllerEvent->hasResponse()) {
            return $resourceControllerEvent->getResponse();
        }

        $this->flashHelper->addSuccessFlash($configuration, self::ADD, $orderItem);

        $view = View::create()
            ->setData([
                'configuration' => $configuration,
                $this->metadata->getName() => $orderItem,
                'cart' => $cart,
            ])
            ->setTemplate($configuration->getTemplate(self::ADD . '.html'))
        ;

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function removeAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, self::REMOVE);
        /** @var OrderItemInterface $orderItem */
        $orderItem = $this->findOr404($configuration);

        $event = $this->eventDispatcher->dispatchPreEvent(self::REMOVE, $configuration, $orderItem);

        if ($configuration->isCsrfProtectionEnabled() && !$this->isCsrfTokenValid((string) $orderItem->getId(), $request->request->get('_csrf_token'))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }

        if ($event->isStopped() && !$configuration->isHtmlRequest()) {
            throw new HttpException($event->getErrorCode(), $event->getMessage());
        }
        if ($event->isStopped()) {
            $this->flashHelper->addFlashFromEvent($configuration, $event);

            return $this->redirectHandler->redirectToIndex($configuration, $orderItem);
        }

        $cart = $this->getCurrentCart();
        if ($cart !== $orderItem->getOrder()) {
            $this->addFlash('error', $this->get('translator')->trans('sylius.cart.cannot_modify', [], 'flashes'));

            if (!$configuration->isHtmlRequest()) {
                return $this->viewHandler->handle($configuration, View::create(null, Response::HTTP_NO_CONTENT));
            }

            return $this->redirectHandler->redirectToIndex($configuration, $orderItem);
        }

        $this->getOrderModifier()->removeFromOrder($cart, $orderItem);

        $this->repository->remove($orderItem);

        $cartManager = $this->getCartManager();
        $cartManager->saveCart($cart);

        $this->eventDispatcher->dispatchPostEvent(self::REMOVE, $configuration, $orderItem);

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create(null, Response::HTTP_NO_CONTENT));
        }

        $this->flashHelper->addSuccessFlash($configuration, self::REMOVE, $orderItem);

        $view = View::create()
            ->setData([
                'configuration' => $configuration,
                $this->metadata->getName() => $orderItem,
                'cart' => $cart,
            ])
            ->setTemplate($configuration->getTemplate(self::REMOVE . '.html'))
        ;

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @return OrderInterface
     */
    protected function getCurrentCart(): OrderInterface
    {
        return $this->getCartManager()->getCart();
    }

    /**
     * @return OrderModifierInterface
     */
    protected function getOrderModifier(): OrderModifierInterface
    {
        return $this->get('App\Order\OrderModifier');
    }

    /**
     * @return CartManager
     */
    protected function getCartManager(): CartManager
    {
        return $this->get('App\Order\CartManager');
    }
}
