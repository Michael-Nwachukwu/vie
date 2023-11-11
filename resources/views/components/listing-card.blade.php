
@props(['job'])

<div class="col-lg-6">
    <div class="item mb-80 wow fadeInUp" data-wow-delay=".3s">
        <div class="img">
            <img style="height: 400px" src="{{ $job->logo ? asset('storage/' . $job->logo) : asset('img/no-image.png') }}" alt="">
        </div>
        <div class="cont">
            <div>
                <div class="info">
                    
                    <a href="#0" class="date">
                        <span>{{ $job->company }}</span>
                    </a>
                    <span>/</span>
                    
                    <x-listing-tags :tagsCsv="$job->tags" />

                </div>
                
                <h5>
                    <a  href="/jobdetail/{{ $job->id }}">{{ $job->title }}</a>
                </h5>
                
                <div class="btn-more">
                   <span class="icon pe-7s-map-marker mr-2"></span><a href="#0">{{ $job->location }}</a>
                </div>
            </div>
        </div>
    </div>
</div>