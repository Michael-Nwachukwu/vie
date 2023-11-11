{{-- before putting layout in components folder --}}
{{-- the layout is the ultimate layout containing the html, body, nav, footer and script tags --}}
{{-- @extends('layout') --}}

{{-- the content that is yielding in the layout. this is feeding the body --}}
{{-- @section('content') --}}

{{-- when u put it in components folder then... --}}
<x-layout>


    
    <!-- ==================== Start wrapper ==================== -->
    {{-- this hadles the corner colour gradients --}}
    <div class="wrapper circle-bg">

        <div class="circle-color fixed">
            <div class="gradient-circle"></div>
            <div class="gradient-circle two"></div>
        </div>

    </div>

    {{-- here we are including the header banner from the partials folder --}}
    @include('partials._banner')

    <!-- ==================== job listings ==================== -->
    <div class="main-content">

        {{-- including the search bos component --}}
        @include('partials._search')

        <section class="blog-pg blog section-padding pt-100">
            <div class="container">
                <div class="posts">
                    <div class="row">

                        @if ( count($details) == 0)
                            <p style="color: red">There are no available jobs at this time</p>
                        @endif

                        {{-- looping throught the details into the card component which is being imported from the listing-card --}}
                        @foreach ( $details as $job )
                            {{-- we are importing the listing card we have created and passing the var job to it, to be inserted accordingly in the listin-card --}}
                           <x-listing-card :job="$job" />
                        @endforeach

                    </div>

                    {{-- <div class="pagination">
                        <span class="active"><a href="#0">1</a></span>
                        <span><a href="#0">2</a></span>
                        <span><a href="#0"><i class="fas fa-angle-right"></i></a></span>
                    </div> --}}

                    <div class="pagination">
                        {{ $details->links() }}
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- ==================== End job listings ==================== -->
    
    {{-- <h1>{{ $heading }}</h1> --}}

</x-layout>

{{-- @endsection --}}