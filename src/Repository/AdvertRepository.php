<?php

namespace App\Repository;

use App\Entity\Advert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
    }

    public function addAdvert(string $text, float $price, int $limit, string $banner): Advert
    {
        $advert = new Advert();
        $advert->setText($text);
        $advert->setPrice($price);
        $advert->setShowCount(0);
        $advert->setShowLimit($limit);
        $advert->setBanner($banner);

        $entityManager = $this->getEntityManager();
        $entityManager->persist($advert);
        $entityManager->flush();

        return $advert;
    }

    public function getAdvertByRelevant(): array
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->where('a.show_count < a.show_limit')
            ->orderBy('a.price', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}
