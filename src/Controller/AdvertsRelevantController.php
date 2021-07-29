<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdvertsRelevantController extends AbstractController
{
    /**
     * @Route("/ads/relevant", methods={"GET"})
     */
    public function getAdvert(AdvertRepository $repository): JsonResponse
    {
        try
        {
            $ads = $repository->getAdvertByRelevant();

            $response = [
                'message' => 'OK',
                'code' => '200',
                'data' => $this->processAdvert($ads),
            ];
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        catch (\Exception $exception)
        {
            $response = [
                'message' => $exception->getMessage(),
                'code' => '400',
            ];
        }

        return new JsonResponse($response);
    }

    public function processAdvert(array $ads): array
    {
        $result = [];
        /** @var Advert $advert */
        foreach ($ads as $advert)
        {
            $result[] = [
                'id' => $advert->getId(),
                'text' => $advert->getText(),
                'banner' => $advert->getBanner(),
            ];
            $advert->incrementShowCount();
        }
        return $result;
    }
}