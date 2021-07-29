<?php

namespace App\Service;

use App\Entity\Advert;
use App\Repository\AdvertRepository;

class AdvertService
{
    /** @var AdvertRepository */
    private $repository;

    public function __construct(AdvertRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \Exception
     */
    public function add(array $advertData): Advert
    {
        $this->validateAdvertData($advertData);
        return $this->repository->addAdvert(
            $advertData['text'],
            $advertData['price'],
            $advertData['limit'],
            $advertData['banner']
        );
    }

    public function edit(int $id, array $advertData): Advert
    {
        $this->validateAdvertData($advertData);
        return $this->repository->editAdvert($id,
            $advertData['text'],
            $advertData['price'],
            $advertData['limit'],
            $advertData['banner']
        );
    }

    private function validateAdvertData(array $advertData): void
    {
        if (isset($advertData['text']) && empty($advertData['text']))
        {
            throw new \Exception('Text should not empty');
        }

        if (isset($advertData['price']) && $advertData['price'] <= 0)
        {
            throw new \Exception('Invalid price');
        }

        if (isset($advertData['limit']) && $advertData['limit'] <= 0)
        {
            throw new \Exception('Invalid limit');
        }

        if (isset($advertData['banner']) && is_link($advertData['banner']))
        {
            throw new \Exception('Invalid banner link');
        }
    }
}