<div class="wrapper container" >

    <form action="{{route('pagesEdit',array('page'=>$data['id']))}}" class="form-horizontal" method="POST" enctype="multipart/form-data">

        <input type="hidden" value="{{csrf_token()}}" name="_token" />



        <div class="form-group">
            <input id="invisible_id" name="id" type="hidden" value="{{$data['id']}}">
            <label for="name" class="col-xs-2 control-label">Название страницы:</label>
            <input type="text" class="form-control" name="name" value="{{ $data['name']}}" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="alias" class="col-xs-2 control-label">Псевдоним:</label>
            <input type="text" class="form-control" name="alias" value="{{ $data['alias']}}" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="text" class="col-xs-2 control-label">Текст:</label>
            <textarea class="form-control" id="editor" name="text" value="{{ $data['text']}}" class="form-control"> </textarea>
        </div>
        <div class="form-group">
            <input id="invisible_img" name="old_images" type="hidden" value="{{$data['images']}}">
            <label for="images" class="col-xs-2 control-label">изображение</label>
            <img src="{{ asset('assets/img/'.$data['images']) }}" alt="" class="img-circle img-responsive">
        </div>
        <div class="form-group">

            <label for="images" class="col-xs-2 control-label">выбрать фото:</label>

            <input type="file" class="form-control"  name="images" value="images" class="img-circle img-responsive"/>
        </div>

        <button type="submit" class="btn btn-primary">сохранить</button>
        <script>
            CKEDITOR.replace( 'editor' );
        </script>
    </form>





    



</div>