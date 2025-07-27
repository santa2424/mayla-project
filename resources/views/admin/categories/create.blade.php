@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- يجعلها مناسبة للهاتف والتابلت -->
            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #F5A9B8;">
                    <h4 class="mb-0">{{ __('dashboard.add_new_category') }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('dashboard.category_name') }}</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                               placeholder="{{ __('dashboard.enter_category_name') }}"
                                required
                            >
                            @error('name')
                                <div class="text-danger mt-1" style="font-size: 0.875em;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn text-white" style="background-color: #e06b6b;">
                                <i class="fas fa-check"></i> {{ __('dashboard.add') }}
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> {{ __('dashboard.back') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
