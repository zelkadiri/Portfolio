<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ItemRepository;
use Twig\Environment;

class AdminPortfolioController extends AbstractController{

    public function __construct(ItemRepository $repository){
        $this->repository = $repository;
    }

    public function index(){
        $items = $this->repository->findAll();
        return $this->render('admin/portfolio/index.html.twig', compact('items'));
    }

}