@extends("web.{$configuracoes->template}.master.master")

@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url({{url('frontend/'.$configuracoes->template.'/assets/images/header.jpg')}})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>{{$galeria->titulo}}</h2>    
                        <div class="breadcrumb-wrap">                  
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('web.home')}}">Início</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$galeria->titulo}} </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>

@if ($galeria->images()->get()->count())
    <section class="team-area fix p-relative pt-120 pb-90" >    
        <div class="container">  
        <div class="row"> 
                @foreach ($galeria->images()->get() as $gb)                  
                    <div class="col-xl-3">
                        <div class="single-team mb-45" >
                            <div class="team-thumb">
                                <div class="brd">
                                    <a class="popup-image" href="{{ $gb->url_image }}">
                                        <img height="164" src="{{ $gb->url_image }}" alt="{{$galeria->titulo}}">
                                    </a>                                    
                                </div>                                   
                            </div>                            
                        </div>
                    </div>  
                @endforeach             
            </div>
        </div>
    </section>
@else
    <div class="container"><br />
        <div class="alert alert-danger">
            Desculpe, não existem fotos cadastradas nessa Galeria :(
        </div>
    </div>
@endif

@endsection