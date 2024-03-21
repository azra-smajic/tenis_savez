<h1>{{$heading}}</h1>
@foreach($listings as $listing)
    {{$listing['id']}}
    <h1>{{$listing['title']}}</h1>
@endforeach