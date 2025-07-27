@extends('layouts.admin')

@section('content')
<div class="container py-4">
 <h2>{{ __('message.incoming_messages') }}</h2>

    <table class="table table-bordered mt-3">
        <thead class="table-danger">
              <tr>
        <th>{{ __('message.name') }}</th>
        <th>{{ __('message.email') }}</th>
        <th>{{ __('message.subject') }}</th>
        <th>{{ __('message.message') }}</th>
        <th>{{ __('message.sent_date') }}</th>
    </tr>

        </thead>
        <tbody>
            @forelse ($messages as $msg)
                <tr>
                    <td>{{ $msg->full_name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->subject ?? '-' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($msg->message, 50) }}</td>
                    <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('message.no_messages') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $messages->links() }}
    </div>
</div>
@endsection
