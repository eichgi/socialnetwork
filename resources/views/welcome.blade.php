<form action="{{route('statuses.store')}}" method="POST">
    @csrf
    <textarea name="body" cols="30" rows="10"></textarea>
    <button id="create-status">Publicar estado</button>
</form>