<form action="{{route("hc.emp.profile.file.download")}}" method="post" target="_blank">
    @csrf
    <input type="hidden" value="{{$id}}" name="id">
    <button type="submit" class="btn btn-secondary btn-icon btn-sm">
        <i class="fa-solid fa-file-arrow-down"></i>
    </button>
</form>
