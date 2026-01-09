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
