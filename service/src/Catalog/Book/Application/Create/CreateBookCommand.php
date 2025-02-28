<?php

declare(strict_types=1);

namespace App\Catalog\Book\Application\Create;

use App\Shared\Application\Bus\Command;

/** @see CreateBookCommandHandler */
final readonly class CreateBookCommand implements Command
{
    /**
     * @param list<string> $tags
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description,
        public array $tags,
    ) {}
}
