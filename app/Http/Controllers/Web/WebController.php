<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Web\Atendimento;
use App\Mail\Web\AtendimentoRetorno;
use Illuminate\Support\Facades\Storage;

use App\Models\{
    Apartamento,
    Post,
    CatPost,
    Galeria,
    GaleriaGb,
    Newsletter,
    Slide,
    User
};
use App\Services\ConfigService;
use App\Support\Seo;
use Carbon\Carbon;

class WebController extends Controller
{
    protected $configService, $estadoService, $cidadeService;
    protected $seo;

    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
        $this->seo = new Seo();        
    }

    public function home()
    {
        $acomodacoes = Apartamento::available()->get();
        $apartamentos = Apartamento::available()
                    ->where('exibir_home', 1)
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();
        $pagina = Post::postson()->inRandomOrder()->limit(1)->get();
        $artigos = Post::orderBy('created_at', 'DESC')->where('tipo', 'artigo')
                    ->postson()
                    ->limit(6)
                    ->get();
        $slides = Slide::orderBy('created_at', 'DESC')
                    ->available()
                    ->where('expira', '>=', Carbon::now())
                    ->get();   
        $galerias = Galeria::orderBy('created_at', 'DESC')->available()->limit(3)->get();
        $imagens = GaleriaGb::orderBy('created_at', 'DESC')->get();
        
        $head = $this->seo->render($this->configService->getConfig()->nomedosite ?? 'Informática Livre',
            $this->configService->getConfig()->descricao ?? 'Informática Livre desenvolvimento de sistemas web desde 2005',
            route('web.home'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        ); 

		return view('web.'.$this->configService->getConfig()->template.'.home',[
            'head' => $head,            
            'slides' => $slides,
            'apartamentos' => $apartamentos,
            'artigos' => $artigos,
            'acomodacoes' => $acomodacoes,
            'galerias' => $galerias,
            'imagens' => $imagens,
            'pagina' => $pagina
		]);
    }

    public function quemsomos()
    {
        $paginaQuemSomos = Post::where('tipo', 'pagina')->postson()->where('id', 5)->first();
        $head = $this->seo->render('Quem Somos - ' . $this->configService->getConfig()->nomedosite,
            $this->configService->getConfig()->descricao ?? 'Informática Livre desenvolvimento de sistemas web desde 2005',
            route('web.quemsomos'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );
        return view('web.'.$this->configService->getConfig()->template.'.quem-somos',[
            'head' => $head,
            'paginaQuemSomos' => $paginaQuemSomos
        ]);
    }

    public function politica()
    {
        $head = $this->seo->render('Política de Privacidade - ' . $this->configService->getConfig()->nomedosite ?? 'Informática Livre',
            'Política de Privacidade - ' . $this->configService->getConfig()->nomedosite,
            route('web.politica'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.politica',[
            'head' => $head
        ]);
    }

    public function artigos()
    {
        $posts = Post::orderBy('created_at', 'DESC')->where('tipo', '=', 'artigo')->postson()->paginate(20);
        $head = $this->seo->render('Blog - ' . $this->configService->getConfig()->nomedosite ?? 'Informática Livre',
            'Blog - ' . $this->configService->getConfig()->nomedosite,
            route('web.blog.artigos'),
            $this->configService->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );
        return view('web.'.$this->configService->getConfig()->template.'.blog.artigos', [
            'head' => $head,
            'posts' => $posts
        ]);
    }

    public function artigo(Request $request)
    {
        $post = Post::where('slug', $request->slug)->postson()->first();
        
        $postsMais = Post::orderBy('views', 'DESC')
            ->where('id', '!=', $post->id)
            ->where('tipo', 'artigo')
            ->limit(4)
            ->postson()
            ->get();        
        
        $post->views = $post->views + 1;
        $post->save();

        $head = $this->seo->render($post->titulo ?? 'Informática Livre',
            $post->titulo,
            route('web.blog.artigo', ['slug' => $post->slug]),
            $post->cover() ?? $this->configService->getConfig()->getMetaImg()
        );

        return view('web.'.$this->configService->getConfig()->template.'.blog.artigo', [
            'head' => $head,
            'post' => $post,
            'postsMais' => $postsMais
        ]);
    }   

    public function pagina($slug)
    {
        $post = Post::where('slug', $slug)->where('tipo', 'pagina')->postson()->first();        
        $post->views = $post->views + 1;
        $post->save();

        $postsMais = Post::orderBy('views', 'DESC')
                ->where('id', '!=', $post->id)
                ->where('tipo', 'pagina')
                ->limit(3)
                ->postson()
                ->get();

        $head = $this->seo->render($post->titulo ?? 'Informática Livre',
            $post->titulo,
            route('web.pagina', ['slug' => $post->slug]),
            $post->cover() ?? $this->configService->getConfig()->getMetaImg()
        );

        return view('web.'.$this->configService->getConfig()->template.'.pagina', [
            'head' => $head,
            'post' => $post,
            'postsMais' => $postsMais
        ]);
    }    
    
    public function atendimento()
    {
        $head = $this->seo->render('Atendimento - ' . $this->configService->getConfig()->nomedosite,
            'Nossa equipe está pronta para melhor atender as demandas de nossos clientes!',
            route('web.atendimento'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );        

        return view('web.'.$this->configService->getConfig()->template.'.atendimento', [
            'head' => $head            
        ]);
    }

    public function acomodacoes()
    {
        $acomodacoes = Apartamento::available()->paginate(20);
        $head = $this->seo->render('Apartamentos - ' . $this->configService->getConfig()->nomedosite,
            $this->configService->getConfig()->descricao ?? 'Informática Livre desenvolvimento de sistemas web desde 2005',
            route('web.acomodacoes'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );
        return view('web.'.$this->configService->getConfig()->template.'.acomodacoes.index',[
            'head' => $head,
            'acomodacoes' => $acomodacoes
        ]);
    }

    public function reservar(Request $request)
    {
        $dadosForm = $request->all();
        $acomodacoes = Apartamento::available()->get();        
        $politicareserva = Post::where('id', 18)->first();        

        $head = $this->seo->render('Pré-reserva - ' . $this->configService->getConfig()->nomedosite,
            'Pré-reserva - ' . $this->configService->getConfig()->nomedosite,
            route('web.reservar'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );
        
        return view('web.'.$this->configService->getConfig()->template.'.acomodacoes.reservar',[
            'head' => $head,
            'dadosForm' => $dadosForm,
            'acomodacoes' => $acomodacoes,
            'politicareserva' => $politicareserva
        ]);
    }

    public function acomodacao($slug)
    {
        $acomodacao = Apartamento::where('slug', $slug)->available()->first();
        $acomodacoes = Apartamento::where('id', '!=', $acomodacao->id)->available()->limit(4)->get();

        $acomodacao->views = $acomodacao->views + 1;
        $acomodacao->save();

        $paginareserva = Post::where('id', 5)->first();
        $paginareserva->views = $paginareserva->views + 1;
        $paginareserva->save();

        $head = $this->seo->render($acomodacao->titulo . ' - ' . $this->configService->getConfig()->nomedosite,
            $acomodacao->descricao ?? 'Informática Livre desenvolvimento de sistemas web desde 2005',
            route('web.acomodacao', ['slug' => $acomodacao->slug]),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );
        return view('web.'.$this->configService->getConfig()->template.'.acomodacoes.acomodacao',[
            'head' => $head,
            'acomodacao' => $acomodacao,
            'acomodacoes' => $acomodacoes
        ]);
    }

    public function avaliacaoCliente(Request $request)
    {
        $head = $this->seo->render('Questionário de avaliação - ' . $this->configService->getConfig()->nomedosite,
            'Questionário de avaliação',
            route('web.avaliacao'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.cliente.avaliacao',[
            'head' => $head
        ]);
    }

    public function sitemap()
    {
        $url = $this->configService->getConfig()->sitemap;
        $data = file_get_contents($url);
        return response($data, 200, ['Content-Type' => 'application/xml']);
    }

    public function galerias()
    {
        $galerias = Galeria::orderBy('created_at', 'DESC')->available()->get();
        
        $head = $this->seo->render('Galerias de Fotos - ' . $this->configService->getConfig()->nomedosite,
            'Galerias de Fotos',
            route('web.galerias'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.galerias',[
            'galerias' => $galerias,
            'head' => $head
        ]);
    }

    public function galeria($slug)
    {
        $galeria = Galeria::where('slug', $slug)->available()->first();
        
        $head = $this->seo->render($galeria->titulo . ' - ' . $this->configService->getConfig()->nomedosite,
            $galeria->titulo,
            route('web.galeria', ['slug' => $galeria->slug]),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.galeria',[
            'galeria' => $galeria,
            'head' => $head
        ]);
    }
    
}
