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
                            <li><a href="{{route('web.home')}}">Início</a></li>
                            <li>{{$post->titulo}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="room-details pt-30">
    <div class="container">
        @if ($post->nocover())
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="{{$post->cover()}}" alt="{{$post->titulo}}">
                        </div>
                    </div>
                </div>
            </div>
        @endif       
        
        <div class="row">
            <div class="col-lg-12 col-md-12">                
                <div class="room-details-text" style="padding-top: 10px;">
                    <!-- Social list -->
                    <div class="shareIcons"></div>
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