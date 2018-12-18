<?php
namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController{

    private $repository;
    public function __construct(ItemRepository $repository){
        $this->repository= $repository;
    }
    public function index(): Response{

        $items = $this->repository->findAll();
        return $this->render('portfolio/index.html.twig', [
            'current_menu' => 'portfolio',
            'items' => $items
        ]);
    }

    /**
     *@Route("/portfolio/{slug}-{id}", name="portfolio.show", requirements={"slug": "[a-z0-9\-]*"})
     *@return Response
     */
    public function show(Item $item, string $slug): Response{
       if($item->getSlug()!== $slug){
           return $this->redirectToRoute('portfolio.show', [
               'id' => $item->getId(),
               'slug' => $item->getSlug()
           ], 301);
       }

        return $this->render('portfolio/show.html.twig',[
            'current_menu'=> 'portfolio',
            'item' => $item
        ]);
    }
}