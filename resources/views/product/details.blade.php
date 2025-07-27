@extends('layouts.main')
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        /* نجوم التقييم */
        .rating-star {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }
        .rating-star.checked {
            color: #ffc107; /* لون النجوم المضيئة */
        }
        .rating-star:hover,
        .rating-star:hover ~ .rating-star {
            color: #ffdb70;
        }

        /* تجاوب على الشاشات الصغيرة */
        @media (max-width: 768px) {
            .rating-star {
                font-size: 1.4rem !important;
            }
            .form input[type="number"] {
                width: 60px !important;
            }
            .card-header {
                font-size: 1.1rem !important;
                text-align: center !important;
            }
        }

    @media (max-width: 576px) {
    .card-body .row {
        flex-direction: column;
    }

    .col-md-6 {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
    }

    .form.text-center {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form input[type="number"] {
        margin-bottom: 10px;
    }

    .btn.addCart {
        width: 100%;
        max-width: 200px;
    }

    .table th, .table td {
        font-size: 0.9rem;
    }

    .rating-star {
        font-size: 1.2rem !important;
    }

    .img-thumbnail {
        margin-bottom: 15px;
    }
}
    </style>
@endsection
@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-10">
      <div class="card shadow-sm">
        <div class="card-header text-center fw-bold">عرض تفاصيل المنتج</div>

        <div class="card-body">
          <div class="row gy-4">
            <!-- صورة المنتج -->
            <div class="col-12 col-md-6 text-center">
              <img src="{{ asset('images/' . $product->image) }}"
                   alt="{{ $product->name }}"
                   class="img-fluid img-thumbnail mb-3"
                   style="max-width: 350px; width: 100%;">
            </div>

            <!-- تفاصيل المنتج -->
            <div class="col-12 col-md-6">
              @auth
              <div class="form text-center mb-3">
                                    <input id="productId" type="hidden" value="{{ $product->id }}">
                                    <span class="text-muted mb-3">
                                        <input class="form-control d-inline mx-auto" 
                                               id="quantity" name="quantity" type="number" 
                                               value="1" min="1" max="{{ $product->quantity }}" 
                                               style="width:20%;" required>
                                    </span>
                                    <button type="button" class="btn bg-cart addCart me-2" style="background-color:  #FFC8C8">
                                        <i class="fa fa-cart-plus"></i> AddToCart
                                    </button>
                                </div>
              @endauth

              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th>اسم المنتج</th>
                    <td class="lead"><b>{{ $product->name }}</b></td>
                  </tr>
                  @if ($product->category)
                  <tr>
                    <th>التصنيف</th>
                    <td>{{ $product->category->name }}</td>
                  </tr>
                  @endif
                  @if ($product->description)
                  <tr>
                    <th>الوصف</th>
                    <td>{{ $product->description }}</td>
                  </tr>
                  @endif
                  <tr>
                    <th>السعر</th>
                    <td>{{ number_format($product->price, 2) }} $</td>
                  </tr>
                  @if ($product->discount > 0)
                  <tr>
                    <th>الخصم</th>
                    <td>{{ $product->discount }} %</td>
                  </tr>
                  @endif
                  <tr>
                    <th>الكمية المتوفرة</th>
                    <td>{{ $product->quantity }}</td>
                  </tr>
                  <tr>
                    <th>تقييم المستخدمين</th>
                    <td>
                      <span class="score">
                        <div class="score-wrap">
                          <span class="stars-active">
                            @for ($i = 0; $i < 5; $i++)
                              <i class="fa fa-star" aria-hidden="true"></i>
                            @endfor
                          </span>
                          <span class="stars-inactive">
                            @for ($i = 0; $i < 5; $i++)
                              <i class="fa fa-star" aria-hidden="true"></i>
                            @endfor
                          </span>
                        </div>
                      </span>
                      <span>عدد المقيّمين {{ $product->ratings()->count() }} مستخدم</span>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <!-- تقييم المستخدم -->
          @auth
          <h4 class="mb-3 mt-4 text-center">قيّم هذا المنتج</h4>
          @if(auth()->user()->productRating($product))
          <div class="rating text-center">
            <span class="rating-star {{ auth()->user()->productRating($product)->value == 5 ? 'checked' : '' }}" data-value="5"></span>
            <span class="rating-star {{ auth()->user()->productRating($product)->value == 4 ? 'checked' : '' }}" data-value="4"></span>
            <span class="rating-star {{ auth()->user()->productRating($product)->value == 3 ? 'checked' : '' }}" data-value="3"></span>
            <span class="rating-star {{ auth()->user()->productRating($product)->value == 2 ? 'checked' : '' }}" data-value="2"></span>
            <span class="rating-star {{ auth()->user()->productRating($product)->value == 1 ? 'checked' : '' }}" data-value="1"></span>
          </div>
          @else
          <div class="rating text-center">
            <span class="rating-star" data-value="5"></span>
            <span class="rating-star" data-value="4"></span>
            <span class="rating-star" data-value="3"></span>
            <span class="rating-star" data-value="2"></span>
            <span class="rating-star" data-value="1"></span>
          </div>
          @endif
          @endauth

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {
    console.log("سكربت شغّال ✅");

    // تقييم النجوم
    $(document).on('click', '.rating-star', function () {
        let submitStars = $(this).data('value');
        console.log("تم الضغط على نجمة، القيمة: " + submitStars);

        $.ajax({
            type: 'POST',
            url: "{{ route('product.rate', ['product' => $product->id]) }}",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                value: submitStars
            },
            success: function () {
                toastr.success('تم التقييم بنجاح ✅');
                setTimeout(() => location.reload(), 1000);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                toastr.error('حدث خطأ أثناء التقييم ❌');
            }
        });
    });

    // إضافة للعربة
    $('.addCart').on('click', function(event) {
        event.preventDefault();
        console.log("زر إضافة للعربة شغّال ✅");

        var token = $('meta[name="csrf-token"]').attr('content');
        var url = "{{ route('cart.add') }}";
        var productId = $(this).closest(".form").find("#productId").val();
        var quantity = $(this).closest(".form").find("#quantity").val();

        $.ajax({
            method: 'POST',
            url: url,
            data: {
                quantity: quantity,
                id: productId,
                _token: token
            },
            success: function(data) {
                $('#cart-count').text(data.num_of_product);
                $('#cart-count-text').text(data.num_of_product + " منتج في العربة");
                toastr.success('تم إضافة المنتج بنجاح');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                toastr.error('حدث خطأ ما أثناء الإضافة');
            }
        });
    });
});
</script>
@endsection
