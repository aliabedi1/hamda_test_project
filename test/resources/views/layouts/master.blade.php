<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-tag')
    @yield('head-tag')

</head>

<body >




    <section class="body-container">



        <section id="main-body" class="main-body">

            @yield('content')

        </section>
    </section>


    @include('layouts.scripts')
    @yield('script')


   

</body>
</html>
