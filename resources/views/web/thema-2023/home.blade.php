@extends("web.{$configuracoes->template}.master.master")

@section('content')

    @if (!empty($slides) && $slides->count() > 0)
        <section class="slider-area">	
            <div class="slider-wrapper">
                @foreach ($slides as $key => $slide)
                    <div class="single-slide" style="background-image: url({{$slide->getimagem()}});">
                        <div class="banner-content overlay">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="text-content-wrapper slide-two">
                                            <div class="text-content text-center">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{--
                    //echo '<div class="item">';
                //    echo '    <div class="details">';
                //    echo '<div class="title"><span>'.$slide['titulo'].'</span></div>';
                //    if(!$slide['link']):
                //       echo ''; 
                //    else:
                //       echo '<div class="buttoncontainer"><a href="'.$slide['link'].'" class="button"><span data-hover="Conhe&ccedil;a mais">Conhe&ccedil;a mais</span></a></div>'; 
                //    endif;        
                //    echo '    </div>';
                //    echo '    <img alt="" src="'.BASE.'/tim.php?src='.BASE.'/uploads/banners/'.$slide['imagem'].'&w=1800&h=800&q=100&zc=1" width="1800" height="800" />';
                //    echo '</div>';--}}
                @endforeach
            </div>
        </section>
    @endif

    <section class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('web.reservar')}}" method="post" class="search-form">
                        @csrf
                        <div class="form-container fix">
                            <div class="box-select">
                                <div class="select date">
                                    <input type="text" class="datepicker-here" data-language='pt-BR' name="checkini" autocomplete="off" placeholder="Checkin" />
                                </div>
                                <div class="select date">
                                    <input type="text" class="datepicker-here" data-language='pt-BR' name="checkouti" autocomplete="off" placeholder="Checkout" />
                                </div>
                                <div class="select arrow">
                                    <select name="apart_id">
                                        @if(!empty($acomodacoes) && $acomodacoes->count() > 0)
                                            <option value="">Selecione</option>
                                            @foreach($acomodacoes as $apartamento)
                                                <option value="{{$apartamento->id}}" {{(!empty($dadosForm) && $dadosForm['apart_id'] == $apartamento->id ? 'selected' : '')}}>{{$apartamento->titulo}}</option>
                                            @endforeach                                                                        
                                        @endif
                                    </select>
                                </div>                                    
                            </div>
                            <button type="submit" class="search default-btn" name="SendReserva">Pré-reserva</button>
                        </div>
                    </form> 
                </div>
            </div>
            
            @if (!empty($pagina) && $pagina->count() > 0)
                <div class="row">
                    @foreach ($pagina as $item)
                        <div class="col-md-7">
                            <div class="video-wrapper mt-90">
                                <a href="{{route('web.pagina', [ 'slug' => $item->slug])}}">
                                    <div class="video-overlay">                                        
                                        <img height="400" src="{{$item->cover()}}" alt="{{$item->titulo}}"/>                                                                    
                                    </div>  
                                </a>                            
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="about-text">
                                <div class="section-title">
                                    <h3>{{$item->titulo}}</h3>
                                    {!!\App\Helpers\Renato::Words($item->content, 45)!!}
                                </div>
                                <div class="about-links">
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
                    @endforeach
                </div>
            @endif
                          
        </div>
    </section>

    @if (!empty($apartamentos) && $apartamentos->count() > 0)
        <section class="room-area pt-90">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>Apartamentos</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">  
                @foreach($apartamentos as $apartamento) 
                    <div class="single-room">
                        <img height="422" src="{{$apartamento->cover()}}" alt="{{$apartamento->cover()}}" title="{{$apartamento->titulo}}"/>
                        <div class="room-hover text-center">
                            <div class="hover-text">
                                <h3 style="font-size: 22px;"><a href="{{route('web.acomodacao', ['slug' => $apartamento->slug])}}">{{$apartamento->titulo}}</a></h3>
                                <p>&nbsp;</p>
                                <div class="room-btn">
                                    <a href="{{route('web.acomodacao', ['slug' => $apartamento->slug])}}" class="default-btn">Ver Detalhes</a>
                                </div>
                            </div>                        
                        </div>
                    </div>
                @endforeach     
            </div>
        </section>
    @endif

    @if (!empty($galerias) && $galerias->count() > 0)
        <section class="gallery-area pt-90">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>Galerias</h3>                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="gallery-container">            
                <div class="gallery-filter">
                    <button data-filter="*" class="active"> Todas</button>
                    @foreach($galerias as $key => $galHome)                    
                        <button data-filter=".{{$galHome->id}}">{{$galHome->titulo}}</button>
                    @endforeach
                </div>
                <div class="gallery gallery-masonry">    
                    @if (!empty($imagens) && $imagens->count() > 0)
                        @foreach ($imagens as  $key => $item)                                    
                            @if ($key <= 11)
                                <div class="gallery-item {{$item->galeria}}">
                                    <div class="thumb">
                                        <img width="370" height="284" src="{{ $item->url_image }}" alt="{{$item->galery->titulo}}"/>
                                    </div>
                                    <div class="gallery-hover">
                                        <div class="gallery-icon">
                                            <a href="{{route('web.galeria', ['slug' => $item->galery->slug])}}">
                                                <span class="p-img"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon/link.png')}}"/></span>
                                                <span class="s-img"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon/link-hover.png')}}"/></span>
                                            </a>
                                            <a class="image-popup" href="{{ $item->url_image }}">
                                                <span class="p-img"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon/search.png')}}"/></span>
                                                <span class="s-img"><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon/search-hover.png')}}"/></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif                                               
                        @endforeach
                    @endif                                        
                </div>
            </div>
        </section>
    @endif

    @if (!empty($artigos) && $artigos->count() > 0)
        <section class="blog-area" style="margin-top: 60px;margin-bottom: 40px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>Blog</h3>
                            <p>Acompanhe nossas novidades, dicas turísticas, passeios e muito mais</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="blog-carousel">
                        @foreach($artigos as $artigo)
                            <div class="col-xs-12">
                                <div class="single-blog-wrapper">
                                    <div class="single-blog">
                                        <div class="blog-image">
                                            <img width="370" height="250" src="{{$artigo->cover()}}" alt="{{$artigo->titulo}}"/>
                                        </div>
                                        <div class="blog-text">
                                            <h3>{{$artigo->titulo}}</h3>
                                        </div>
                                    </div>
                                    <div class="blog-hover">
                                        <h3><a href="{{route('web.blog.artigo', ['slug' => $artigo->slug])}}" title="{{$artigo->titulo}}">{{$artigo->titulo}}</a></h3>
                                        {!!\App\Helpers\Renato::Words($artigo->content, 15)!!}
                                        <a href="{{route('web.blog.artigo', ['slug' => $artigo->slug])}}" class="default-btn">Leia mais</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>        
    @endif

    @if (!empty($newsletterForm))
        <section class="newsletter-area bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-sm-12 col-xs-12">
                        <div class="newsletter-container">                    
                            <h3>Assine Nossa Newsletter</h3>                                       
                                <div class="newsletter-form">
                                    <form method="post" action="" class="mc-form fix j_submitnewsletter">
                                        @csrf
                                        <div id="js-newsletter-result"></div>
                                        <div class="form_hide">
                                            <!-- HONEYPOT -->
                                            <input type="hidden" class="noclear" name="bairro" value="" />
                                            <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
                                            <input type="hidden" class="noclear" name="status" value="1" />
                                            <input type="hidden" class="noclear" name="nome" value="#Cadastrado pelo Site" />
                                            <input id="mc-email" type="email" name="email" placeholder="Digite seu E-mail"/>
                                            <button id="mc-submit" type="submit" class="default-btn js-subscribe-btn">Cadastrar</button>                              
                                        </div>
                                    </form>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('css')
    <link href="{{url(asset('backend/plugins/airdatepicker/css/datepicker.min.css'))}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{url(asset('backend/plugins/airdatepicker/js/datepicker.min.js'))}}"></script>
    <script src="{{url(asset('backend/plugins/airdatepicker/js/i18n/datepicker.pt-BR.js'))}}"></script>
    <script>
        $(function () {

            // Seletor, Evento/efeitos, CallBack, Ação
            $('.j_submitnewsletter').submit(function (){
                var form = $(this);
                var dataString = $(form).serialize();

                $.ajax({
                    url: "{{ route('web.sendNewsletter') }}",
                    data: dataString,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        form.find(".js-subscribe-btn").attr("disabled", true);
                        form.find('.js-subscribe-btn').val("Carregando...");                
                        form.find('.alert').fadeOut(500, function(){
                            $(this).remove();
                        });
                    },
                    success: function(response){
                            $('html, body').animate({scrollTop:$('#js-newsletter-result').offset().top-150}, 'slow');
                        if(response.error){
                            form.find('#js-newsletter-result').html('<div class="alert alert-danger error-msg">'+ response.error +'</div>');
                            form.find('.error-msg').fadeIn();                    
                        }else{
                            form.find('#js-newsletter-result').html('<div class="alert alert-success error-msg">'+ response.sucess +'</div>');
                            form.find('.error-msg').fadeIn();                    
                            form.find('input[class!="noclear"]').val('');
                            form.find('.form_hide').fadeOut(500);
                        }
                    },
                    complete: function(response){
                        form.find(".js-subscribe-btn").attr("disabled", false);
                        form.find('.js-subscribe-btn').val("Cadastrar");                                
                    }

                });

                return false;
            });

            $('.datepicker-here').datepicker({
                autoClose: true,            
                minDate: new Date(),
                position: "top right", //'right center', 'right bottom', 'right top', 'top center', 'bottom center'
                
            });

        });
    </script>
@endsection