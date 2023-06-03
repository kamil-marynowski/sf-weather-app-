<?php

namespace App\Repository;

use App\Entity\WeatherForecastSlot;
use App\Enum\WeatherForecastSlotType;
use DateInterval;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeatherForecastSlot>
 *
 * @method WeatherForecastSlot|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherForecastSlot|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherForecastSlot[]    findAll()
 * @method WeatherForecastSlot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherForecastSlotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherForecastSlot::class);
    }

    public function save(WeatherForecastSlot $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WeatherForecastSlot $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return WeatherForecastSlot[] Returns an array of WeatherForecastSlot objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WeatherForecastSlot
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function getSlotsForNext12Days()
    {
        $todayDatetime = new DateTimeImmutable('midnight');

        return $this->createQueryBuilder('wfs')
            ->andWhere('wfs.type_id = :type_id')
            ->setParameter('type_id', WeatherForecastSlotType::DAILY->value)
            ->andWhere('wfs.datetime >= :today_datetime')
            ->setParameter('today_datetime', $todayDatetime)
            ->andWhere('wfs.datetime <= :day_plus_12_datetime')
            ->setParameter('day_plus_12_datetime', $todayDatetime->add((new DateInterval('P12D'))))
            ->getQuery()
            ->getResult();
    }
}
