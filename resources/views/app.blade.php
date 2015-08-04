<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('/css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('/css/efeitoModal.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/relatorio.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button> -->
				<a class="navbar-brand" href="{{route('clientes')}}"><span class="glyphicon glyphicon-globe"></span> VB</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a href="{{ url('/admin/clientes') }}"><span class="glyphicon glyphicon-home"></span> </a></li>
                    <li class="dropdown"><a href="{{ url('/admin/manutencoes') }}" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('voos') }}">
                                    <span class="glyphicon glyphicon-plane"></span> Manutenção Voos</a></li>
                            <li><a href="{{ route('trens') }}">
                                    <span class="glyphicon glyphicon-bed"></span> Manutenção Trens</a></li>
                            <li><a href="{{ route('transfers') }}">
                                    <span class="glyphicon glyphicon-road"></span> Manutenção Transfers</a></li>
                            <li><a href="{{ route('passeios') }}">
                                    <span class="glyphicon glyphicon-grain"></span> Manutenção Passeios</a></li>
                            <li><a href="{{route('hoteis')}}">
                                    <span class="glyphicon glyphicon-king"></span> Manutenção Hoteis</a></li>
                            <li><a href="{{route('extras')}}">
                                    <span class="glyphicon glyphicon-wrench"></span> Manutenção Extras</a></li>
                            <li><a href="{{route('roteiros')}}">
                                    <span class="glyphicon glyphicon-pushpin"></span> Manutenção Roteiros</a></li>
                            <li><a href="{{route('situacao')}}">
                                    <span class="glyphicon glyphicon-pushpin"></span> Manutenção Situações</a></li>
                            <li><a href="{{route('categorias')}}">
                                    <span class="glyphicon glyphicon-pushpin"></span> Manutenção Categorias</a></li>
                            <li><a href="{{route('pacotes')}}">
                                    <span class="glyphicon glyphicon-pushpin"></span> Manutenção Pacotes</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="{{ url('/admin/lembretes') }}"><span class="glyphicon glyphicon-book"></span> </a></li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}"><span class="glyphicon glyphicon-user"></span> Login</a></li>
						<li><a href="{{ url('/auth/register') }}"><span class="glyphicon glyphicon-plus"></span> Cadastre-se</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Sair</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    {{--<script src="/../js/bootbox.min.js"></script>--}}
    {{--<script src="/../js/eventoVoltar.js"></script>--}}
    {{--<script src="/../js/bootstrap-confirmation.js"></script>--}}
    {{--<script src="/../js/bootstrap-confirmation.min.js"></script>--}}
     {{--Form correta de importação, garante o "base Path" --}}
    <script src="{{ asset('/js/eventoVoltar.js') }}"></script>
    <script src="{{ asset('/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-confirmation.min.js') }}"></script>
    <script src="{{ asset('/js/mascaras.js') }}"></script>

    <script src="{{ asset('/js/trocaBackground.js') }}"></script>


    <script src="{{ asset('/js/jquery.mask.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>

    @yield('post-script')


</body>
</html>

@section('post-script')
<script type="text/javascript">
    function trocaBackground(){

        var str = window.location.href.toString().split(window.location.host)[1];

        var res = str.substring(7, 15);

        if(res == 'clientes'){
            alert('background Clientes');

            document.body.style.backgroundImage = "url('//img/imgFundo.jpg')";
            document.body.style.backgroundAttachment = "fixed";
            document.body.style.backgroundRepeat = "repeat";
            document.body.style.backgroundPosition = "left top";
        }

    }

</script>
@endsection