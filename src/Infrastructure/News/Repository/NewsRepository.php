<?php
declare(strict_types=1);

namespace App\Infrastructure\News\Repository;

use App\Domain\News\Entity\News;
use App\Domain\News\Repository\NewsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NewsRepository extends ServiceEntityRepository implements NewsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function findById(int $id): ?News
    {
        $qb = $this->createQueryBuilder('news')
            ->select('news')
            ->from('News', 'news')
            ->where('news.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1);
        $query = $qb->getQuery();
        return $query->getOneOrNullResult();
    }

    public function findByIds(array $ids): array
    {
        $qb = $this->createQueryBuilder('news')
            ->select('news')
            ->from('News', 'news')
            ->where('news.id IN (:ids)')
            ->setParameter('ids', $ids);
        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findAll(): array
    {
        $qb = $this->createQueryBuilder('news')
            ->select('news')
            ->from('News', 'news')
            ->orderBy('news.id', 'ASC');
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function save(News $news): void
    {
        $this->getEntityManager()->persist($news);
        $this->getEntityManager()->flush();
    }

}


