@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Subir nueva imagen
                </div>
                <div class="card-body">
                    <img src="" class="img-fluid card-img-top rounded img-thumbnail mb-3" alt="Responsive image" style="display:none"> 
                    <form method="post" enctype="multipart/form-data" action="{{ route('image.save') }}">
                        @csrf

                        <div class="form-group pt-4 row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-7">
                                <div class="custom-file">
                                  <input name="image_path" type="file" class="custom-file-input" id="image_path" lang="es" require>
                                  <label class="custom-file-label" for="image_path">Seleccionar Archivo</label>
                                </div>
                                @if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-7">
                                <textarea name="description" id="description" class="form-control" require>
                                </textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" value="Subir Imagen" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection