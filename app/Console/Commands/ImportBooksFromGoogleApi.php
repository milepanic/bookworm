<?php

namespace App\Console\Commands;

use App\Author;
use App\Book;
use Carbon\Carbon;
use Facades\App\Services\GetGoogleBooksApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ImportBooksFromGoogleApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:import';

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
        $this->info('Starting to import...');

        $totalItems = 874;

        $numberOfRequests = $totalItems / 40;

        $bar = $this->output->createProgressBar($totalItems);
        $bar->start();

        for ($i = 0; $i <= (int) $numberOfRequests; $i++) {
            $data = GetGoogleBooksApiService::handle($i * 40);
            if (! $data) {
                continue;
            }

            $data = json_decode($data)->items;

            foreach ($data as $bookData) {
                $imageLinksExist = optional($bookData->volumeInfo)->imageLinks;

                if ($imageLinksExist) {
                    $thumbnail = $bookData->volumeInfo->imageLinks->thumbnail;
                } else {
                    $thumbnail = 'https://rapidapi.com/static-assets/default/incognito.svg';
                }

                $publishedAt = null;
                if (optional($bookData->volumeInfo)->publishedDate) {
                    if (! Str::contains($bookData->volumeInfo->publishedDate, '?')) {
                        $publishedAt = Carbon::parse($bookData->volumeInfo->publishedDate)->toDateString();
                    }
                }

                $authorId = $this->createAuthor($bookData);

                Book::firstOrcreate(
                    [
                        'google_id' => $bookData->id,
                    ],
                    [
                        'title' => $bookData->volumeInfo->title,
                        'description' => $bookData->volumeInfo->description ?? null,
                        'published_at' => $publishedAt,
                        'price' => $bookData->saleInfo->retailPrice->amount ?? 0.00,
                        'preview_link' => $bookData->volumeInfo->previewLink,
                        'author_id' => $authorId,
                        'page_count' => $bookData->volumeInfo->pageCount ?? null,
                        'thumbnail' => $thumbnail,
                        'language' => $bookData->volumeInfo->language,
                    ]);

                $bar->advance();
            }
        }

        $bar->finish();
        $this->info(PHP_EOL . 'Done');

        return 0;
    }

    private function createAuthor($bookData)
    {
        $authorName = Arr::first(optional($bookData->volumeInfo)->authors);

        if (! $authorName) {
            return null;
        }

        $author = Author::firstOrCreate(['name' => $authorName]);

        return $author->id;
    }
}
