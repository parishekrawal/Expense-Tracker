<!DOCTYPE html>
<html>
    <head>
        <title>Expense Tracker</title>
        <link rel="stylesheet" href="{{asset('css/myStyle.css')}}"/>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <div>
            @include('layouts.navigation')
            @if(isset($header))
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if(isset($filter))
                <div>
                    {{ $filter }}
                </div>
            @endif

            @if(isset($content))
            <main>
                {{ $content }}
            </main>
            @endif
        </div>
    </body>
</html>