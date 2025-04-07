<form method="POST" action="{{route('send.reset.password')}}">
    @csrf
    <input type="text" name="email" id="email">
</form>