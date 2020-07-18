<form action="qr_action_suci" method="POST" enctype="multipart/form-data">
    @csrf
<input type="file" name="file_excel">
<button type="submit"> Upload </button>
</form>