@extends('layouts.admin')

@section('title', __('message.promotions_log'))

@section('content')
<div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title mb-0">{{ __('message.promotions_log') }}</h3>
    <a href="{{ route('admin.notification.form') }}" class="btn btn-sm" style="background-color: #c26b6b; color: #fff;">
        <i class="fas fa-plus-circle me-1"></i> {{ __('message.send_notification') }}
    </a>
</div>

<div class="container-fluid">
    <div class="card">
      
        <div class="card-body">
            <table id="notificationsTable" class="table table-bordered table-striped">
                <thead>
                      <tr>
                        <th>{{ __('message.title') }}</th>
                        <th>{{ __('message.content') }}</th>
                        <th>{{ __('message.user') }}</th>
                        <th>{{ __('message.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>{{ $notification->data['title'] }}</td>
                            <td>{{ $notification->data['body'] }}</td>
                            <td>{{ $notification->notifiable->name ?? '-' }}</td>
                            <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- DataTables --}}
@push('scripts')
<script>
    $(function () {
        $("#notificationsTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@endpush
@endsection
