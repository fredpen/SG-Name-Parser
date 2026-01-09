<?php

namespace App\DTO;

final readonly class ClientDto
{
    public function __construct(
        public string  $title,
        public ?string $firstName,
        public ?string $initial,
        public ?string  $lastName,
    )
    {
    }


    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'first_name' => $this->firstName,
            'initial' => $this->initial,
            'last_name' => $this->lastName,
        ];
    }
}
