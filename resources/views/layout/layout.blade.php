<!DOCTYPE html>
<html lang="en">
    @include('layout.header')
  
    <body class="with-welcome-text">
        <div class="container-scroller">
   
    @include('layout.navbar')


    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
       
    @include('layout.sidebar')


      <!-- Content -->
       @yield('content')
       <!-- END Content -->


       </div>
       <!-- page-body-wrapper ends -->

       </div>
    <!-- container-scroller -->

    @include('layout.footer')

    @yield('js')
  </body>
</html>