@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section class="breadcrumb-area overlay-dark-2 bg-3" style="background-image: url({{$configuracoes->gettopodosite()}});">	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-text text-center">
					<h2>Apartamentos</h2>
					<p>&nbsp;</p>
					<div class="breadcrumb-bar">
						<ul class="breadcrumb">
							<li><a href="{{route('web.home')}}">Início</a></li>
							<li>Apartamentos</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="room-area pt-90">
    @if (!empty($acomodacoes) && $acomodacoes->count()> 0)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($acomodacoes as $apartamento)
                        <div class="room-list">
                            <div class="row">
                                <div class="col-md-5 col-sm-6">
                                    <a href="{{$apartamento->cover()}}">
                                        <img style="max-width: 470px;max-height:340px;" src="{{$apartamento->cover()}}" alt="{{$apartamento->titulo}}"/>
                                    </a>
                                </div>
                                <div class="col-md-7 col-sm-6">
                                    <div class="room-list-text">
                                        <h3><a href="{{route('web.acomodacao', ['slug' => $apartamento->slug])}}">{{$apartamento->titulo}}</a></h3>
                                        <p style="min-height: 75px;">
                                            {!!\App\Helpers\Renato::Words($apartamento->descricao, 35)!!} 
                                        </p>
                                        <h4>Disponível no apartamento</h4>
                                        <div class="room-service">
                                            <p>
                                                @if($apartamento->wifi == true)
                                                    Wirelles,
                                                @endif
                                                @if($apartamento->frigobar == true)
                                                    Frigobar,
                                                @endif
                                                @if($apartamento->ventilador_teto == true)
                                                    Ventilador de Teto
                                                @endif
                                                @if($apartamento->ar_condicionado == true)
                                                    Ar Condicionado de Janela,
                                                @endif
                                                @if($apartamento->servico_quarto == true)
                                                    Serviços de quarto,
                                                @endif
                                                @if($apartamento->cafe_manha == true)
                                                    Café da Manhã,
                                                @endif
                                                @if($apartamento->ducha_com_aquecimento == true)
                                                    Ducha com aquecimento central,
                                                @endif
                                            </p>
                                            <a href="{{route('web.acomodacao', ['slug' => $apartamento->slug])}}">
                                                <div class="p-amount">
                                                <span>Ver +</span>
                                                <span class="count">&nbsp;</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 fix" style="margin-top: 20px;margin-bottom: 30px;">
                    <div class="pagination-content text-center">
                        @if (isset($filters))
                            {{ $acomodacoes->appends($filters)->links() }}
                        @else
                            {{ $acomodacoes->links() }}
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
                        <div class="alert alert-info">Desculpe, não encontramos Apartamentos Cadastrados</div>
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