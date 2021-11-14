<form method="POST" action="{{ route('cache.post') }}">
    @csrf
    <input name="input" type="text">
    <button type="submit">Submit</button>
</form>
