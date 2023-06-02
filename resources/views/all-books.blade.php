@extends('layouts.master')

@section('title', 'All books')

@section('content')
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">All Books</h1>
                <nav class="font-size-2">
                    <a href="{{ route('landing') }}" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"> / </span>All Books
                </nav>
            </div>
        </div>
    </div>
    <div class="site-content" id="content">
        <div class="container">
            <div class="row">
                <div id="primary" class="content-area order-2">
                    <div
                        class="shop-control-bar d-lg-flex justify-content-between align-items-center mb-5 text-center text-md-left">
                        <div class="shop-control-bar__left mb-4 m-lg-0">
                            <p class="woocommerce-result-count m-0">Showing 1–12 of 126 results</p>
                        </div>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel"
                            aria-labelledby="pills-one-example1-tab">

                            <ul class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-xl-5 border-top border-left mb-6">
                                @foreach ($books as $book)
                                    @include('components.book-2')
                                @endforeach
                            </ul>

                        </div>
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination__custom justify-content-md-center flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                            <li class="flex-shrink-0 flex-md-shrink-1 page-item"><a class="page-link"
                                    href="#">Previous</a></li>
                            <li class="flex-shrink-0 flex-md-shrink-1 page-item"><a class="page-link" href="#">1</a>
                            </li>
                            <li class="flex-shrink-0 flex-md-shrink-1 page-item"><a class="page-link" href="#">2</a>
                            </li>
                            <li class="flex-shrink-0 flex-md-shrink-1 page-item active" aria-current="page"><a
                                    class="page-link" href="#">3</a></li>
                            <li class="flex-shrink-0 flex-md-shrink-1 page-item"><a class="page-link" href="#">4</a>
                            </li>
                            <li class="flex-shrink-0 flex-md-shrink-1 page-item"><a class="page-link" href="#">5</a>
                            </li>
                            <li class="flex-shrink-0 flex-md-shrink-1 page-item"><a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                </div>
            </div>
        </div>
    </div>
@endsection
