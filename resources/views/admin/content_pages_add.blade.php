<div class="container">

    <form method="post" action="{{route('pagesAdd')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name" class="col-xs-2 control-label">Название страницы:</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="alias" class="col-xs-2 control-label">Псевдоним:</label>
            <input type="text" class="form-control" name="alias" value="{{old('alias')}}" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="text" class="col-xs-2 control-label">текст:</label>
            <textarea class="form-control" id="editor" name="text" value="{{old('text')}}" class="form-control"/></textarea>
        </div>

        <div class="form-group">
            <label for="images" class="col-xs-2 control-label">выбрать фото:</label>
            <input type="file" class="form-control"  name="images" value="{{old('images')}}" class="form-control"/>
        </div>

        <button type="submit" class="btn btn-primary">сохранить</button>
    
    <script>
        CKEDITOR.replace('editor');
       // $( "#editor" ).val(CKEDITOR.instances.auctionDescription.getData());
    </script>
    </form>
</div>