<?php

declare(strict_types=1);

namespace App\Tests\Catalog\Factory;

use App\Catalog\Domain\Model\Book\Book;
use Symfony\Component\Uid\Uuid;
use Zenstruck\Foundry\ObjectFactory;

/**
 * @extends ObjectFactory<Book>
 */
final class BookFactory extends ObjectFactory
{
    public static function class(): string
    {
        return Book::class;
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaults(): array
    {
        return [
            'id' => Uuid::v7(),
            'name' => self::faker()->text(),
        ];
    }

    protected function initialize(): static
    {
        return $this;
    }
}
