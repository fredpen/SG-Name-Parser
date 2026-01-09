<?php

namespace App\Services;

use App\DTO\HomeOwnerDto;

class NameParser
{
    private string $titles = 'Mr|Mrs|Ms|Mister|Dr|Prof';

    private string $lastNameRegex = '[A-Z][a-z]+(?:[A-Z][a-z]+)*(?:-[A-Z][a-z]+)?';

    public function parse(string $raw): array
    {
        $people = [];
        $normalized = str_replace('&', 'and', trim($raw));

        // Shared surname - Mr and Mrs Smith
        if (preg_match("/^($this->titles)\s+and\s+($this->titles)\s+($this->lastNameRegex)$/", $normalized, $m)) {
            return [
                new HomeOwnerDto($m[1], null, null, $m[3]),
                new HomeOwnerDto($m[2], null, null, $m[3]),
            ];
        }

        // Shared surname but with first name - Dr and Mrs Joe Blogs
        if (preg_match("/^($this->titles)\s+and\s+($this->titles)\s+([A-Z][a-z]+)\s+($this->lastNameRegex)$/", $normalized, $m)) {
            return [
                new HomeOwnerDto($m[1], $m[3], null, $m[4]),
                new HomeOwnerDto($m[2], $m[3], null, $m[4]),
            ];
        }


        $segments = array_map('trim', explode(' and ', $normalized));
        foreach ($segments as $segment) {

            //Title + First + Last - Mr Fred Ola
            if (preg_match("/^($this->titles)\s+([A-Z][a-z]+)\s+($this->lastNameRegex)$/", $segment, $m)) {
                $people[] = new HomeOwnerDto($m[1], $m[2], null, $m[3]);
                continue;
            }

            // Title + Initial + Last  - Mr F. Fredrickson
            if (preg_match("/^($this->titles)\s+([A-Z])\.?\s+($this->lastNameRegex)$/", $segment, $m)) {
                $people[] = new HomeOwnerDto($m[1], null, $m[2], $m[3]);
            }
        }

        return $people;
    }
}
