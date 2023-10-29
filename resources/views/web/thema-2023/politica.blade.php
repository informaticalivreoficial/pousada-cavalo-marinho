@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section class="breadcrumb-area overlay-dark-2 bg-3" style="background-image: url({{$configuracoes->gettopodosite()}});">	
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-text text-center">
                    <h2>Política de Privacidade</h2>
                    <p>&nbsp;</p>
                    <div class="breadcrumb-bar">
                        <ul class="breadcrumb">
                            <li><a href="{{route('web.home')}}">Início</a></li>
                            <li>Política de Privacidade</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="room-details pt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">                
                <div class="room-details-text" style="padding-top: 10px;">                    
                    {!! $configuracoes->politicas_de_privacidade !!} 
                </div>
            </div>            
        </div>        
    </div>
</section>

@endsection

