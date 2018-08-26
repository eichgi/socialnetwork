<form action="{{route('login')}}" method="POST">
    @csrf
    <input type="email" name="email">
    <input type="password" name="password">
    <button id="login-btn"></button>
</form>