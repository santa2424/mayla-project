@forelse($products as $product)
    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <a href="{{ route('products.detailes', $product->id) }}" class="text-decoration-none text-dark">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
            </a>

            <div class="card-body d-flex flex-column justify-content-between text-center">
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

                <a href="{{ route('products.detailes', $product->id) }}" class="btn btn-custom w-75 mx-auto">تفاصيل المنتج</a>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-danger text-center w-100" role="alert">
        لا يوجد منتجات حالياً، سيتم عرض المنتجات المتوفرة هنا.
    </div>
@endforelse
