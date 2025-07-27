<ul class="navbar-nav ml-auto">
    @php
        $languages = ['en' => 'English', 'ar' => 'العربية'];
        $currentLang = app()->getLocale();
    @endphp

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fas fa-globe"></i>
            {{ $languages[$currentLang] ?? 'English' }}
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            @foreach ($languages as $code => $language)
                <form action="{{ route('switch.language') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="locale" value="{{ $code }}">
                    <button type="submit" class="dropdown-item">{{ $language }}</button>
                </form>
            @endforeach
        </div>
    </li>
</ul>
