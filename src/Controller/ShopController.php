<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\ShopType;
use App\Service\GeocoderService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ShopRepository;

class ShopController extends AbstractController
{

	/**
	 * @Route("/shop/api", name="shops_api", methods={"GET"})
     *
	 * @param ShopRepository $shopRepository
	 * @return JsonResponse
	 */
	public function api(ShopRepository $shopRepository): JsonResponse
	{
		return new JsonResponse($shopRepository->findAll(), JsonResponse::HTTP_OK);
	}

    /**
     * @Route("/admin/shops", name="shops")
     *
     * @param ShopRepository $shopRepository
     * @return Response
     */
	public function index(ShopRepository $shopRepository): Response
    {
        return $this->render('shop/admin/index.html.twig', ['shops' => $shopRepository->findAll()]);
    }

    /**
     * @Route("/shop/new", name="shops_add")
     * @Route("/shop/edit/{id}", name="shops_edit")
     *
     * @param Shop $shop
     * @param Request $request
     * @param ObjectManager $manager
     * @param GeocoderService $geocoderService
     * @return Response
     */
	public function form(?Shop $shop, Request $request, ObjectManager $manager, GeocoderService $geocoderService): Response
    {
        $shop = $shop ?? new Shop();
        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $coordinate = $geocoderService->addressToCoordinate((string) $shop)->first();
            $shop->setLongitude($coordinate->getCoordinates()->getLongitude())
                ->setLatitude($coordinate->getCoordinates()->getLatitude());
            $manager->persist($shop);
            $manager->flush();

            //$this->redirectToRoute('home');
        }
        return $this->render('shop/add.html.twig', [
            'formShop' => $form->createView(),
            'newShop'  => $shop->getId() === null,
        ]);
    }

    /**
     * @Route("/admin/shop/delete/{id}", name="shop_delete")
     *
     * @param Shop $shop
     * @param ObjectManager $objectManager
     * @return RedirectResponse
     */
    public function delete(Shop $shop, ObjectManager $objectManager): RedirectResponse
    {
        $objectManager->remove($shop);
        return $this->redirectToRoute('shops');
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
