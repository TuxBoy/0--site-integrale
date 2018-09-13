<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ShopRepository;

class ShopController extends AbstractController
{

	/**
	 * @Route("/shops", name="shops", methods={"GET"})
	 * @param ShopRepository $shopRepository
	 * @return JsonResponse
	 */
	public function index(ShopRepository $shopRepository): JsonResponse
	{
		return new JsonResponse($shopRepository->findAll(), JsonResponse::HTTP_OK);
	}

    /**
     * @Route("/", name="home")
	 *
	 * @return string
     */
    public function home(): Response
    {
        return $this->render('shop/index.html.twig');
    }

}
