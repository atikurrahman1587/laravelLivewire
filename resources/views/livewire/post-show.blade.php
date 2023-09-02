<div class="bg-white p-4 mt-6">
    <h2 class="bg-blue-100 px-3 py-2 text-gary rounded">{{ $post->id }}.{{ $post->title }}</h2>
    <p></p>
    <p>{{ $post->body }}</p>
    <br/>
    Total Posts: {{ $this->total_posts }}
    <livewire:child :text="$post->title" />
</div>
