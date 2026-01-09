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

Generate application key:

```sh
php artisan key:generate
```


Running the program 

```sh
php artisan parse-names storage/app/examples.csv
```


Testing

```sh
./vendor/bin/pest tests/Unit/NameParserTest.php
```
