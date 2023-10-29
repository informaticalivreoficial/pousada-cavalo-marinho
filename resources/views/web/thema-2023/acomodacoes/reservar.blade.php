@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section class="breadcrumb-area overlay-dark-2 bg-3" style="background-image: url({{$configuracoes->gettopodosite()}});">	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-text text-center">
					<h2>Pré-reserva</h2>
					<p>&nbsp;</p>
					<div class="breadcrumb-bar">
						<ul class="breadcrumb">
							<li><a href="{{route('web.home')}}">Início</a></li>
							<li>Pré-reserva</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="contact-form-area pt-90" style="margin-bottom: 30px;">
    <div class="container">
        <div class="row">                    
            <div class="col-md-12">
                <form id="contact-form" action="" method="post" class="j_formsubmit" autocomplete="off">
                    @csrf
                    <div id="js-contact-result"></div>
                    <!-- HONEYPOT -->
                    <input type="hidden" class="noclear" name="bairro" value="" />
                    <input type="text" class="noclear" style="display: none;" name="cidade1" value="" />
                    
                    <div class="row form_hide"> 
                        <div class="col-12">
                            <h3 style="padding-left: 15px;">Tipo de Hospedagem</h3>    
                        </div>                               
                        <div class="col-4"> 
                            <select class="check_hospedagem" name="tipo_reserva" style="margin-left: 15px;margin-top: 20px;margin-bottom:20px;">                                        
                                <option value="1">Pessoa Física</option>                                       
                                <option value="2">Empresa</option>                                       
                            </select>
                        </div>                                                 
                    </div>

                    <div class="row div_empresa form_hide">
                        <div class="col-12">
                            <h3 style="margin-bottom:20px;padding-left: 15px;">Dados da Empresa</h3>
                        </div>                                                            
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">                                    
                            <label>Nome da Empresa <span style="color:#FF0000;">*</span></label>
                            <input type="text" name="empresa_nome"/>                                    
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">                                    
                            <label>CNPJ <span style="color:#FF0000;">*</span></label>
                            <input type="text" name="cnpj" class="cnpjmask"/>                                    
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">                                    
                            <label>Telefone <span style="color:#FF0000;">*</span></label>
                            <input type="text" name="telefone_empresa" class="celularmask"/>                                   
                        </div> 
                    </div>
                    
                    <div class="row form_hide">
                        <h3 style="padding-left: 15px;margin-bottom:20px;">Dados Pessoais</h3>
                        <div class="col-md-4 col-sm-6">
                            <label title="Seu Nome">Seu Nome<span style="color:#FF0000;">*</span></label>
                            <input title="Seu Nome" type="text" name="cliente_nome"/>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label title="CPF ou CNPJ">CPF<span style="color:#FF0000;">*</span></label>
                            <input title="CPF ou CNPJ" type="text" name="cpf" class="cpfmask"/>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label title="RG - (Documento de Identidade)">RG<span style="color:#FF0000;">*</span></label>
                            <input title="RG - (Documento de Identidade)" class="rgmask" type="text" name="rg"/>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label title="Data de Nascimento">Data de Nasc.<span style="color:#FF0000;">*</span></label>
                            <input title="Data de Nascimento" type="text" class="nascmask" name="nasc"/>
                        </div>
                    </div>
                    
                    <div class="row form_hide">
                        <div class="col-md-2 col-sm-3">
                            <label title="CEP">Preencha o CEP<span style="color:#FF0000;">*</span></label>
                            <input title="CEP" type="text" id="cep" name="cep"/>
                        </div>
                        <div class="col-md-4 col-sm-5">
                            <label title="Rua">Rua<span style="color:#FF0000;">*</span></label>
                            <input title="Rua" type="text" id="rua" name="rua"/>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <label title="Bairro">Bairro<span style="color:#FF0000;">*</span></label>
                            <input title="Bairro" type="text" id="bairro" name="bairro"/>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <label title="Cidade">Cidade<span style="color:#FF0000;">*</span></label>
                            <input title="Cidade" type="text" id="cidade" name="cidade"/>
                        </div> 
                        <div class="col-md-2 col-sm-4">
                            <label title="Estado">Estado<span style="color:#FF0000;">*</span></label>
                            <input title="Estado" type="text" id="uf" name="uf"/>
                        </div>                                                       
                        <div class="col-md-2 col-sm-4">
                            <label title="Número">Número</label>
                            <input title="Número" type="text" name="num"/>
                        </div>
                        <div class="col-md-5 col-sm-6">
                            <label title="E-mail">E-mail<span style="color:#FF0000;">*</span></label>
                            <input title="E-mail" type="text" name="email"/>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label title="WhatsApp">WhatsApp</label>
                            <input type="text" name="whatsapp" class="celularmask"/>
                        </div>
                    </div>
                    
                    <div class="row form_hide">
                        <div class="col-md-4 col-sm-12">
                            <label title="Apartamento">Apartamento<span style="color:#FF0000;">*</span></label>
                            <select title="Apartamento" name="apart_id">
                                @if(!empty($acomodacoes) && $acomodacoes->count() > 0)
                                    <option value="">Selecione</option>
                                    @foreach($acomodacoes as $apartamento)
                                        <option value="{{$apartamento->id}}" {{(!empty($dadosForm) && $dadosForm['apart_id'] == $apartamento->id ? 'selected' : '')}}>{{$apartamento->titulo}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label title="Adultos">Adultos<span style="color:#FF0000;">*</span></label>
                            <select name="num_adultos">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{$i}}" {{(!empty($dadosForm['adultos']) && $i == $dadosForm['adultos'] ? 'selected' : ($i == 1 ? 'selected' : ''))}}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label title="Crianças de 0 a 5 anos">Crianças de 0 a 5</label>
                            <select name="num_cri_0_5">
                                @for($i = 0; $i <= 5; $i++)
                                    <option value="{{$i}}" {{(!empty($dadosForm['cri_0_5']) && $i == $dadosForm['cri_0_5'] ? 'selected' : ($i == 0 ? 'selected' : ''))}}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div> 
                        <div class="col-md-2 col-sm-6">
                            <label title="Check In">Check In<span style="color:#FF0000;">*</span></label>
                            <input class="datepicker-here" type="text" name="checkin" data-language='pt-BR' value="{{(!empty($dadosForm['checkini']) ? $dadosForm['checkini'] : '')}}" />
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label title="Check Out">Check Out<span style="color:#FF0000;">*</span></label>
                            <input class="datepicker-here" type="text" name="checkout" data-language='pt-BR' value="{{(!empty($dadosForm['checkouti']) ? $dadosForm['checkouti'] : '')}}" />
                        </div>                               
                    </div>
                    
                    <div class="row form_hide"> 
                        <div class="col-md-8" style="text-align: right;">
                            <p><a href="javascript:;" data-toggle="modal" data-target="#politicas">Política de Reservas</a></p>
                        </div>                               
                        <div class="col-md-4">
                            <button type="submit" style="width: 100%;" id="js-contact-btn" class="default-btn">Enviar Agora</button>
                        </div>                        
                    </div>
                    <div class="row form_hide">
                        <div class="col-12" style="padding: 15px;">
                            <p>Obs. *Este formulário não garante a sua reserva, pois é necessário receber o contato da pousada para que seja realizado o procedimento de confirmação por completo.</p>
                        </div>
                    </div>
                    
                </form>                        
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="politicas">
	<div class="modal-dialog">
		<div class="modal-content">	
            @if (!empty($politicareserva))
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>{{$politicareserva->titulo}}</strong></h4>
                </div>              
                <div class="modal-body">            
                    <div class="row">  			   
                        <div class="col-md-12 form-group"> 
                            {!!$politicareserva->content!!}                                    
                        </div>
                    </div>            
                </div>
            @endif
	    </div>
    </div>
