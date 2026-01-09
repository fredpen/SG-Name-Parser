### Street Group Name Parser

## Installation

##### Dependencies

Note: PHP "^8.3" is required to run this project.


##### Clone the repo locally:

Open a terminal or a git client and clone the project using the code below

```sh
git clone https://github.com/cipdevng/ucard_core.git SG-Name-Parser
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
