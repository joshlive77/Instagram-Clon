<div class="card mb-4">
    
    <div class="card-header d-flex flex-row">
        @if($image->user->image)
        <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="img-thumbnail avatar rounded-circle mb-0">
        @endif
        <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="data-user p-2 h5 mb-0">
            {{ $image->user->name.' '.$image->user->surname }}
            <span class="text-muted">{{'| @'.$image->user->nick }}</span>
        </a>
    </div>

    <div class="card-body p-0">
        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" class="img-fluid card-img-top" alt="Responsive image">
        <div class="d-flex justify-content-between">
            <!-- comprobar si el usuario ya dio like -->
            <?php $user_like = false; ?>
            @foreach($image->likes as $like)
                @if($like->user->id == Auth::user()->id)
                <?php $user_like = true; ?>
                @endif
            @endforeach
            <div class="like-comment d-flex p-2">
                <a class="h4 p-1 icon-heart {{ $user_like ? 'text-danger like' : 'text-secondary dislike' }}" data-id="{{ $image->id }}"></a>
                <h5 class="like-numbers pt-1 text-secondary">
                    @if(count($image->likes) > 0)
                    {{ count($image->likes) }}
                    @endif
                </h5>
                
                <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="h4 p-1 icon-comment text-secondary"></a>
                <h5 class="comment-numbers pt-1 text-secondary">
                    @if(count($image->comments) > 0)
                    {{ count($image->comments) }}
                    @endif
                </h5>
            </div>
            @if(Auth::user() && Auth::user()->id == $image->user->id)
            <div class="edit-delete d-flex p-2">
                <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="h4 p-1 icon-edit text-secondary"></a>
                <a href="" class="h4 p-1 text-danger icon-delete text-secondary" data-toggle="modal" data-target="#modalDelete"></a>
                <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar la imagen?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 class="text-secondary">
                                    No podras recuperar la imagen.
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                                <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-outline-danger">Aceptar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="d-flex flex-column">
            <div class="date d-flex p-0 pl-3">
                <p class="text-right mb-0 p-0 aling-middle text-secondary">
                    {{ \FormatTime::LongTimeFilter($image->created_at) }}
                </p>
            </div>
            <div class="description d-flex flex-row pl-2">
                <h5 class="text-info p-2">
                    {{'@'.$image->user->nick }}
                </h5>
                <p class="text-left p-2">
                    {{ $image->description }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="card-footer bg-transparent">
        <form action="{{ route('comment.save') }}" method="post">
            @csrf
            <div class="input-group">
                <input name="content" type="text" class="form-control" placeholder="Añade un comentario" aria-label="Añade un comentario" aria-describedby="button-addon2" required>
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit" id="button-addon2">Publicar</button>
                </div>
            </div>
            @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </form>
    </div>

</div>
                    