</div>
    
@endsection

@section('css')
<link href="{{url(asset('backend/plugins/airdatepicker/css/datepicker.min.css'))}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script src="{{url(asset('backend/plugins/airdatepicker/js/datepicker.min.js'))}}"></script>
<script src="{{url(asset('backend/plugins/airdatepicker/js/i18n/datepicker.pt-BR.js'))}}"></script>
<script src="{{url(asset('backend/assets/js/jquery.mask.js'))}}"></script>
<script>
    $(document).ready(function () { 
        var $cepmask = $(".cepmask");
        $cepmask.mask('99999-999', {reverse: false});
        var $rgmask = $(".rgmask");
        $rgmask.mask('99.999.999-9', {reverse: false});
        var $cpfmask = $(".cpfmask");
        $cpfmask.mask('999.999.999-99', {reverse: false});
        var $cnpjmask = $(".cnpjmask");
        $cnpjmask.mask('99.999.999/9999-99', {reverse: false});
        var $nascmask = $(".nascmask");
        $nascmask.mask('99/99/9999', {reverse: false});
        var $celularmask = $(".celularmask");
        $celularmask.mask('(99) 99999-9999', {reverse: false});
    });

    $(function(){

        $('.div_empresa').css("display", "none");

        $('.check_hospedagem').change(function() { 
            if ($(this).val() === '1') {
                $('.div_empresa').css("display", "none");
            } else {
                $('.div_empresa').css("display", "block"); 
            }       
        }); 
             
    });

    $(function(){

        $('.j_formsubmit').submit(function (){
            var form = $(this);
            var dataString = $(form).serialize();

            $.ajax({
                url: "{{ route('web.acomodacaoSend') }}",
                data: dataString,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    form.find("#js-contact-btn").attr("disabled", true);
                    form.find('#js-contact-btn').html("Carregando...");                
                    form.find('.alert').fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                success: function(resposta){
                    $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-130}, 'slow');
                    if(resposta.error){
                        form.find('#js-contact-result').html('<div class="alert alert-danger error-msg">'+ resposta.error +'</div>');
                        form.find('.error-msg').fadeIn();                    
                    }else{
                        form.find('#js-contact-result').html('<div class="alert alert-success error-msg">'+ resposta.sucess +'</div>');
                        form.find('.error-msg').fadeIn(); 
                        form.find('input[class!="noclear"]').val('');
                        form.find('textarea[class!="noclear"]').val('');
                        form.find('.form_hide').fadeOut(500); 
                        $('.contact-info').fadeOut(500);
                    }
                },
                complete: function(resposta){
                    form.find("#js-contact-btn").attr("disabled", false);
                    form.find('#js-contact-btn').html('Enviar Agora');                                
                }

            });

            return false;
        });
        
    });
    
</script>

<script>
    $(document).ready(function() {

        $("#rua").val("").attr("disabled", true);
        $("#bairro").val("").attr("disabled", true);
        $("#cidade").val("").attr("disabled", true);
        $("#uf").val("").attr("disabled", true);

        function limpa_formulário_cep() {
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
        }
        
        $("#cep").blur(function() {

            var cep = $(this).val().replace(/\D/g, '');

            if (cep != "") {
                
                var validacep = /^[0-9]{8}$/;

                if(validacep.test(cep)) {
                    
                    $("#rua").val("Carregando...").attr("disabled", false);
                    $("#bairro").val("Carregando...").attr("disabled", false);
                    $("#cidade").val("Carregando...").attr("disabled", false);
                    $("#uf").val("Carregando...").attr("disabled", false);
                    
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                        } else {
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } else {
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } else {
                limpa_formulário_cep();
            }
        });
    });

</script>

@endsection