@extends("web.{$configuracoes->template}.master.master")

@section('content')

    <section class="breadcrumb-area overlay-dark-2 bg-3" style="background-image: url({{$configuracoes->gettopodosite()}});">	
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-text text-center">
                        <h2>Blog</h2>
                        <p>Confira aqui algumas de nossas dicas e promoções!!</p>
                        <div class="breadcrumb-bar">
                            <ul class="breadcrumb">
                                <li><a href="{{route('web.home')}}">Início</a></li>
                                <li>Blog</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="room-area pt-90">
        @if(!empty($posts) && $posts->count() > 0)               
            <div class="container">
                <div class="row">            
                    @foreach($posts as $post)
                        <div class="col-md-6">
                            <div class="room-list">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <a href="{{route(($post->tipo == 'noticia' ? 'web.noticia' : 'web.blog.artigo'), [ 'slug' => $post->slug ])}}">
                                            <img width="280" height="280" src="{{$post->cover()}}" alt="{{$post->titulo}}"/>
                                        </a>              
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="room-list-text">
                                            <h3><a href="{{route(($post->tipo == 'noticia' ? 'web.noticia' : 'web.blog.artigo'), [ 'slug' => $post->slug ])}}">{{$post->titulo}}</a></h3>
                                            {!!\App\Helpers\Renato::Words($post->content, 25)!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                
                    <div class="col-md-12 fix" style="margin-top: 20px;margin-bottom: 30px;">
                        <div class="pagination-content text-center">                            
                            @if (isset($filters))
                                {{ $posts->appends($filters)->links() }}
                            @else
                                {{ $posts->links() }}
                            @endif                            
                        </div>
                    </div>
                </div>
            </div>  
        @else
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <div class="alert alert-info">Desculpe, não encontramos artigos no Blog</div>
                        </div>
                    </div>
                </div>
            </div>  
        @endif
    </section>
    
@endsection

@section('css')
    <style>
        .pagination-custom{
            margin: 0;
            display: -ms-flexbox;
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }
        .pagination-custom li a {
            border-radius: 30px;
            margin-right: 8px;
            color:#7c7c7c;
            border: 1px solid #ddd;
            position: relative;
            float: left;
            padding: 6px 12px;
            width: 50px;
            height: 40px;
            text-align: center;
            line-height: 25px;
            font-weight: 600;
        }
        .pagination-custom>.active>a, .pagination-custom>.active>a:hover, .pagination-custom>li>a:hover {
            color: #fff;
            background: #FF6600;
            border: 1px solid transparent;
        }
    </style>
@endsection

@section('js')
    
@endsection