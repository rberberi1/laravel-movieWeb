@extends('layouts.main')
@section('content')
<div class="tv-info border-b border-gray-800">
  <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
    <img src="{{ $tvshow['poster_path'] }}" alt="poster" class="md:w-96">
    <div class="md:ml-24">
      <h2 class="text-4xl font-semibold mb-2">{{ $tvshow['name'] }}</h2>
      <div class="flex flex-wrap items-center text-gray-400 text-sm">
        <img class="w-3.5" src="{{asset('images/icons8-star-50.png')}}" alt="">
        <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
        <span class="mx-2">|</span>
        <span>{{ $tvshow['first_air_date']}}</span>
        <span class="mx-2">|</span>
        <span>
          {{  $tvshow['genres']}}
        </span>
      </div>

      <p class="text-gray-300 mt-8">
        {{ $tvshow['overview'] }}
      </p>

      <div class="mt-12">
        <div class="flex mt-4">
          @foreach ($tvshow['created_by'] as $crew)  
              <div class="mr-8">
                <div>{{ $crew['name'] }}</div>
                <div class="text-sm text-gray-400">Creator</div>
              </div>  
          @endforeach
        </div>
      </div>

      <div x-data="{ isOpen: false }">
        @if (count($tvshow['videos']['results']) > 0)
            <div class="mt-12">
                <button @click="isOpen = true"
                        class="flex inline-flex items-center bg-orange-400 text-gray rounded font-semibold px-5 py-4 hover:bg-orange-500 transition ease-in-out duration-150">
                    <img class="w-6" src="{{ asset('images/icons8-play-50.png') }}" alt="">
                    <span class="ml-2">Play Trailer</span>
                </button>
            </div>
    
            <div style="background-color: rgba(0,0,0,.5);"
                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                 x-show="isOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <div class="responsive-container overflow-hidden relative" style="padding-top:56.25%">
                                <iframe width="560" height="315"
                                        class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                        src="https://www.youtube.com/embed/{{ $tvshow['videos']['results'][0]['key'] }}"
                                        style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    

    </div>
  </div>
</div><!-- end tv info -->

@if (!empty($tvshow['cast']))
<div class="movie-cast border-b border-gray-800">
  <div class="container mx-auto px-4 py-16">
    <h2 class="text-4xl font-semibold">Cast</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
      @foreach ($tvshow['cast'] as $cast)
        <div class="mt-8">
          <a href="{{ route('actors.show', $cast['id']) }}">
            <img src="{{ 'https://image.tmdb.org/t/p/w300'.$cast['profile_path'] }}" alt="cast-member"
                 class="hover:opacity-75 transition ease-in-out duration-150">
          </a>
          <div class="mt-2">
            <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
            <div class="flex items-center text-gray-400 text-sm mt-1">
              <span>{{ $cast['character'] }}</span>
            </div>
          </div>
        </div>
      @endforeach
      @else
       <div></div>
    </div>
  </div>
</div>
@endif

@endsection
