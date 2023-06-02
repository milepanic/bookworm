<?php

namespace App\Console\Commands;

use App\Book;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    /** @var Client */
    private Client $elasticsearch;

    /**
     * Create a new command instance.
     *
     * @param Client $elasticsearch
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Indexing all models. This might take a while...');

        $bar = $this->output->createProgressBar(Book::count());

        $bar->start();

        foreach (Book::cursor() as $book) {
            $this->elasticsearch->index([
                'index' => $book->getSearchIndex(),
                'type' => $book->getSearchType(),
                'id' => $book->getKey(),
                'body' => $book->toSearchArray(),
            ]);

            $bar->advance();
        }

        $bar->finish();

        $this->info("\nDone!");

        return 0;
    }
}
