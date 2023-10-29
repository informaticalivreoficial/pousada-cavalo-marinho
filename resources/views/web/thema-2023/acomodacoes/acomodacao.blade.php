@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section class="breadcrumb-area overlay-dark-2 bg-3" style="background-image: url({{$configuracoes->gettopodosite()}});">	
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-text text-center">
                    <h2>{{$acomodacao->titulo}}</h2>
                    <p>&nbsp;</p>
                    <div class="breadcrumb-bar">
                        <ul class="breadcrumb">
                            <li><a href="{{route('web.acomodacoes')}}">Apartamentos</a></li>
                            <li>{{$acomodacao->titulo}}</li>
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
            <div class="col-lg-9 col-md-8">
                <div class="room-slider-wrapper">
                    <div class="room-slider">
                        @if($acomodacao->images()->get()->count())
                            @foreach($acomodacao->images()->get() as $image)
                                <div class="slider-image">
                                    <img height="500" src="{{ $image->url_image }}" alt="{{$acomodacao->titulo}}"/>
                                </div>
                            @endforeach
                        @endif                     
                    </div>
                    <div class="row nav-row">
                        <div class="slider-nav">
                            @if($acomodacao->images()->get()->count())
                                @foreach($acomodacao->images()->get() as $image)
                                    <div class="nav-image">
                                        <img width="201" height="151" src="{{ $image->url_image }}" alt="{{$acomodacao->titulo}}"/>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="room-details-text">
                    <h3 class="room-details-title">Descrição</h3>
                    {!!$acomodacao->descricao!!} 

                    @if ($acomodacao->notasadicionais)
                        <p>{{$acomodacao->notasadicionais}}</p>
                    @endif 
                </div>
                    
                <div class="room-facilities"> 
                    <div class="single-facility">
                        <span><i class="zmdi zmdi-check"></i> vvvvvvvv</span>
                    </div>
                </div>
            </div>
            
            <!-- SIDEBAR -->
            <div class="col-lg-3 col-md-4">
                <div class="sidebar-widget">
                    <h3 class="room-details-title">Pré-reservar</h3>
                    <form action="{{route('web.reservar')}}" method="post" class="search-form" autocomplete="off">
                        @csrf
                        <div class="form-container fix">
                            <div class="box-select">
                                <div class="select date">
                                    <input class="datepicker-here" data-language='pt-BR' type="text" name="checkini" autocomplete="off" placeholder="Checkin" />
                                </div>
                                <div class="select date">
                                    <input type="text" class="datepicker-here" data-language='pt-BR' name="checkouti" autocomplete="off" placeholder="Checkout" />
                                </div>
                                <div class="select arrow">
                                    <select name="adultos" id="adu" title="Adultos">
                                        <option value="">Adultos</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="select arrow">
                                    <select name="cri_0_5" id="adu" title="Crianças de 0 a 5 anos">
                                        <option value="">Crianças de 0 a 5 anos</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <input class="noclear" type="hidden" name="apart_id" value="{{$acomodacao->id}}" />
                            <button type="submit" class="search default-btn" name="SendReserva">Enviar Agora</button>
                        </div>
                    </form> 
                </div>
                            
            </div>
        </div>
    </div>
    
    @if (!empty($acomodacoes) && $acomodacoes->count() > 0)
        <div class="room-area">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="room-details-title">Veja Também</h3>
                        </div>
                    </div>
                </div>
                @foreach($acomodacoes as $apart)    
                    <div class="single-room">
                        <img style="min-height: 338px;max-height: 338px;max-width:480px;" src="{{$apart->cover()}}" alt="{{$apart->titulo}}"/>
                        <div class="room-hover text-center">
                            <div class="hover-text">
                                <h3><a href="{{route('web.acomodacao', ['slug' => $apart->slug])}}">{{$apart->titulo}}</a></h3>
                                <p>&nbsp;</p>
                                <div class="room-btn">
                                    <a href="{{route('web.acomodacao', ['slug' => $apart->slug])}}" class="default-btn">Ver Detalhes</a>
                                </div>
                            </div>                
                        </div>
                    </div>
                @endforeach
            </div>
        </div>    
    @endif 
</section>

@endsection

@section('css')
    <link href="{{url(asset('backend/plugins/airdatepicker/css/datepicker.min.css'))}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{url(asset('backend/plugins/airdatepicker/js/datepicker.min.js'))}}"></script>
    <script src="{{url(asset('backend/plugins/airdatepicker/js/i18n/datepicker.pt-BR.js'))}}"></script>
    <script>
        $(function () { 
            $('.datepicker-here').datepicker({
                autoClose: true,            
                minDate: new Date(),
                position: "top right", //'right center', 'right bottom', 'right top', 'top center', 'bottom center'
                
            });
        });
    </script>
@endsection