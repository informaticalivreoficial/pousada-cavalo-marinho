@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section class="breadcrumb-area overlay-dark-2 bg-3" style="background-image: url({{$configuracoes->gettopodosite()}});">	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-text text-center">
					<h2>{{$post->titulo}}</h2>
					<p>&nbsp;</p>
					<div class="breadcrumb-bar">
						<ul class="breadcrumb">
							<li><a href="{{route('web.blog.artigos')}}">Artigos</a></li>
							<li>{{$post->titulo}}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="room-details pt-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="room-slider-wrapper">
                    <div class="room-slider">
                        <div class="slider-image">
                            <img src="{{$post->cover()}}" alt="{{$post->titulo}}"/>
                            @if ($post->thumb_legenda)
                                <p>{{$post->thumb_legenda}}</p>
                            @endif
                            <!-- Social list -->
                            <div class="shareIcons"></div>                           
                        </div>
                    </div>                    
                </div>
                <div class="room-details-text">
                    <h3 class="room-details-title">{{$post->titulo}}</h3>
                    {!!$post->content!!}
                </div> 
            </div>            
        </div>
        @if($post->images()->get()->count()) 
            <div class="row gallery">
                @foreach($post->images()->get() as $key => $image)        
                    @if ($image->cover == null)
                        <div class="col-md-4 col-sm-6 col-xs-12 image"> 
                            <a class="image-popup" href="{{ $image->url_image }}" title="{{$post->titulo}}">
                                <img src="{{ $image->url_image }}" alt="{{$post->titulo}}"> 
                            </a>
                        </div>
                    @endif            
                @endforeach
            </div>
        @endif
    </div>
</section>

@if (!empty($postsMais) && $postsMais->count() > 0)
    <section class="blog-area" style="margin-top: 60px;margin-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                <h3>Veja Também</h3>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-carousel">
                    @foreach ($postsMais as $postmais)    
                        <div class="col-xs-12">
                            <div class="single-blog-wrapper">
                                <div class="single-blog">
                                    <div class="blog-image">
                                        <img width="370" height="212" src="{{$postmais->cover()}}" alt="{{$postmais->titulo}}"/>
                                    </div>
                                    <div class="blog-text">
                                        <h3>{{$postmais->titulo}}</h3>
                                    </div>
                                </div>
                                <div class="blog-hover">
                                    <h3>
                                        <a href="{{route(($postmais->tipo == 'artigo' ? 'web.blog.artigo' : 'web.noticia'), ['slug' => $postmais->slug] )}}" title="{{$postmais->titulo}}">{{$postmais->titulo}}</a>
                                    </h3>
                                    {!!\App\Helpers\Renato::Words($postmais->content, 15)!!}
                                    <a href="{{route(($postmais->tipo == 'artigo' ? 'web.blog.artigo' : 'web.noticia'), ['slug' => $postmais->slug] )}}" class="default-btn">Leia mais</a>
                                </div>
                            </div>
                        </div>        
                @endforeach
                </div>
            </div>
        </div>
    </section>
@endif    

@endsection

@section('css')
    <link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/js/jsSocials/jssocials.css')}}">
    <link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/js/jsSocials/jssocials-theme-flat.css')}}">
    <style>
        .gallery {
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
        }
        .image {
            margin: 10px;
            width: calc(33.33% - 20px);
            overflow: hidden;
        }
        .image img {
            width: 100%;
            height: auto;
            transition: transform 0.5s;
        }
        .image:hover img {
            transform: scale(1.1);
        }
        @media screen and (max-width: 768px) {
            .image {
                width: calc(50% - 20px);
            }
        }

        @media screen and (max-width: 480px) {
            .image {
                width: 100%;
            }
        }
    </style>
@endsection

@section('js')
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jsSocials/jssocials.min.js')}}"></script>
    <script>
        $(function () {    
            $('.shareIcons').jsSocials({
                //url: "http://www.google.com",
                showLabel: false,
                showCount: false,
                shareIn: "popup",
                shares: ["email", "twitter", "facebook", "whatsapp"]
            });    
        });
    </script>
@endsection