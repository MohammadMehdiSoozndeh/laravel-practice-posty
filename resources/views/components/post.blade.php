@props(['post' => $post])

<div>
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
        <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

        <p class="mb-2">{{ $post->body }}</p>
    </div>

    @can('delete', $post)
        <div>
            <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-400">Delete</button>
            </form>
        </div>
    @endcan

    <div class="flex items-center mb-8">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif



        @endauth
        <snap>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</snap>
    </div>
</div>
