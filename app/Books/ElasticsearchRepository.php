<?php

namespace App\Books;

use App\Book;
use Elasticsearch\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class ElasticsearchRepository implements BooksRepository
{
    /** @var Client */
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = ''): LengthAwarePaginator
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    public function searchAjax(string $query = ''): array
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildJsonCollection($items);
    }

    private function searchOnElasticsearch(string $query): array
    {
        $model = new Book;

        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'description', 'author^2', 'price', 'date'],
                        'query' => $query,
                        'fuzziness' => 'auto',
                    ],
                ],
                'size' => 100,
            ],
        ]);
    }

    private function buildCollection(array $items): LengthAwarePaginator
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Book::whereIn('id', $ids)
            ->orderByRaw('FIELD(id,' . implode(',', $ids) . ')')
            ->paginate(Book::PAGINATION_PER_PAGE);
    }



    private function buildJsonCollection(array $items): array
    {
        return array_slice(Arr::pluck($items['hits']['hits'], '_source', '_id'), 0, 10, true);
    }
}
