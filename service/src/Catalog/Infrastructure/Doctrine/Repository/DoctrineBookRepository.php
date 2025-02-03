<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Doctrine\Repository;

use App\Catalog\Domain\Model\Book\BookReadModelRepository;
use App\Catalog\Presentation\ApiPlatform\Book\Resource\BookQueryResource;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineBookRepository implements BookReadModelRepository
{
    /** @var class-string */
    private const string ENTITY_CLASS = BookQueryResource::class;
    private const string ALIAS = 'books';

    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function exists(Criteria $criteria): bool
    {
        $result = $this->entityManager->createQueryBuilder()
            ->select(self::ALIAS . '.id')
            ->from(self::ENTITY_CLASS, self::ALIAS)
            ->addCriteria($criteria)
            ->getQuery()
            ->getOneOrNullResult();

        return $result !== null;
    }
}
