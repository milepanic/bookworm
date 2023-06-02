<li class="col">
    <div class="product product__space product__space-primary border rounded-md bg-white mb-5">
        <div class="product__inner overflow-hidden p-3 p-md-4d875">
            <div class="d-block position-relative">
                <a href="{{ route('singleBook', [$book, 'term' => Request::get('term')]) }}" class="d-block">
                    <img
                        src="{{ $book->thumbnail }}"
                        class="d-block mx-auto attachment-shop_catalog size-shop_catalog img-fluid min-height-300"
                        alt="image-description">
                </a>
                <div class="product__body pt-3 bg-white">
                    <div class="text-capitalize font-size-1 mb-1 text-truncate">
                        <a href="{{ route('landing') }}">Paperbacc</a>
                    </div>
                    <h2 class="product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                        <a href="{{ route('singleBook', [$book, 'term' => Request::get('term')]) }}">{{ $book->title }}</a>
                    </h2>
                    <div class="font-size-2  mb-1 text-truncate">
                        <a href="{{ route('landing') }}" class="text-gray-700">
                            {{ optional($book->author)->name ?? 'No author' }}
                        </a>
                    </div>
                    <div class="price d-flex align-items-center font-weight-medium font-size-3">
                        @if($book->price == 0.00)
                            <div class="amount">FREE</div>
                        @else
                            <span class="amount">&euro;{{ $book->price }}</span>
                        @endif
                    </div>
                </div>
                <div class="product__hover d-flex align-items-center">
                    <a href="{{ route('singleBook', [$book, 'term' => Request::get('term')]) }}" class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                        <span class="product__add-to-cart">More Details</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</li>
