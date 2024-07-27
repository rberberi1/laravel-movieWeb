<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movie123</title>

    <!-- <link rel="stylesheet" href="/css/app.css"> -->
  @vite('resources/css/app.css')
  @livewireStyles

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

</head>
<body class="font-sans bg-gray-900 text-white">
  <nav class="border-b border-gray-800">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
    <ul class="flex flex-col md:flex-row items-center" style="list-style-type: none;">
      <li>
        <a href="{{ route('index') }}"><img src="{{ asset('images/icons8-film.gif') }}" alt="LOGO"></a>
      </li>
      <li class="md:ml-16 mt-3 md:mt-0">
        <a href="{{ route('index') }}" class="hover:text-gray-300">Movies</a>
      </li>
      <li class="md:ml-6 mt-3 md:mt-0">
        <a href="{{route('tvshow.index') }}" class="hover:text-gray-300">TV Shows</a>
      </li>
      <li class="md:ml-6 mt-3 md:mt-0">
        <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
      </li>
    </ul>
    <div class="flex flex-col md:flex-row items-center">
      <livewire:searchdropdown>
      <div class="md:ml-4 mt-3 md:mt-0 ">
        <a href="#">
          <img width="30"  src="{{asset('images/icons8-avatar-50.png')}}" alt="user"/>
        </a>
      </div>
    </div>
  </div>

  </nav>
  @yield('content')
  @livewireScripts
  @yield('scripts')
</body>
</html>