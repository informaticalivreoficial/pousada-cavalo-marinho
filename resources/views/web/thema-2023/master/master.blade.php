<!DOCTYPE html>
<html lang="pt-br">
<head>	
    <meta charset="utf-8"/>    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="language" content="pt-br" /> 
    <meta name="author" content="{{env('DESENVOLVEDOR')}}"/>
    <meta name="designer" content="Renato Montanari">
    <meta name="publisher" content="Renato Montanari">
    <meta name="url" content="{{$configuracoes->dominio}}" />
    <meta name="keywords" content="{{$configuracoes->metatags}}">
    <meta name="distribution" content="web">
    <meta name="rating" content="general">
    <meta name="date" content="Dec 26">

    {!! $head ?? '' !!}

    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- CSS here -->
	<link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/css/shortcode/shortcodes.css')}}">
	<link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/css/style.css')}}">
	<link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/css/responsive.css')}}">
	<link rel="stylesheet" href="{{url('frontend/'.$configuracoes->template.'/assets/css/renato.css')}}">
	
		
    <link rel="shortcut icon" type="image/x-icon" href="{{$configuracoes->getfaveicon()}}" sizes="32x32" />
    
    @hasSection('css')
        @yield('css')
    @endif
</head>
<body>
	<header class="header-area fixed header-sticky">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
					<div class="logo">
						<a href="{{route('web.home')}}" style="width: 149px !important;">
							<img src="{{$configuracoes->getLogomarca()}}" alt="{{$configuracoes->nomedosite}}"/>
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-md-9 col-sm-9 hidden-xs">
					<div class="header-top fix">
						<div class="header-contact">
							<span class="text-theme" style="color: #fff !important;">Atendimento:</span>
							@if($configuracoes->telefone1)
								<span><a style="color: #fff !important;" href="tel:{{\App\Helpers\Renato::limpaTelefone($configuracoes->telefone1)}}">{{$configuracoes->telefone1}}</a></span>								
							@endif
							
							@if ($configuracoes->whatsapp)
								<img style="margin-left: 20px;" src="{{url('frontend/thema-2023/assets/images/zapzap.png')}}" width="16" height="16" />
								<span><a style="color: #fff !important;" target="_blank" class="sharezap" href="#"> {{$configuracoes->whatsapp}}</a></span>								
							@endif
						</div>
						<div class="header-links">
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
					<!-- Mainmenu Start -->
					<div class="main-menu hidden-xs">
						<nav>
							<ul>     
								<li><a href="{{route('web.acomodacoes')}}">Apartamentos</a></li> 
								@if (!empty($Links) && $Links->count())                            
									@foreach($Links as $menuItem)                            
									<li {{($menuItem->children && $menuItem->parent ? 'class=has-sub' : '')}}>
										<a {{($menuItem->target == 1 ? 'target=_blank' : '')}} href="{{($menuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($menuItem->post != null ? $menuItem->PostObject->slug : '#') ]) : $menuItem->url)}}" {{($menuItem->children && $menuItem->parent ? 'class=dropdown-toggle data-toggle=dropdown' : '')}}>{{ $menuItem->titulo }}{!!($menuItem->children && $menuItem->parent ? "<b class=\"caret\"></b>" : '')!!}</a>
										@if( $menuItem->children && $menuItem->parent)
										<ul class="submenu">
											@foreach($menuItem->children as $subMenuItem)
											<li><a {{($subMenuItem->target == 1 ? 'target=_blank' : '')}} href="{{($subMenuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($subMenuItem->post != null ? $subMenuItem->PostObject->slug : '#') ]) : $subMenuItem->url)}}">{{ $subMenuItem->titulo }}</a></li>                                        
											@endforeach
										</ul>
										@endif
									</li>
									@endforeach
								@endif

								
								<li><a href="{{route('web.blog.artigos')}}">Blog</a></li>                           
								<li><a href="{{route('web.atendimento')}}">Atendimento</a></li>
								<li><a href="{{route('web.reservar')}}">>> Pré-Reserva <<</a></li>
							</ul>
						</nav>
					</div>
					<!-- Mainmenu End -->
				</div>
			</div>
		</div>

		<!-- Mobile Menu Area start -->
		<div class="mobile-menu-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="mobile-menu">
							<nav id="dropdown">
								<ul>
									<li><a href="index.php">A Pousada</a>
										<ul class="submenu">
											<li><a href="#">Como Chegar</a></li>                                    
										</ul>
									</li>
									<li><a href="#">Apartamentos</a></li>
									<li><a href="#">Café da manhã</a></li>
									<li><a href="#">Lazer</a></li>
									<li><a href="#">Tarifário & Promoções</a></li>                            
									<li><a href="pagina/atendimento.php">Atendimento</a></li>
									<li><a href="{{route('web.reservar')}}">>> Pré-Reserva <<</a></li>
								</ul>
							</nav>
						</div>					
					</div>
				</div>
			</div>
		</div>
		<!-- Mobile Menu Area end --> 
	</header>

	<!-- main-area -->
	<main>
		@yield('content')
	</main>

	<footer class="footer-area">
		<!-- Footer Widget Start -->
		<div class="footer-widget-area bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="single-footer-widget" style="width: 90%;">
							<div class="footer-logo">
								<a href="{{route('web.home')}}">
									<img src="{{$configuracoes->getLogomarca()}}" alt="{{$configuracoes->nomedosite}}"/>
								</a>
							</div>
							{!!$configuracoes->descricao!!}
							<div class="social-icons">
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
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="single-footer-widget">
							<h3>links</h3>
							<ul class="footer-list">
								<li><a href="{{route('web.home')}}" title="Início">Início</a></li>
								<li><a href="{{route('web.acomodacoes')}}" title="Acomodações">Acomodações</a></li>
								<li><a href="{{route('web.galerias')}}" title="Galerias de Fotos">Galerias de Fotos</li>
								<li><a href="{{route('web.blog.artigos')}}" title="Blog">Blog</a></li>
								<li><a href="{{route('web.reservar')}}" title="Pré-reserva">Pré-reserva</a></li>
								<li><a href="{{route('web.atendimento')}}" title="Fale Conosco">Fale Conosco</a></li>
								<li><a href="{{route('web.politica')}}" title="Política de Privacidade">Política de Privacidade</a></li>
							</ul>
							<h3 style="margin-top: 30px !important;">Atendimento</h3>
							<div class="c-info">
								@if($configuracoes->rua)
									<li>
										<i class="icon fal fa-map-marker-check"></i>
										<span><i class="zmdi zmdi-pin"></i>
											{{$configuracoes->rua}}
											@if($configuracoes->num)
												, {{$configuracoes->num}}
											@endif	
											@if($configuracoes->bairro)
												<br>{{$configuracoes->bairro}}
											@endif
											@if($configuracoes->cidade)  
												- {{$configuracoes->cidade}}
											@endif
										</span>
									</li>
								@endif								
							</div>
							<div class="c-info"> 
								@if($configuracoes->email)
									<p>
										<i class="zmdi zmdi-email" style="margin-right:10px;color: #FF6600;"></i>									
										<a href="mailto:{{$configuracoes->email}}">{{$configuracoes->email}}</a>
									</p>
								@endif 
								@if($configuracoes->email1)
									<p>
										<i class="zmdi zmdi-email" style="margin-right:10px;color: #FF6600;"></i>									
										<a href="mailto:{{$configuracoes->email1}}">{{$configuracoes->email1}}</a>
									</p>
								@endif 
							</div>
							<div class="c-info">  
								@if($configuracoes->telefone1 || $configuracoes->telefone2 || $configuracoes->telefone3)
									<p>
										<i class="zmdi zmdi-phone" style="margin-right:10px;color: #FF6600;"></i>
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
											<i class="zmdi zmdi-phone" style="margin-right:10px;color: #FF6600;"></i>
											<a href="tel:{{\App\Helpers\Renato::limpaTelefone($configuracoes->telefone3)}}">{{$configuracoes->telefone3}}</a>
										</p>										
									@endif
									
								@endif  
							</div>
							<div class="c-info">   
								@if($configuracoes->whatsapp)
									<i class="zmdi zmdi-whatsapp" style="margin-right:10px;color: #FF6600;"></i>
									<a class="sharezap" href="#" target="_blank">{{$configuracoes->whatsapp}}</a>
								@endif
							</div>							
						</div>
					</div>					
	
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="single-footer-widget">
							<h3>Fotos</h3>
							@if (!empty($gbGallery) && $gbGallery->count() > 0)
								<div class="instagram-image">
									@foreach ($gbGallery as $galeria)
										@if($galeria->images()->get()->count() > 0)
											@foreach ($galeria->images()->get() as $key => $gb)
												@if ($key <= 5)
													<div class="footer-img">
														<a title="Galeria de fotos {{$galeria->titulo}}" href="{{route('web.galeria', [ 'slug' => $galeria->slug ])}}">
															<img width="85" height="80" alt="{{$galeria->titulo}}" src="{{$gb->url_image}}"/>
														</a>
													</div>
												@endif												
											@endforeach
										@endif
									@endforeach	
								</div>							
							@endif							                  
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Widget End -->
		<!-- Footer Bottom Area Start -->
		<div class="footer-bottom-area bg-black">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="footer-text text-center">
							&copy; {{date('Y')}} {{$configuracoes->nomedosite}} . Todos os direitos reservados. <span class="small text-silver-dark">Feito com <i style="color:red;" class="fa fa-heart"></i> por <a style="color:#fff;" target="_blank" href="{{env('DESENVOLVEDOR_URL')}}">{{env('DESENVOLVEDOR')}}</a></span>
						</div>
					</div>                
				</div>
			</div>
		</div>
		<!-- Footer Bottom Area End -->
	</footer>


	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery-1.12.4.min.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/bootstrap.min.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/modernizr-2.8.3.min.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.meanmenu.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.counterup.min.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/isotope.pkgd.min.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.magnific-popup.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/plugins.js')}}"></script>
	<script src="{{url('frontend/'.$configuracoes->template.'/assets/js/main.js')}}"></script>
	
	<script>
        $(function () {    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });    
        });
    </script>

    @hasSection('js')
        @yield('js')
    @endif    

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$configuracoes->tagmanager_id}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', '{{$configuracoes->tagmanager_id}}');
    </script>

	<script>
		$(document).ready(function() {
			var isMobile = {
				Android: function() {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function() {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function() {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				Opera: function() {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function() {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function() {
					return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
				}
			};
			if( isMobile.any() ) {
				$('.sharezap').attr("href", "https://api.whatsapp.com/send?l=pt_pt&phone="+{{ \App\Helpers\Renato::limpatelefone($configuracoes->whatsapp) }}+"&text=Atendimento "+"{{$configuracoes->nomedosite}}");
				return true; // está utilizando celular
			}else{
				$('.sharezap').attr("href", "https://web.whatsapp.com/send?l=pt_pt&phone="+{{ \App\Helpers\Renato::limpatelefone($configuracoes->whatsapp) }}+"&text=Atendimento "+"{{$configuracoes->nomedosite}}");
				return false; // não é celular
			}
		});
	</script>

    
    </body>
</html>