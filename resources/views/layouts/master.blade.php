<!DOCTYPE html>
<html lang="en">
@include('layouts.include.head')
@stack('post_css')

<body>
    <div class="page-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    @include('layouts.include.footer')
</body>
@include('layouts.include.script')
@stack('post_script')

</html>
