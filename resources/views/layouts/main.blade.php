<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HireMe</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- sesuaikan dengan file CSS kamu --}}
</head>
<body>

  {{-- Navbar di paling atas --}}
  @include('layouts.navbar')

  {{-- Konten halaman --}}
  <main>
    @yield('content')
  </main>

</body>
</html>
