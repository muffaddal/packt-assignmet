<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goose\Client as GooseClient;

class CalculateScrabbleScore extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrabble:score';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the scrabble score of words given';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $isURL = $this->confirm("Do you want the scrabble score from a URL?");

        if ($isURL) {

            $url = $this->ask("Please enter the URL you want the text to be extracted from.",
                'https://www.gutenberg.org/cache/epub/100/pg100.txt');
            $this->newLine(1);

            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $this->info("Your URL is valid! Fetching the words from the URL....Please wait...");
                $this->newLine(1);
                sleep(2);

                $goose = new GooseClient();
                $articleText = $goose->extractContent($url)->getDoc();

                $this->info("Yay! The Text has been extracted from the link! Please hang tight while we calculate the score for you.....");
                $this->newLine(1);
                sleep(1);

                $finalText = strip_tags($articleText);
                $textArray = explode(' ', $finalText);
            } else {
                $this->error("Your URL is Incorrect. Please try again with a Valid URL.");
                die();
            }


        } else {
            $scrabbleText = $this->ask('Enter Text you want the scrabble score for..');
            $textArray = explode(' ', $scrabbleText);

        }

        $this->getScore($textArray);
    }

    /**
     * @param $text
     * @return int|mixed|string
     */
    public function calculateScrabbleScore($text)
    {
        if (preg_match("/[^A-Za-z]/", $text) == 1) {
            return 0;
        } else {

            $characterArray = str_split(strtolower($text));
            $letterValues = config('scrabble.points');
            $score = 0;

            foreach ($characterArray as $char) {
                $score += $letterValues[ $char ];
            }

            return $score;
        }
    }

    /**
     * @param $string
     * @return array|string|string[]|null
     */
    public function clean($string)
    {
        $string = str_replace(' ', ' ', $string);

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    /**
     * @param $textArray
     */
    private function getScore($textArray): void
    {
        $scrabbleScore = [];
        foreach ($textArray as $text) {
            if ($text != "") {
                $sanitizedText = $this->clean($text);
                if ($sanitizedText != "") {
                    $scrabbleScore[] = $this->calculateScrabbleScore($sanitizedText);
                }
            }
        }

        if ( !empty($scrabbleScore)) {
            $this->info('Your Scrabble Score is : ' . array_sum($scrabbleScore));
        } else {
            $this->error("Error in calculating score. try again");
        }
    }
}
