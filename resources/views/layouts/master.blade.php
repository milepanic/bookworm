<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/vendor/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick-carousel/slick/slick.css"') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/animate.css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/hs-megamenu/src/hs.megamenu.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <style>
        .search-result-box:hover {
            background-color: #f7f8f7;
        }
    </style>
</head>
<body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slick-carousel/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/vendor/multilevel-sliding-mobile-menu/dist/jquery.zeynep.js') }}"></script>
    <script src="{{ asset('assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/hs.core.js') }}"></script>
    <script src="{{ asset('assets/js/components/hs.unfold.js') }}"></script>
    <script src="{{ asset('assets/js/components/hs.malihu-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/components/hs.selectpicker.js') }}"></script>
    <script src="{{ asset('assets/js/components/hs.show-animation.js') }}"></script>


    <script>
        $(document).on('ready', function () {
            $('#search').on('keyup', function () {
                if ($('#search').val() === '') {
                    $('#search-results').empty();
                    return;
                }

                let data = {
                    term: $('#search').val()
                }

                $.ajax({
                    url: '{{ route('search') }}',
                    method: 'GET',
                    data: data,
                    success: function (data) {
                        $('#search-results').empty();

                        $.each(data, function (id, result) {
                            let bookDescription = result.description?.slice(0, 150);
                            if (bookDescription === undefined) {
                                bookDescription = '';
                            }

                            let bookPublishedAt = new Date(result.published_at).getFullYear();

                            let bookAuthor = result.author;
                            if (!bookAuthor) {
                                bookAuthor = 'No Author';
                            }

                            let url = '{{ url('book-single') }}/' + id;

                            $('#search-results').append(
                                '<a href="' + url + '" class="border search-result-box text-dark border-yellow-darker-1 row py-3 px-3 d-flex flex-column">\n' +
                                '     <div>\n' +
                                '           <span class="h-dark h6">' + result.title + '</span> / ' +
                                '           <span class="text-gray-700">' + bookAuthor + '</span> - ' +
                                '           <span class="text-gray-700">' + bookPublishedAt + '</span>\n' +
                                '     </div>\n' +
                                '     <small class="text-sm">' + bookDescription + '</small>\n' +
                                '     <small class="font-weight-medium">' + result.price + ' &euro;</small>\n' +
                                '</a>'
                            );
                        })

                    }
                })
            });

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // init zeynepjs
            var zeynep = $('.zeynep').zeynep({
                onClosed: function () {
                    // enable main wrapper element clicks on any its children element
                    $("body main").attr("style", "");

                    console.log('the side menu is closed.');
                },
                onOpened: function () {
                    // disable main wrapper element clicks on any its children element
                    $("body main").attr("style", "pointer-events: none;");

                    console.log('the side menu is opened.');
                }
            });

            // handle zeynep overlay click
            $(".zeynep-overlay").click(function () {
                zeynep.close();
            });

            // open side menu if the button is clicked
            $(".cat-menu").click(function () {
                if ($("html").hasClass("zeynep-opened")) {
                    zeynep.close();
                } else {
                    zeynep.open();
                }
            });
        });
    </script>
</body>
</html>
