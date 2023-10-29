@extends("web.{$configuracoes->template}.master.master")

@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url({{url('frontend/'.$configuracoes->template.'/assets/images/header.jpg')}})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Galerias</h2>    
                        <div class="breadcrumb-wrap">                    
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('web.home')}}">Início</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Galerias </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>

@if (!empty($galerias) && $galerias->count() > 0)
    <section class="profile fix pt-120">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="my-masonry text-center mb-50">
                        <div class="button-group filter-button-group ">
                            <button class="active" data-filter="*">Todas</button>
                            @foreach ($galerias as $key => $item)
                                <button data-filter=".{{$item->id}}" class="{{($key == 0 ? 'active' : '')}}">{{$item->titulo}} </button>                                
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="masonry-gallery-huge">
                        <div class="grid col2">
                            @foreach ($galerias as $key => $galeria)
                            <div class="grid-item {{$galeria->id}}">
                                <a href="{{route('web.galeria',['slug' => $galeria->slug ])}}">
                                    <figure class="gallery-image">
                                        <img src="{{$galeria->cover()}}" alt="{{$galeria->titulo}}" class="{{$galeria->titulo}}"> 
                                    </figure>
                                </a>
                            </div>
                            @endforeach                            
                        </div>
                    </div>                
                </div>            
            </div>            
        </div>
    </section>
@endif
@endsection