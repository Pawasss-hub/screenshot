<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>

<h3>Komentar</h3>
<ul>
    @foreach($scene->comments as $comment)
        <li>
            <strong>{{ $comment->user->name ?? 'Anonim' }}:</strong>
            {{ $comment->body }}
            <br>
            <small>{{ $comment->created_at->diffForHumans() }}</small>
        </li>
    @endforeach
</ul>

@auth
<form action="{{ route('scenes.comment', $scene->id) }}" method="POST">
    @csrf
    <textarea name="body" rows="3" class="w-full border" required></textarea>
    <button type="submit" class="btn btn-primary mt-2">Kirim Komentar</button>
</form>
@else
<p><a href="{{ route('login') }}">Login</a> untuk berkomentar.</p>
@endauth
