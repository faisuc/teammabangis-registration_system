<div class="form-group col-md-6">
    <label for="attachments">Attachments</label>
    <input type="file" class="form-control" id="files" name="attachments[]" multiple autocomplete="off">
    <br />
    @foreach ($registrant->files as $file)
        <a href="{{ Storage::url($file->path) }}">{{ $file->name }}</a>
    @endforeach
</div>