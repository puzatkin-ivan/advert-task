<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Service\AdvertService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditAdvertController extends AbstractController
{
    /**
     * @Route("/ads/{id}", methods={"POST"})
     * @param Request $request
     * @param AdvertService $service
     * @return JsonResponse
     */
    public function edit(Request $request, AdvertService $service): JsonResponse
    {
        try
        {
            $advertId = $request->get('id');
            $advertData = $request->request->all();
            $advert = $service->edit($advertId, $advertData);

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