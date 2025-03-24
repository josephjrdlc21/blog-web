<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{asset('assets/')}}" data-template="vertical-menu-template-free">
    <head>
        @include('backoffice._components.metas')
        @include('backoffice._components.styles')
        @vite(['App/Laravel/Src/backoffice/main.js'])
    </head>
    <body id="app">

        @include('backoffice._components.scripts')
    </body>
</html>
