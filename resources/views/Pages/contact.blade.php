@extends('layouts.main')

@section('hero')
<section class="hero-section text-center py-2 position-relative overflow-hidden" data-aos="fade-up" data-aos-duration="1000" style="min-height: 200px;">
  <div class="floating-circles">
    <span></span><span></span><span></span><span></span>
  </div>

  <div class="container mb-2 position-relative">
    <h1 class="fw-bold" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" style="font-size: 2rem;">
       {{ __('message.Contact') }}
    </h1>
    <p class="lead mb-2" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800" style="font-size: 1rem;">
     {{ __('message.subtitle') }}
    </p>
  </div>
</section>
@endsection

@section('content')
<div class="container py-4">
  <div class="row gy-4">
   <div class="col-lg-6">
  <div 
    class="p-4 rounded shadow-sm bg-light h-100 {{ app()->getLocale() == 'ar' ? 'text-end' : 'text-start' }}" 
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
  >
    <h4 class="mb-3" style="color: #e06b6b;">{{ __('message.get_in_touch') }}</h4>
    <p>{{ __('message.english_paragraph') }}</p>
    <p class="text-muted">{{ __('message.arabic_paragraph') }}</p>

    @php
      $isArabic = app()->getLocale() == 'ar';
      $directionClass = $isArabic ? 'flex-row-reverse' : 'flex-row';
      $textAlign = $isArabic ? 'text-end' : 'text-start';
      $iconMarginClass = $isArabic ? 'ms-3' : 'me-3';  // ms=margin start, me=margin end في BS5
    @endphp

    <ul class="list-unstyled mt-4">
      <li class="mb-3 d-flex {{ $directionClass }} align-items-start">
        <i class="fas fa-envelope mt-1" style="color: #e06b6b; font-size: 1.2rem;"></i>
        <div class="{{ $textAlign }} {{ $iconMarginClass }}" style="min-width: 0;">
          <strong>{{ __('message.email') }}:</strong><br>contact@mayla.com
        </div>
      </li>

      <li class="mb-3 d-flex {{ $directionClass }} align-items-start">
        <i class="fas fa-phone mt-1" style="color: #e06b6b; font-size: 1.2rem;"></i>
        <div class="{{ $textAlign }} {{ $iconMarginClass }}" style="min-width: 0;">
          <strong>{{ __('message.phone') }}:</strong><br>+1-555-0199
        </div>
      </li>

      <li class="mb-3 d-flex {{ $directionClass }} align-items-start">
        <i class="fas fa-map-marker-alt mt-1" style="color: #e06b6b; font-size: 1.2rem;"></i>
        <div class="{{ $textAlign }} {{ $iconMarginClass }}" style="min-width: 0;">
          <strong>{{ __('message.address') }}:</strong><br>123 Beauty Street, New York, NY 10001
        </div>
      </li>

      <li class="mb-2 d-flex {{ $directionClass }} align-items-start">
        <i class="fas fa-clock mt-1" style="color: #e06b6b; font-size: 1.2rem;"></i>
        <div class="{{ $textAlign }} {{ $iconMarginClass }}" style="min-width: 0;">
          <strong>{{ __('message.hours') }}:</strong><br>
          {{ __('message.weekdays') }}<br>
          {{ __('message.saturday') }}<br>
          {{ __('message.sunday') }}
        </div>
      </li>
    </ul>
  </div>
</div>


    <!-- Box 2: Contact Form -->
    <div class="col-lg-6">
      <div class="p-4 rounded shadow-sm bg-light h-100">
        @livewire('contact-form')
      </div>
    </div>

  </div>
</div>
@endsection
