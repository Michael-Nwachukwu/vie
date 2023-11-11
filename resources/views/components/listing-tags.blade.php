@props(['tagsCsv'])


{{-- here we need to get the tags from the listings factory, the tags are not an array so we need to find a way to loop through it by converting it to an array. we use the php and endphp tags to be able to use php tags in a blade template --}}

@php
    $tags = explode(',', $tagsCsv)
@endphp

<div class="tags">

    @foreach ( $tags as $one_tag )
        <a href="/?tag={{ $one_tag }}">{{ $one_tag }}</a>
    @endforeach
   
</div>