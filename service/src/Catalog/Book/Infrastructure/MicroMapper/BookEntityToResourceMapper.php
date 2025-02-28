<?php

declare(strict_types=1);

namespace App\Catalog\Book\Infrastructure\MicroMapper;

use App\Catalog\Book\Infrastructure\Doctrine\BookEntity;
use App\Catalog\Book\Presentation\ApiPlatform\BookResource;
use App\Catalog\Tag\Presentation\ApiPlatform\TagResource;
use Symfonycasts\MicroMapper\AsMapper;
use Symfonycasts\MicroMapper\MapperInterface;
use Symfonycasts\MicroMapper\MicroMapperInterface;

#[AsMapper(from: BookEntity::class, to: BookResource::class)]
final readonly class BookEntityToResourceMapper implements MapperInterface
{
    public function __construct(
        private MicroMapperInterface $microMapper,
    ) {}

    public function load(object $from, string $toClass, array $context): BookResource
    {
        return new BookResource();
    }

    public function populate(object $from, object $to, array $context): BookResource
    {
        $entity = $from;
        \assert($entity instanceof BookEntity);
        $resource = $to;
        \assert($resource instanceof BookResource);

        $resource->id = $entity->id;
        $resource->name = $entity->name;
        $resource->description = $entity->description;
        $resource->tags = $this->microMapper->mapMultiple($entity->tags, TagResource::class);
        $resource->deleted = $entity->deleted;
        $resource->createdAt = $entity->createdAt;
        $resource->updatedAt = $entity->updatedAt;
        return $resource;
    }
}
