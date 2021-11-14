<form method="POST" action="{{ route('session.post') }}">
    @csrf
    <input name="input" type="text">
    <button type="submit">Submit</button>
</form>
