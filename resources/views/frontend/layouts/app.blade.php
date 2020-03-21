<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('frontend.layouts.includes.head')
    <body>
    <header class="header bg-dark">
        @include('frontend.layouts.includes.header')
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        @include('frontend.layouts.includes.footer')
    </footer>

    @include('frontend.layouts.includes.script')
    </body>
</html>
@yield('script')
