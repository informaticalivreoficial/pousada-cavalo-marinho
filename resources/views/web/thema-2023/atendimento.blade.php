@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section class="breadcrumb-area overlay-dark-2" style="background-image: url({{$configuracoes->gettopodosite()}});">	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-text text-center">
					<h2>Atendimento</h2>
					<p>&nbsp;</p>
					<div class="breadcrumb-bar">
						<ul class="breadcrumb">
							<li><a href="{{route('web.home')}}">Início</a></li>
							<li>Atendimento</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contact-form-area pt-90" style="margin-bottom: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="contact-title">SAC</h4>
                <div class="contact-text">
                    @if($configuracoes->whatsapp)
                        <p>
                            <span class="c-icon"><i class="zmdi zmdi-whatsapp"></i></span>
                            <a class="sharezap" href="#" target="_blank">{{$configuracoes->whatsapp}}</a>
                        </p>                        
                    @endif
                    @if($configuracoes->telefone1 || $configuracoes->telefone2 || $configuracoes->telefone3)
                        <p>
                            <span class="c-icon"><i class="zmdi zmdi-phone"></i></span>
                            @if ($configuracoes->telefone1 && $configuracoes->telefone2)
                                <a href="tel:{{\App\Helpers\Renato::limpaTelefone($configuracoes->telefone1)}}">{{$configuracoes->telefone1}}</a> - <a href="tel:{{\App\Helpers\Renato::limpaTelefone($configuracoes->telefone2)}}">{{$configuracoes->telefone2}}</a>
                            @elseif($configuracoes->telefone1 && !$configuracoes->telefone2)
                                <a href="tel:{{\App\Helpers\Renato::limpaTelefone($configuracoes->telefone1)}}">{{$configuracoes->telefone1}}</a>
                            @elseif(!$configuracoes->telefone1 && $configuracoes->telefone2)
                                <a href="tel:{{\App\Helpers\Renato::limpaTelefone($configuracoes->telefone2)}}">{{$configuracoes->telefone2}}</a>
                            @endif
                        </p>	

                        @if ($configuracoes->telefone3)
                            <p>
                                <span class="c-icon"><i class="zmdi zmdi-phone"></i></span>
                                <a href="tel:{{\App\Helpers\Renato::limpaTelefone($configuracoes->telefone3)}}">{{$configuracoes->telefone3}}</a>
                            </p>										
                        @endif
                        
                    @endif
                    @if($configuracoes->email)
                        <p>
                            <span class="c-icon"><i class="zmdi zmdi-email"></i></span>									
                            <span class="c-text"><a href="mailto:{{$configuracoes->email}}">{{$configuracoes->email}}</a></span>
                        </p>
                    @endif 
                    @if($configuracoes->email1)
                        <p>
                            <span class="c-icon"><i class="zmdi zmdi-email"></i></span>									
                            <span class="c-text"><a href="mailto:{{$configuracoes->email1}}">{{$configuracoes->email1}}</a></span>
                        </p>
                    @endif
                    
                    <span class="c-icon"><i class="zmdi zmdi-pin"></i></span>
                        {{$configuracoes->rua}}
                        @if($configuracoes->num)
                            , {{$configuracoes->num}}
                        @endif	
                        @if($configuracoes->bairro)
                            <br>{{$configuracoes->bairro}}
                        @endif
                        @if($configuracoes->cidade)  
                            - {{$configuracoes->cidade}} {{($configuracoes->uf ? '/'.$configuracoes->uf : '')}}
                        @endif
                        @if ($configuracoes->cep)
                             - {{$configuracoes->cep}}
                        @endif                                                           
                </div>
                <h4 class="contact-title">Redes Sociais</h4>
                <div class="link-social">
                    @if ($configuracoes->facebook)
                        <a target="_blank" href="{{$configuracoes->facebook}}" title="Facebook"><i class="zmdi zmdi-facebook"></i></a>
                    @endif
                    @if ($configuracoes->instagram)
                        <a target="_blank" href="{{$configuracoes->instagram}}" title="Instagram"><i class="zmdi zmdi-instagram"></i></a>
                    @endif
                    @if ($configuracoes->twitter)
                        <a target="_blank" href="{{$configuracoes->twitter}}" title="Twitter"><i class="zmdi zmdi-twitter"></i></a>
                    @endif
                    @if ($configuracoes->youtube)
                        <a target="_blank" href="{{$configuracoes->youtube}}" title="Youtube"><i class="zmdi zmdi-youtube"></i></a>
                    @endif
                    @if ($configuracoes->linkedin)
                        <a target="_blank" href="{{$configuracoes->linkedin}}" title="Linkedin"><i class="zmdi zmdi-linkedin"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="contact-title">Envie sua Mensagem</h4>
                <form id="contact-form" action="" method="post" class="j_formsubmit" autocomplete="off"> 
                    @csrf                    
                    <div class="row">
                        <div class="col-md-12">
                            <div id="js-contact-result"></div>
                            <!-- HONEYPOT -->
                            <input type="hidden" class="noclear" name="bairro" value="" />
                            <input type="text" class="noclear" style="display: none;" name="cidade" value="" /> 
                        </div>                        
                    </div>
                    <div class="form_hide">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="nome" placeholder="Seu Nome"/>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" placeholder="Seu E-mail"/>
                            </div>
                            <div class="col-md-12">
                                <textarea name="mensagem" cols="30" rows="10" placeholder="Mensagem"></textarea>
                                <button type="submit" id="b_nome" class="default-btn btncheckout">Enviar Agora</button>
                            </div>
                        </div>
                    </div> 
                </form>                
            </div>
        </div>
    </div>
</section> 

@endsection

@section('js')
    <script>
        $(function () {

            // Seletor, Evento/efeitos, CallBack, Ação
            $('.j_formsubmit').submit(function (){
                var form = $(this);
                var dataString = $(form).serialize();

                $.ajax({
                    url: "{{ route('web.sendEmail') }}",
                    data: dataString,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        form.find(".btncheckout").attr("disabled", true);
                        form.find('.btncheckout').html("Carregando...");                
                        form.find('.alert').fadeOut(500, function(){
                            $(this).remove();
                        });
                    },
                    success: function(resposta){
                        $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-150}, 'slow');
                        if(resposta.error){
                            form.find('#js-contact-result').html('<div class="alert alert-danger error-msg">'+ resposta.error +'</div>');
                            form.find('.error-msg').fadeIn();                    
                        }else{
                            form.find('#js-contact-result').html('<div class="alert alert-success error-msg">'+ resposta.sucess +'</div>');
                            form.find('.error-msg').fadeIn();                    
                            form.find('input[class!="noclear"]').val('');
                            form.find('textarea[class!="noclear"]').val('');
                            form.find('.form_hide').fadeOut(500);
                        }
                    },
                    complete: function(resposta){
                        form.find(".btncheckout").attr("disabled", false);
                        form.find('.btncheckout').html("Enviar Agora");                                
                    }
                });

                return false;
            });

        });
    </script>   
@endsection