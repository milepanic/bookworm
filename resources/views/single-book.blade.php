@extends('layouts.master')

@section('title', $book->title)

@section('content')
    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium mb-md-0 text-lh-lg">Book Details</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{ route('landing') }}" class="h-primary">Home</a>
                    <span class="breadcrumb-separator mx-1"> / </span>{{ $book->title }}
                </nav>
            </div>
        </div>
    </div>
    <div id="primary" class="content-area">
        <main id="main" class="site-main ">
            <div class="product">
                <div class="container mb-6">
                    <div class="row d-flex justify-content-center">
                        <div
                            class="col-md-4 col-lg-3">
                            <figure class="pt-8 mb-0">
                                <div class="js-slick-carousel u-slick">
                                    <img src="{{ $book->thumbnail }}" alt="Image Description"
                                        class="mx-auto img-fluid">
                                </div>
                            </figure>
                        </div>
                        <div class="col-md-8 col-lg-5 pl-0 summary entry-summary">
                            <div class="space-top-2 pl-4 pl-wd-6 px-wd-7 pb-5">
                                <h1 class="product_title entry-title font-size-7 mb-3">{{ $book->title }}</h1>
                                <div class="font-size-2 mb-4">
                                    <span class="font-weight-medium">
                                        {{ optional($book->author)->name ?? 'No author' }}
                                    </span>
                                </div>
                                <div class="font-size-2 mb-5">
                                    <p class="">{{ $book->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="ProductDetails" class="active">
        <div class="border-top border-bottom">
            <ul class="container tabs wc-tabs nav justify-content-md-center flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                <li class="flex-shrink-0 flex-md-shrink-1 nav-item">
                    <a class="nav-link py-4 font-weight-medium active text-dark" href="#ProductDetails">
                        Book Details
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content font-size-2 container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab pt-9">

                        <div class="table-responsive mb-4">
                            <table class="table table-hover table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="px-4 px-xl-5">Google Page:</th>
                                        <td>
                                            <a href="{{ $book->preview_link }}" target="_blank">
                                                Link
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 px-xl-5">Published at:</th>
                                        <td>{{ $book->published_at }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 px-xl-5">Page Count:</th>
                                        <td>{{ $book->page_count }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 px-xl-5">Language:</th>
                                        <td>{{ $book->language }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
