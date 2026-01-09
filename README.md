### Street Group Name Parser

## Installation

##### Dependencies

PHP "^8.2" and composer is required to run this project on your machine.

##### Clone the repo locally:

Open a terminal or a git client and clone the project using the code below

```sh
git clone https://github.com/fredpen/SG-Name-Parser SG-Name-Parser
```

Enter into the project directory

```sh
cd SG-Name-Parser
```

Install PHP dependencies:

```sh
composer install
```

Running the program

The program can run any csv file with a valid file path, the sample file can be run using the command below

```sh
php artisan parse-names resources/homeowners/examples.csv
```

Testing

```sh
./vendor/bin/pest tests/Unit/NameParserTest.php
```


#### Technical Decisions

I chose a console command to keep the solution simple, stateless, and easy to run with minimal set up.
A small immutable DTO was introduced to make the parsed homeowner data explicit and type-safe,
while regex-based parsing was used because the input format is tightly constrained and rule-driven.
Automated Pest tests cover each known name pattern to ensure correctness.
