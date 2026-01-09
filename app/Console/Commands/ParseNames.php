<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NameParser;


class ParseNames extends Command
{
    protected $signature = 'parse-names {filePath}';
    protected $description = 'Parse CSV of names into individual people records';

    public function handle(NameParser $parser): int
    {
        $path = $this->argument('filePath');
        if (!file_exists($path)) {
            $this->error('File not found');
            return 1;
        }


        $output = [];
        $handle = fopen($path, 'r');

        while (($row = fgetcsv($handle)) !== false) {
            foreach ($row as $cell) {
                if (!$cell) continue;
                $parsedCell = $parser->parse($cell);
                $output = array_merge($output, $parsedCell);
            }
        }

        fclose($handle);

        $this->line(json_encode($output, JSON_PRETTY_PRINT));
        return 0;
    }
}
