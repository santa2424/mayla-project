@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Send Promotional Notification</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.notification.send') }}">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Notification Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter notification title" required value="{{ old('title') }}">
    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Notification Message</label>
        <textarea name="message" id="message" rows="5" class="form-control" placeholder="Write your promotional message here..." required>{{ old('message') }}</textarea>
    </div>

    <button type="submit" class="btn w-100" style="background-color: #c26b6b; color: #fff;">Send Notification to All Users</button>
</form>

</div>
@endsection
