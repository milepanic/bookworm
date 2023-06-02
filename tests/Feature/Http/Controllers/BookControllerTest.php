<?php

namespace Tests\Feature\Http\Controllers;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BookController
 */
class BookControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $books = factory(Book::class, 3)->create();

        $response = $this->get(route('book.index'));

        $response->assertOk();
        $response->assertViewIs('book.index');
        $response->assertViewHas('books');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('book.create'));

        $response->assertOk();
        $response->assertViewIs('book.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BookController::class,
            'store',
            \App\Http\Requests\BookStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $google_id = $this->faker->word;
        $title = $this->faker->sentence(4);
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $preview_link = $this->faker->word;
        $thumbnail = $this->faker->word;
        $language = $this->faker->word;

        $response = $this->post(route('book.store'), [
            'google_id' => $google_id,
            'title' => $title,
            'price' => $price,
            'preview_link' => $preview_link,
            'thumbnail' => $thumbnail,
            'language' => $language,
        ]);

        $books = Book::query()
            ->where('google_id', $google_id)
            ->where('title', $title)
            ->where('price', $price)
            ->where('preview_link', $preview_link)
            ->where('thumbnail', $thumbnail)
            ->where('language', $language)
            ->get();
        $this->assertCount(1, $books);
        $book = $books->first();

        $response->assertRedirect(route('book.index'));
        $response->assertSessionHas('book.id', $book->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $book = factory(Book::class)->create();

        $response = $this->get(route('book.show', $book));

        $response->assertOk();
        $response->assertViewIs('book.show');
        $response->assertViewHas('book');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $book = factory(Book::class)->create();

        $response = $this->get(route('book.edit', $book));

        $response->assertOk();
        $response->assertViewIs('book.edit');
        $response->assertViewHas('book');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BookController::class,
            'update',
            \App\Http\Requests\BookUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $book = factory(Book::class)->create();
        $google_id = $this->faker->word;
        $title = $this->faker->sentence(4);
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $preview_link = $this->faker->word;
        $thumbnail = $this->faker->word;
        $language = $this->faker->word;

        $response = $this->put(route('book.update', $book), [
            'google_id' => $google_id,
            'title' => $title,
            'price' => $price,
            'preview_link' => $preview_link,
            'thumbnail' => $thumbnail,
            'language' => $language,
        ]);

        $book->refresh();

        $response->assertRedirect(route('book.index'));
        $response->assertSessionHas('book.id', $book->id);

        $this->assertEquals($google_id, $book->google_id);
        $this->assertEquals($title, $book->title);
        $this->assertEquals($price, $book->price);
        $this->assertEquals($preview_link, $book->preview_link);
        $this->assertEquals($thumbnail, $book->thumbnail);
        $this->assertEquals($language, $book->language);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $book = factory(Book::class)->create();

        $response = $this->delete(route('book.destroy', $book));

        $response->assertRedirect(route('book.index'));

        $this->assertDeleted($book);
    }
}
