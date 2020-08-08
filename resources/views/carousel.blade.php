<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        /* display 3 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }
    </style>

</head>

<body>
    <div class="container my-3">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    <div class="carousel-item active">
                        <div class="col-md-4">
                            @include('member.card_percetakan')
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            @include('member.card_percetakan')
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            @include('member.card_percetakan')
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            @include('member.card_percetakan')
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            @include('member.card_percetakan')
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-4">
                            @include('member.card_percetakan')
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                        aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </div>
</body>
<script>
    $('#recipeCarousel').carousel({
  interval: 10000
})

$('.carousel .carousel-item').each(function(){
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
    next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
        	next = $(this).siblings(':first');
      	}

        next.children(':first-child').clone().appendTo($(this));
      }
});
</script>

</html>
