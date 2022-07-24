A post was created successfully.

<h1>{{ $post->title }}</h1>

<p>{{ $post->body }}</p>

URL: {{ route('post.show', $post->id) }}