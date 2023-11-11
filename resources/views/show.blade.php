
{{-- @extends('layout') --}}

{{-- @section('content') --}}

<x-layout>
    <!-- ==================== Start Blog ==================== -->

    <div class="wrapper circle-bg">

        <div class="circle-color fixed">
            <div class="gradient-circle"></div>
            <div class="gradient-circle two"></div>
        </div>

        <!-- ==================== Start Header ==================== -->

        <section class="page-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-9">
                        <div class="cont text-center">
                            <h1 class="mb-10 color-font">Job Details</h1>
                            <!--    <p>All the most current news and events of our creative team.</p> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== Start Header ==================== -->

        <section class="blog-pg section-padding pt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="posts">
                            <div class="item mb-80">
                                <div class="img">
                                    <a href="blog-details.html">
                                        <img src="{{ $one_job->logo ? asset('storage/' . $one_job->logo) : asset('img/no-image.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <a href="#0" class="date">
                                                <span>{{ $one_job->company }}</span>
                                            </a>

                                            {{-- cut tags here --}}
                                            <x-listing-tags :tagsCsv="$one_job->tags" />

                                            <h4 class="title"><a href="blog-details.html">{{ $one_job->title }}</a></h4>
                                            <p>{{ $one_job->description }}</p>

                                            <div class="btn-more mt-3">
                                                <span class="icon pe-7s-map-marker mr-2"></span><a href="#0">{{ $one_job->location }}</a>
                                            </div>

                                            <div class="row justify-content-center">

                                                <a href="mailto:{{ $one_job->email }}" class="butn bord curve mt-30 w-100 text-center">Contact Employer</a>

                                                <a href="{{ $one_job->website }}" class="butn bord curve mt-30 w-100 text-center">Visit Website</a>

                                                @if ($one_job->user_id == auth()->id())
                                                    
                                                    <a href="/{{ $one_job->id }}/edit" class="butn bord curve mt-30 mr-5">
                                                        <i class="fa-solid fa-pencil mr-2"></i>Update Job
                                                    </a>

                                                    <form method="POST" action="/{{ $one_job->id }}">
                                                    
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="butn bord curve mt-30">
                                                            <i class="fa-solid fa-trash mr-2"></i>Delete Job
                                                        </button>

                                                    </form>

                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- ==================== End Blog ==================== -->

</x-layout>

{{-- @endsection --}}
