<html>
<head>
{{ HTML::style('css/semantic.min.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/semantic.min.js') }}
{{ HTML::script('js/filters.js') }}
</head>
    <body>
    <div class="ui grid">
    @yield('container')
        <div class="ui segment grid">
            <div class="four wide column"></div>
            <div class="ten wide column">Bienvenue sur l'application MyNotes</div>
            <div class="two wide column"><a href="{{ URL::to('logout') }}">Se déconecter<i class="medium red sign out icon"></i></a></div>
        </div>
        <div class="ui grid">
        @section('center')
            <div class="two wide column">
                    @yield('navigation')
            </div>
            <div class="fourteen wide column">
                <div class="ui segment">
                @yield('content')
                </div>
            </div>
        </div>
        @show

        <div class="ui grid">
            <div class="ui column">
                <div class="ui segment">
                    Pied de page
                </div>
            </div>
        </div>
    </div>
    </body>
</html>