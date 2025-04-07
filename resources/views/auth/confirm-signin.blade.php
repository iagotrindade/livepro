<form action="{{route('confirm.signin.action')}}" method="POST">
    @csrf
    <input type="hidden" name="email" id="email" value="{{$userEmail}}">
    <br>
    <input type="text" name="token">
</form>