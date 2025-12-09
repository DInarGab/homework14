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
        return $this->findById($id);
    }

    public function findByIds(array $ids): array
    {

        return $this->findBy(['id' => $ids]);
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


