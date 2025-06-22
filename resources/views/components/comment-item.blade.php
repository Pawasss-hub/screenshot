<div class="flex items-start gap-3" @if(isset($comment->id)) data-comment-id="{{ $comment->id }}" @endif>
  <div class="w-8 h-8 rounded-full flex-shrink-0 overflow-hidden bg-gray-600 flex items-center justify-center">
    @if($comment->user && $comment->user->profile_photo)
      <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="{{ $comment->user->name }}" class="w-full h-full object-cover" />
    @elseif($comment->user)
      <span class="text-white font-bold text-lg">{{ strtoupper(substr($comment->user->name, 0, 1)) }}</span>
    @else
      <span class="text-white font-bold text-lg">?</span>
    @endif
  </div>
  <div class="flex-1">
    <div class="text-white text-sm flex items-center justify-between">
      <div>
        <span class="font-medium">{{ $comment->user->name ?? 'Anonim' }}</span>
        <span class="text-xs text-gray-400">&middot; {{ $comment->created_at->diffForHumans() }}</span>
      </div>
      @auth
        @if(auth()->id() === $comment->user_id)
          <div class="flex gap-1">
            <button onclick="window.editComment({{ $comment->id }})" class="text-blue-400 hover:text-blue-300 px-1 py-0.5 rounded transition text-xs">Edit</button>
            <button onclick="window.deleteComment({{ $comment->id }})" class="text-red-400 hover:text-red-300 px-1 py-0.5 rounded transition text-xs">Hapus</button>
          </div>
        @endif
      @endauth
    </div>
    <p class="mt-1 text-gray-300 comment-body">{{ $comment->body }}</p>
  </div>
</div>
