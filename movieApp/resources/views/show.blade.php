@extends('layouts.main')
@section('content')
<div class="movie-info border-b border-gray-800">
  <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
    <img src="{{$movie['poster_path']}}" alt="poster" class="md:w-96">
    <div class="md:ml-24">
      <h2 class="text-4xl font-semibold mb-2">{{ $movie['title'] }}</h2>
      <div class="flex flex-wrap items-center text-gray-400 text-sm">
        <img class="w-3.5" src="{{asset('images/icons8-star-50.png')}}" alt="">
        <span class="ml-1">{{ $movie['vote_average'] }}</span>
        <span class="mx-2">|</span>
        <span>{{ $movie['release_date']}}</span>
        <span class="mx-2">|</span>
        <span>
          {{  $movie['genres']}}
        </span>
      </div>

      <p class="text-gray-300 mt-8">
        {{ $movie['overview'] }}
      </p>

      <div class="mt-12">
        <h4 class="text-white font-semibold">Featured Cast</h4>
        <div class="flex mt-4">
          @foreach ($movie['crew'] as $crew)  
              <div class="mr-8">
                <div>{{ $crew['name'] }}</div>
                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
              </div>  
          @endforeach
        </div>
      </div>

      <div x-data="{ isOpen: false }">
        @if (count($movie['videos']['results']) > 0)
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
                 x-transition.opacity>
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false" 
                                    class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <div class="responsive-container overflow-hidden relative" style="padding-top:50.25%">
                                <iframe width="400" height="250" 
                                        class="responsive-iframe absolute top-0 left-0 w-full h-full" 
                                        src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" 
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
</div><!-- end movie info -->

<div class="movie-cast border-b border-gray-800">
  <div class="container mx-auto px-4 py-16">
    <h2 class="text-4xl font-semibold">Cast</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
      @foreach ($movie['cast'] as $cast)
    
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
    </div>
  </div>
</div>
@endsection
