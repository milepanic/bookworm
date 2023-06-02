@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
    <section class="mb-8">
        <div class="container">
            <div class="pt-5 pb-5">
                <div class="bg-img-hero img-fluid rounded-md"
                    style="background-image: url(../../assets/img/library3.jpg); filter: grayscale(100%);">
                    <div class="px-4 px-md-6 px-lg-7 px-xl-10 d-flex min-height-530">
                        <div class="max-width-565 my-auto">
                            <div class="media">
                                <div class="media-body align-self-center mb-4 mb-lg-0">
                                    <h2 class="font-size-15 mb-3 pb-1">
                                        <span
                                            class="hero__title-line-1 font-weight-normal text-white d-block">Book Finder & Online Book Library</span>
                                        <span class="hero__title-line-2 font-weight-bold text-white d-block">{{ config('app.name') }}</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space-bottom-3">
        <div class="container">
            <header class="d-md-flex justify-content-between align-items-center mb-5">
                <h2 class="font-size-7 mb-4 mb-md-0">Trending Books</h2>
                <a href="{{ route('allBooks') }}" class="d-flex align-items-center h-primary">View All<span
                        class="flaticon-next font-size-3 ml-2"></span></a>
            </header>
            <ul class="products list-unstyled mb-0 row row-cols-2 row-cols-md-3 row-cols-xl-4 row-cols-wd-5">
                @foreach($books as $book)
                    @include('components.book')
                @endforeach
            </ul>
        </div>
    </section>
@endsection
