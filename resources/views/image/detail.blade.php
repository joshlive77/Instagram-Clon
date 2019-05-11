@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row">
                @if($image->user->image)
                    <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="img-thumbnail avatar rounded-circle mb-0">
                @endif
                    <h5 class="data-user p-2 mb-0">
                        {{ $image->user->name.' '.$image->user->surname }}
                        <span class="text-muted">{{'| @'.$image->user->nick }}</span>
                    </h5>
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
                        <div class="icons d-flex p-2">
                            <a class="h4 p-1 icon-heart {{ $user_like ? 'text-danger like' : 'text-secondary dislike' }}" data-id="{{ $image->id }}"></a>
                            <h5 class="like-numbers pt-1 text-secondary">
                                @if(count($image->likes) > 0)
                                {{ count($image->likes) }}
                                @endif
                            </h5>
                            
                            <a href="" class="h4 p-1 icon-comment text-secondary"></a>
                            <h5 class="comment-numbers pt-1 text-secondary">
                                @if(count($image->comments) > 0)
                                {{ count($image->comments) }}
                                @endif
                            </h5>
                        </div>
                        <div class="date d-flex p-2">
                            <p class="text-right aling-middle">
                                {{ \FormatTime::LongTimeFilter($image->created_at) }}
                            </p>
                        </div>
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
        </div>
        <div class="col-md-5">
            @include('includes.message')
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <h5 class="data-user p-2 mb-0">
                        Comentarios:
                    </h5>
                </div>
                <div class="card-body flex-column">
                    <form action="{{ route('comment.save') }}" method="post" class="mb-2" >
                        @csrf
                        <div class="input-group">
                            <input name="content" type="text" class="form-control" placeholder="Añade un comentario" aria-label="Añade un comentario" aria-describedby="button-addon2" required>
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Publicar</button>
                            </div>
                        </div>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </form>
                    
                    @foreach($image->comments as $comment)
                    <!-- aqui se generaran mas comentarios -->
                    <div class="card border-info mb-4">
                        <div class="card-body d-flex justify-content-start p-1">
                            <div class="d-flex pt-2 pl-2">
                                @if($comment->user->image)
                                    <img src="{{ route('user.avatar', ['filename'=>$comment->user->image]) }}" class="img-thumbnail avatar rounded-circle mb-0">
                                @endif
                            </div>
                            <div class=" d-flex flex-column flex-fill">
                                <div class="d-flex justify-content-between">
                                    <h7 class="card-title data-user text-info p-2 mb-0">
                                        {{ $comment->user->name.' '.$comment->user->surname }}
                                        <span class="text-muted">{{'| @'.$comment->user->nick }}</span>
                                    </h7> 
                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                    <a href="{{ route('comment.delete', ['id' => $comment->id] )}}" class="h5 mb-0 pt-2 pr-2 icon-delete text-danger"></a>
                                    @endif
                                </div>
                                <div class="date d-flex p-0 m-0 pl-2">
                                    <p class="text-right text-secondary aling-middle m-0 text-info h6">
                                        {{ \FormatTime::LongTimeFilter($comment->created_at) }}
                                    </p>
                                </div>                   
                                <p class="card-text text-secondary pl-2 pb-2 mb-0">
                                    {{ $comment->content }}
                                </p>
                                <!-- <div class="icons d-flex p-0">
                                    <a href="" class="h7 p-1 icon-like">
                                        <span class="h8 aling-middle">
                                           
                                        </span>
                                    </a>
                                    <a href="" class="h7 p-1 icon-no-like">
                                        <span class="h8 aling-middle">
                                            
                                        </span>
                                    </a>
                                    <a href="" class="h7 p-1 icon-heart">
                                        <span class="h8 aling-middle">
                                            
                                        </span>
                                    </a>
                                    <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="h7 p-1 icon-comment">
                                        <span class="h8 aling-middle">
                                            
                                        </span>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
