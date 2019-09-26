<?php

namespace App\Controller;

use App\Repository\PostCategoryRepository;
use App\Service\TwitterFeed;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PostCategoryRepository $categoryRepository
     * @param TwitterFeed $facebookFeed
     * @return Response
     */
    public function index(PostCategoryRepository $categoryRepository, TwitterFeed $facebookFeed)
    {
        return $this->render('home/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'feed' => $facebookFeed->getFeed("118385049558092")
        ]);
    }
}
