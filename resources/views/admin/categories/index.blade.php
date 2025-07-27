@extends('layouts.admin')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-4">
       <h2>{{ __('dashboard.category_list') }}</h2>

    <!-- زر إضافة فئة جديدة -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.categories.create') }}" class="btn" style="background-color: #FFC8C8">
            <i class="fas fa-plus"></i> {{ __('dashboard.add_new_category') }}
        </a>
    </div>

    <table class="table table-bordered align-middle">
        <thead style="background-color: #FFC8C8; color: #000;">
            <tr>
            <th>{{ __('dashboard.name') }}</th>
            <th>{{ __('dashboard.slug') }}</th>
            <th>{{ __('dashboard.created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                       class="btn btn-sm" 
                       style="background-color: #FFC8C8; color: #000;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                          method="POST" 
                          style="display:inline-block" 
                          onsubmit="return confirm('{{ __('dashboard.delete_confirm') }}')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm" 
                                style="background-color: #FF0B55; color: white;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                 <td colspan="4" class="text-center">{{ __('dashboard.no_categories') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- روابط الصفحات -->
    <div>
        {{ $categories->links() }}
    </div>
</div>
@endsection
