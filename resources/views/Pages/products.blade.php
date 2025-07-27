@extends('layouts.main')
@section('head')
    <style>
        

.btn-custom {
    background-color: #FFC8C8;
    color: #000;
    border: none;
}
.btn-custom:hover {
    background-color: #FFC8C8;
    color: #000;
}
.score-wrap {
  position: relative;
  display: inline-block;
  font-size: 1.1rem;
  direction: ltr;
}

.stars-inactive {
  color: #e0e0e0;
}

.stars-active {
  color: #ffc107;
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;
  white-space: nowrap;
  width: 0%; /* يتم تغييره ديناميكياً */
}

.card-body {
    text-align: center;
}


#results {
  position: absolute; /* لتثبيتها أسفل حقل البحث */
  background-color: #FFC8C8;
  color: #000; /* لون نص مناسب */
  width: 100%; /* نفس عرض حقل البحث */
  max-height: 200px; /* ارتفاع أقصى مع تمرير */
  overflow-y: auto;
  border-radius: 0 0 4px 4px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  padding: 0;
  margin-top: 2px;
  list-style: none;
  z-index: 1000;
}

#results li {
  padding: 8px 12px;
  cursor: pointer;
}

#results li:hover {
  background-color: #e99699; /* لون خلفية عند المرور بالفأرة */
  color: #fff;
}
.custom-search-input {
  border: 2px solid #e06b6b;
  background-color: #FFC8C8;
  color: #000;
  border-radius: 8px;
  padding: 10px 15px;
  transition: all 0.3s ease;
  box-shadow: none;
}

.custom-search-input::placeholder {
  color: #a94442; /* لون نص placeholder */
}

.custom-search-input:focus {
  outline: none;
  border-color: #e06b6b;
  box-shadow: 0 0 5px rgba(224, 107, 107, 0.5);
  background-color: #ffeaea;
}

    </style>
@endsection
@section('content')
<div class="container mt-5" style="margin-top: 100px;">


   <form action="{{ route('search') }}" method="GET" id="searchForm">
 <div style="position: relative; width: 100%; max-width: 400px;">
  <input type="text" id="search" placeholder={{ __('message.search_placeholder') }}
       class="form-control custom-search-input" autocomplete="off">

  <ul id="results"></ul>
</div>
<div class="mt-5">

  <!-- سطر لكل select -->
  <div class="form-group col-12 mb-3">
    <select name="category" class="form-control border-danger">
      <option value="">{{ __('message.all_categories') }}</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
          {{ ucfirst($cat->name) }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-12 mb-3">
    <select name="priceRange" class="form-control border-danger">
      <option value="">{{ __('message.any_price') }}</option>
      <option value="under_50" {{ request('priceRange') == 'under_50' ? 'selected' : '' }}>{{ __('message.under_50') }}/option>
      <option value="50_100" {{ request('priceRange') == '50_100' ? 'selected' : '' }}>{{ __('message.50_100') }}</option>
      <option value="over_100" {{ request('priceRange') == 'over_100' ? 'selected' : '' }}>{{ __('message.over_100') }}</option>
    </select>
  </div>

  <div class="form-group col-12 mb-3">
    <select name="sort" class="form-control border-danger">
      <option value="">{{ __('message.Sort By') }}</option>
      <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('message.newest') }}</option>
      <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>{{ __('message.price_low_high') }}</option>
      <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>{{ __('message.price_high_low') }}</option>
      <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('message.rating') }}</option>
    </select>
  </div>

  <!-- الزر بسطر لوحده -->
  <div class="col-12 text-right">
    <button type="submit" class="btn btn-danger">{{ __('message.search_button') }}</button>
  </div>

</div>

    </div>
</form>

<div id="searchResults">
 

    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>

<!-- Products Grid -->
<div class="row mt-4">
    @forelse($products as $product)
      <div class="col-6 col-md-4 col-lg-3">
      
            <div class="card h-100 shadow-sm">
                <a href="{{ route('products.detailes', $product->id) }}" class="text-decoration-none text-dark">
                    <img src="{{ asset('images/' . $product->image) }}"
                      alt="{{ $product->name }}"
                      class="card-img-top img-fluid"
                      style="max-height: 250px; object-fit: contain;">

                </a>

                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                    <p class="text-danger font-weight-bold">{{ number_format($product->price) }} ل.س</p>

                    <!-- نجوم التقييم -->
                    <div class="mt-2 mb-3">
                        <span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width: {{ $product->rate() * 20 }}%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                            </div>
                        </span>
                    </div>

                    <!-- زر التفاصيل -->
                    <a href="{{ route('products.detailes', $product->id) }}" class="btn btn-custom w-75 mx-auto">{{ __('message.product_details') }}</a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-danger text-center" role="alert">
            {{ __('message.no_products') }}
        </div>
    @endforelse
</div>


<div class="d-flex justify-content-center mt-4">
    {{ $products->appends(request()->query())->links() }}
</div>

   
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // تحديث الحقل المخفي إذا موجود (اختياري)
    window.addEventListener('searchUpdated', function (event) {
      const hiddenInput = document.getElementById('hiddenSearchInput');
      if (hiddenInput) {
        hiddenInput.value = event.detail.search;
      }
    });

    // البحث المباشر عند الكتابة
    $('#search').on('input', function () {
      var query = $(this).val();

      if(query.length < 2) { 
        $('#results').empty(); 
        return; 
      }

      $.ajax({
        url: '{{ route("search") }}', // تأكد أن هذا هو مسار البحث الصحيح
        type: 'GET',
        data: { search: query },
        success: function(data) {
          $('#results').empty();

          if(data.length === 0){
            $('#results').append('<li>لا توجد نتائج</li>');
          } else {
            data.forEach(function(product){
              $('#results').append('<li><a href="/products/' + product.id + '">' + product.name + '</a></li>');
            });
          }
        },
        error: function(){
          $('#results').html('<li>حدث خطأ، حاول لاحقاً.</li>');
        }
      });
    });
  });
</script>
<script>
    $('#search').on('input', function () {
  var query = $(this).val().trim();

  if(query.length < 2) { 
    $('#results').empty().hide();  // نخفي القائمة إذا أقل من حرفين
    return; 
  }

  $.ajax({
    url: '{{ route("search") }}',
    type: 'GET',
    data: { search: query },
    success: function(data) {
      $('#results').empty().show();

      if(data.length === 0){
        $('#results').append('<li>لا توجد نتائج</li>');
      } else {
        data.forEach(function(product){
          $('#results').append('<li><a href="/products/' + product.id + '">' + product.name + '</a></li>');
        });
      }
    },
    error: function(){
      $('#results').html('<li>حدث خطأ، حاول لاحقاً.</li>').show();
    }
  });
});

</script>
@endsection
