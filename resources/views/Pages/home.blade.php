@extends('layouts.main')

@section('hero')
<section class="hero-section text-center py-5 position-relative overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
  <!-- شكل دوائر متحركة خلفية -->
  <div class="floating-circles">
    <span></span><span></span><span></span><span></span>
  </div>

  <div class="container mb-4 position-relative">
      <h1 class="display-4 fw-bold" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
  Mayla Cosmetics
</h1>

<p class="lead mb-4" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">
  {{ __('message.Discover your natural beauty with our luxury cosmetics collection') }}
</p>

<a href="{{ route('products') }}" class="btn btn-light btn-lg px-4" 
   data-aos="zoom-in" data-aos-delay="700" data-aos-duration="800">
  {{ __('message.Shop Now') }}
</a>

  </div>
</section>

@endsection


@section('content')
<section class="py-5 bg-light text-center">
  <div class="container">
   
<div id="productsCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
   @foreach ($featuredProducts->chunk(6) as $chunkIndex => $chunk)
  <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
    <div class="row justify-content-center">
      @foreach ($chunk as $product)
       <div class="col-6 col-md-4 col-lg-2 d-flex">
  <div class="card mb-4 h-100 d-flex flex-column" style="width: 100%;">
    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
    <div class="card-body flex-grow-1 d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text text-truncate" style="max-height: 3em;">{{ $product->description }}</p>
      </div>
      <a href="{{ route('products.detailes', $product->id) }}" class="btn btn-block mt-2" style="background-color: #FFC8C8">  {{ __('message.Add To Cart') }}</a>
    </div>
  </div>
</div>

      @endforeach
    </div>
  </div>
@endforeach

  </div>

  <!-- Controls -->
  <a class="carousel-control-prev" href="#productsCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">{{ __('message.Previous') }}</span>
  </a>
  <a class="carousel-control-next" href="#productsCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">{{ __('message.Next') }}</span>
  </a>
</div>

 <!-- Title and Description -->
    <h2 class=" mb-3">{{ __('message.Featured Products') }}</h2>

<!-- Features Row -->
<div class="row">
  <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-delay="100">
    <div class="mb-3">
      <div class="icon-circle">
        <i class="fas fa-award"></i>
      </div>
    </div>
    <h5 class="fw-semibold">{{ __('message.Premium Quality') }}</h5>
    <p class="text-muted">{{ __('message.High-quality products from the finest brands') }}</p>
  </div>

  <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-delay="200">
    <div class="mb-3">
      <div class="icon-circle">
        <i class="fas fa-chart-line"></i>
      </div>
    </div>
    <h5 class="fw-semibold">{{ __('message.Latest Trends') }}</h5>
    <p class="text-muted">{{ __('message.Stay updated with the latest beauty and fashion trends')}}</p>
  </div>

  <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-delay="300">
    <div class="mb-3">
      <div class="icon-circle">
        <i class="fas fa-shopping-cart"></i>
      </div>
    </div>
    <h5 class="fw-semibold">{{ __('message.Safe Shopping') }}</h5>
    <p class="text-muted">{{ __('message.Shop safely with quality and authenticity guarantee') }}</p>
  </div>
</div>
    

    <!-- Button -->
<a href="{{ route('products') }}" class="btn button-products mb-5">{{ __('message.View All Products') }}</a>




  </div>
</section>
@endsection
