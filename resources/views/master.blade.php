<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        @include('includes.header')
    </head>
    <body>
        <div class="container">
            @include('includes.toppage')
            <div class="header clearfix">
                @include('includes.navigation')
            </div>
            {{--<div class="jumbotron">--}}
                {{--@include('includes.toppage')--}}
            {{--</div>--}}
            <div class="container theme-showcase panel panel-default" role="main">
                <div class="page-header">

                </div>
                <div class="panel-body">
                    @yield('content')
                </div>
                @include('includes.footer')
            </div>
        </div>
    </body>
</html>