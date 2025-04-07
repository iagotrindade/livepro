<form method="POST" action="{{route('password.reset.action')}}">
    @csrf
    <input type="hidden" name="token" id="" value="{{$token}}">
    <input type="email" name="email" id="" value="{{$email}}">
    <input type="password" name="password" id="">
    <input type="password" name="password_confirmation" id="">
    <button type="submit">ENVIAR</button>
</form>