<?php

namespace App\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $catRepository = $this->get('app.repository.category');
        return $this->render('Shop/main.html.twig', [
            'category' => $catRepository->findChildren('root'),
        ]);
    }
}
