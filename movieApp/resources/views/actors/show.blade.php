@extends('layouts.main')
@section('content')
<div class="movie-info border-b border-gray-800">
  <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
    <div class="flex-none">
      <img src="{{ $actor['profile_path'] }}" alt="poster" class="w-76">
      <ul class="flex items-center mt-4">
        @if ($social['facebook'])
        <li class="ml-6">
          <a  href="{{$social['facebook']}}" title="Facebook" ><img class="w-8" src="{{ asset('images/icons8-facebook-50.png') }}" alt="facebook logo"></a>
        </li>
        @endif

        @if ($social['instagram'])
        <li class="ml-6">
          <a  href="{{$social['instagram']}}" title="Instagram" ><img class="w-8" src="{{ asset('images/icons8-instagram-50.png') }}" alt="instagram logo"></a>
        </li> 
        @endif
        
        @if ($social['twitter'])
        <li class="ml-6">
          <a  href="{{$social['twitter']}}" title="Twitter" ><img class="w-8" src="{{ asset('images/icons8-twitter-50.png') }}" alt="twitter logo"></a>
        </li>  
        @endif
        

        @if ($actor['homepage'])
        
        <li class="ml-6">
          <a  href="{{$actor['homepage']}}" title="Website" ><img class="w-8" src="{{ asset('images/icons8-earth-24.png') }}" alt="website logo"></a>
        </li>
        @endif
      </ul>
    </div>
    
    <div class="md:ml-24">
      <h2 class="text-4xl font-semibold mb-2">{{ $actor['name'] }}</h2>
      <div class="flex flex-wrap items-center text-gray-400 text-sm">
        <img class="w-4" src="{{asset('images/icons8-birthday-16.png')}}" alt="">
        <span class="ml-2">{{$actor['birthday']}} ({{$actor['age']}} years old) in {{$actor['place_of_birth']}}</span>
        
      </div>

      <p class="text-gray-300 mt-8">
          {{$actor['biography']}}
      </p>

      <h4 class="font-semibold mt-12">Known For</h4>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
          @foreach ($knownForTitles as $movie)
              <div class="mt-4">
                  <a href="{{ $movie['linkToPage'] }}">
                      <img class="hover:opacity-75 transition ease-in-out duration-150" src="{{ $movie['poster_path'] }}" alt="">
                  </a>
                  <a href="{{ $movie['linkToPage'] }}" 
                     class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">
                      {{ $movie['title'] }}
                  </a>  
              </div>
          @endforeach
      </div>
      

      
    </div>
  </div>
</div><!-- end movie info -->

<div class="credits border-b border-gray-800">
  <div class="container mx-auto px-4 py-16">
    <h2 class="text-4xl font-semibold">Credits</h2>
    <ul class="list-disc leading-loose pl-5 mt-8">
      @foreach ($credits as $credit)
        <li>{{$credit['release_year']}} &middot; <strong>{{$credit['title']}}</strong> as {{$credit['character']}}</li>
      @endforeach
    </ul>
  </div>
</div> <!-- end credits-cast -->
@endsection
