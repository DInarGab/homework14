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

    public function getByIds(array $ids): array
    {

        return $this->findBy(['id' => $ids]);
    }

    public function getAll(): array
    {
        return [];
    }

    public function save(News $news): void
    {
        $this->getEntityManager()->persist($news);
        $this->getEntityManager()->flush();
    }

}


