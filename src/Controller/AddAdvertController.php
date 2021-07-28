<?php
namespace App\Controller;

use App\Entity\Advert;
use App\Service\AdvertService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
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
            $advertData = $request->getContent();
            /** @var Advert $advert */
            $advert = $service->addAdvert($advertData);

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
                'code' => '404',
            ];
        }

        return new JsonResponse($response);
    }
}