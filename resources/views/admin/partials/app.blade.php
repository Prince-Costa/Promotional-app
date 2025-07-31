@include('admin.partials.head')

<body>
<!--Main Navigation-->
<header>
    @include('admin.partials.side-nav')
    @include('admin.partials.top-nav')

</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="p-md-4 p-0 mt-5">
        @yield('content')
    </div>
</main>
<!--Main layout-->

<!-- jQuery -->
<script src="{{asset('public/assets/js/jquery-3.6.0.min.js')}}"></script>
<!-- MDB -->
<script type="text/javascript" src="{{asset('public/assets/js/mdb.umd.min.js')}}"></script>
<!-- Custom scripts -->
<script type="text/javascript" src="{{asset('public/assets/js/admin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

{{-- SummerNote Script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
@stack('js')
</body>

</html>
