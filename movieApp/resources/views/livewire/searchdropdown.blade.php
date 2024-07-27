<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false" >
    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 text-sm rounded-full w-64 pl-8 px-4 py-1" placeholder="Search(Press . to focus)" 
    x-ref="search" 
    @keydown.window="
        if (event.keyCode === 190) {
            event.preventDefault();
            $refs.search.focus();
        }
    "
    @focus="isOpen = true" 
    @keydown="isOpen = true" 
    @keydown.escape.window="isOpen = false" 
    @keydown.shift.tab="isOpen = false">

    <div class="absolute top-0">
      <svg class="mt-1.5 ml-2" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0,0,256,256"
      style="fill:#000000;">
      <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M9,2c-3.85415,0 -7,3.14585 -7,7c0,3.85415 3.14585,7 7,7c1.748,0 3.34501,-0.65198 4.57422,-1.71875l0.42578,0.42578v1.29297l5.58594,5.58594c0.552,0.552 1.448,0.552 2,0c0.552,-0.552 0.552,-1.448 0,-2l-5.58594,-5.58594h-1.29297l-0.42578,-0.42578c1.06677,-1.22921 1.71875,-2.82622 1.71875,-4.57422c0,-3.85415 -3.14585,-7 -7,-7zM9,4c2.77327,0 5,2.22673 5,5c0,2.77327 -2.22673,5 -5,5c-2.77327,0 -5,-2.22673 -5,-5c0,-2.77327 2.22673,-5 5,-5z"></path></g></g>
      </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if (strlen($search) >= 2)

    <div class="z-50 absolute bg-gray-800 rounded w-64 mt-2" x-show.transition.opacity="isOpen"  >

        <ul>
            @if ($searchResults->count() > 0)
            @foreach ($searchResults as $result) 
            <li class="border-b border-gray-700">
                <a href="{{ route('movies.show', $result['id']) }}" 
                class="block hover:bg-gray-700 text-sm px-3 py-3 flex items-center transition ease-in-out duration-150"
                @if ($loop->last)@keydown.tab="isOpen=false" @endif
                >
                @if ($result['poster_path'])
                <img class="w-16" src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster">
                <span class="ml-4">{{ $result['title'] }}</span>
                @else
                    <img class="w-16" src="https://via.placeholder.com/50x75" alt="poster">
                @endif
            </a>
            </li>
            @endforeach
            @else
            <div class="px-3 py-3">No results for '{{ $search }}'</div>
        @endif
        </ul>
     
    </div>
    @endif
  </div>
