<h1>Photo List</h1>

@foreach ($photos as $photo)
    <div>
        <h3>{{ $photo->title }}</h3>
        <a href="{{ $photo->url }}" target="_blank">
            <img src="{{ $photo->thumbnailUrl }}" alt="">
        </a>
    </div>
@endforeach