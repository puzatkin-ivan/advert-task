<?php
namespace App\Controller;

use App\Entity\Advert;
use App\Service\AdvertService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AddAdvertController extends AbstractController
{
    /**
     * @Route("/ads", methods={"POST"})
     */
    public function add(Request $request, AdvertService $service): JsonResponse
    {
        try
        {
            $advertData = $request->request->all();
            $advert = $service->add($advertData);

            $response = [
                'message' => 'OK',
                'code' => '200',
                'data' => [
                    'id' => $advert->getId(),
                    'text' => $advert->getText(),
                    'banner' => $advert->getBanner(),
                ],
            ];
        }
        catch (\Exception $ex)
        {
            $response = [
                'message' => $ex->getMessage(),
                'code' => '400',
            ];
        }

        return new JsonResponse($response);
    }
}