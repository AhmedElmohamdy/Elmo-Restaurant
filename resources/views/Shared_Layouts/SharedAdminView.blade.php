<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('Admin.index') }}">ResturantAdmin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetProduct') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetCategory') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetOffers') }}">Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetAbouts') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetBook') }}">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetReviews') }}">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetSlider') }}">Sliders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Admin.GetSettings') }}">Settings</a>
                    </li>

                    @auth
                        @if (in_array(Auth::user()->role, ['superadmin']))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('register') }}">Add New Admin</a>
                            </li>
                        @endif
                    @endauth

                    {{-- Notification Bell --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" id="notifDropdown"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            🔔
                            <span id="notifCount"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ $notifCount > 0 ? '' : 'd-none' }}">
                                {{ $notifCount }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow p-0"
                            id="notifList" style="min-width: 320px;">
                            @forelse($notifications as $notif)
                                <li>
                                    <a class="dropdown-item py-2 {{ $notif->is_read ? 'text-muted' : 'fw-bold' }}"
                                       href="#"
                                       data-notif-id="{{ $notif->id }}"
                                       data-notif-url="{{ $notif->url ?? route('Admin.index') }}">
                                        {{ $notif->message }}
                                        <br>
                                        <small class="text-muted fw-normal">
                                            {{ $notif->created_at->diffForHumans() }}
                                        </small>
                                    </a>
                                </li>
                                @if (!$loop->last)
                                    <li><hr class="dropdown-divider my-0"></li>
                                @endif
                            @empty
                                <li>
                                    <span class="dropdown-item text-muted text-center py-3">
                                        No notifications
                                    </span>
                                </li>
                            @endforelse

                            @if ($notifCount > 0)
                                <li><hr class="dropdown-divider my-0"></li>
                                <li>
                                    <a class="dropdown-item text-center text-primary py-2"
                                       href="#" onclick="markAllRead()">
                                        ✅ Mark all as read
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    {{-- Logout --}}
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link active">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show mx-3 mt-3" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('Content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Event delegation — works for both blade-rendered and AJAX-injected notifications
        document.addEventListener('click', function (event) {
            const link = event.target.closest('[data-notif-id]');
            if (!link) return;

            event.preventDefault();
            event.stopPropagation();

            const id  = link.dataset.notifId;
            const url = link.dataset.notifUrl;

            fetch(`/Admin/Notifications/MarkAsRead/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(() => {
                window.location.href = url;
            })
            .catch(() => {
                window.location.href = url; // redirect even if fetch fails
            });
        });

        // Mark all as read
        function markAllRead() {
            fetch('/Admin/Notifications/MarkAsRead', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(() => fetchNotifications());
        }

        // Poll for new notifications every 10 seconds
        function fetchNotifications() {
            fetch('/Admin/Notifications')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('notifList').innerHTML = data.html;
                    const badge = document.getElementById('notifCount');
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('d-none');
                    } else {
                        badge.classList.add('d-none');
                    }
                });
        }

        setInterval(fetchNotifications, 10000);
    </script>

    @yield('scripts')

</body>

</html>
