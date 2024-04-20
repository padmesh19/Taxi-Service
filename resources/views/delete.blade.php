<form action="/deleteFile" method="GET">
    <a href="{{ route('deleteFile') }}" class="btn btn-primary"></a>                               <button class="btn btn-danger" type="button" onclick="commonDelete(`{{ route('user.destroy', $user->id) }}`)"><i class="fa fa-trash">
</form>