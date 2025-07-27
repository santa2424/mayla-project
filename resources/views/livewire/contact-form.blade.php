<form wire:submit.prevent="submit" class="bg-light p-4 rounded">
    @csrf
    <div class="mb-3">
        <input wire:model="full_name" type="text" class="form-control" placeholder="{{ __('message.full_name') }} *">
        @error('full_name') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input wire:model="email" type="email" class="form-control" placeholder="{{ __('message.email_address') }} *">
        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input wire:model="subject" type="text" class="form-control" placeholder="{{ __('message.subject') }} *">
        @error('subject') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <textarea wire:model="message" rows="4" class="form-control" placeholder="{{ __('message.message') }} *"></textarea>
        @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="btn btn-danger w-100">{{ __('message.send') }}</button>

    @if (session()->has('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
</form>
