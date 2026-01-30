<?php
declare(strict_types=1);

namespace App\Infrastructure\Report\Repository;

use App\Domain\Report\Entity\Report;
use App\Domain\Report\Repository\ReportRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;
use ReflectionClass;

class ReportRepository extends ServiceEntityRepository implements ReportRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function save(Report $report): void
    {
        $this->getEntityManager()->persist($report);
        $this->getEntityManager()->flush();
    }

    public function getReport(int $id): Report
    {
        return $this->findBy(['id' => $id]);
    }
}
