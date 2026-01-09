<?php

use App\Services\NameParser;

beforeEach(function () {
    $this->parser = new NameParser();
});

it('parses a single person with first and last name', function () {

    $result = $this->parser->parse('Mrs Jane McMaster');
    expect($result[0]->toArray())->toBe([
        'title' => 'Mrs',
        'first_name' => 'Jane',
        'initial' => null,
        'last_name' => 'McMaster',
    ]);
});


it('parses a single person with an initial and last name', function () {

    $result = $this->parser->parse('Mr F. Fredrickson');
    expect($result[0]->toArray())->toBe([
        'title' => 'Mr',
        'first_name' => null,
        'initial' => 'F',
        'last_name' => 'Fredrickson',
    ]);
});


it('parses multiple independent client joined by and', function () {

    $result = $this->parser->parse('Mr Tom Staff and Mr John Doe');
    expect(array_map(fn($client) => $client->toArray(), $result))->toBe([
        [
            'title' => 'Mr',
            'first_name' => 'Tom',
            'initial' => null,
            'last_name' => 'Staff',
        ],
        [
            'title' => 'Mr',
            'first_name' => 'John',
            'initial' => null,
            'last_name' => 'Doe',
        ],
    ]);
});


it('parses multiple client sharing only a surname', function () {

    $result = $this->parser->parse('Mr and Mrs Smith');
    expect(array_map(fn($client) => $client->toArray(), $result))->toBe([
        [
            'title' => 'Mr',
            'first_name' => null,
            'initial' => null,
            'last_name' => 'Smith',
        ],
        [
            'title' => 'Mrs',
            'first_name' => null,
            'initial' => null,
            'last_name' => 'Smith',
        ],
    ]);
});


it('parses multiple client sharing first and last name', function () {

    $result = $this->parser->parse('Dr & Mrs Joe Blogs');
    expect(array_map(fn($client) => $client->toArray(), $result))->toBe([
        [
            'title' => 'Dr',
            'first_name' => 'Joe',
            'initial' => null,
            'last_name' => 'Blogs',
        ],
        [
            'title' => 'Mrs',
            'first_name' => 'Joe',
            'initial' => null,
            'last_name' => 'Blogs',
        ],
    ]);
});


it('parses the names sample without missing records', function () {

    $parser = new NameParser();
    $rows = [
        'Mr John Smith',
        'Mrs Jane Smith',
        'Mister John Doe',
        'Mr Bob Lawblaw',
        'Mr and Mrs Smith',
        'Mr Craig Charles',
        'Mr M Mackie',
        'Mrs Jane McMaster',
        'Mr Tom Staff and Mr John Doe',
        'Dr P Gunn',
        'Dr & Mrs Joe Blogs',
        'Ms Claire Robo',
        'Prof Alex Brogan',
        'Mrs Faye Hughes-Eastwood',
        'Mr F. Fredrickson',
    ];

    $client = [];
    foreach ($rows as $row) {
        $client = array_merge($client, $parser->parse($row));
    }

    expect($client)
        ->toHaveCount(18)
        ->not->toBeEmpty();
});
