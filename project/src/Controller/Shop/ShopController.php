<?php
/** */
namespace App\Controller\Shop;

use App\Locale\LocaleSwitcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ShopController
 */
class ShopController extends Controller
{
    /**
     * @var LocaleSwitcherInterface
     */
    private $localeSwitcher;

    /**
     * @param LocaleSwitcherInterface $localeSwitcher
     */
    public function __construct(LocaleSwitcherInterface $localeSwitcher)
    {
        $this->localeSwitcher = $localeSwitcher;
    }

    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('Shop/layout.html.twig');
    }
}
