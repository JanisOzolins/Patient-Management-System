<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body>

@include('sweet::alert')
    <div id="wrapper" class="container-fluid body-wrapper toggled">
        @include('layouts.sidebar')
        <div class="content-wrapper">
        @yield('content')
        </div>
    </div>


    @yield('page-script')

</body>

</html>
