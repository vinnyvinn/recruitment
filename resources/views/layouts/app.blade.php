<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ settings('app_name') }}</title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('assets/img/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url('assets/img/icons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="{{ settings('app_name') }}"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ url('assets/img/icons/mstile-144x144.png') }}" />

    <link media="all" type="text/css" rel="stylesheet" href="{{ url(mix('assets/css/vendor.css')) }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url(mix('assets/css/app.css')) }}">
    <link media="all" rel="stylesheet" href="{{ url('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/select2/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/datepicker/css/gijgo.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/wysiwyg/summernote.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/wysiwyg/summernote-bs4.css') }}">

    @yield('styles')
</head>
<body>
    @include('partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')

            <div class="content-page">
                <main role="main" class="px-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="{{ url(mix('assets/js/vendor.js')) }}"></script>
    <script src="{{ url('assets/js/as/app.js') }}"></script>
    <script src="{{ url('vendor/select2/select2.full.min.js') }}"></script>
    <script src="{{ url('vendor/datepicker/js/gijgo.min.js') }}"></script>
    <script src="{{ url('vendor/wysiwyg/summernote.js') }}"></script>
    <script src="{{ url('vendor/wysiwyg/summernote-bs4.js') }}"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            $( ".select2" ).select2({
            theme: "bootstrap4"
            });
            $('.select-engine').select2();
            $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
            });
            $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4'
            });
            $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4'
            });
            
            $('#summernote').summernote({
                tabsize: 2,
                height: 100
            });
            var max_fields = 4; 
            var x = 1;
            $("#add").click(function() {
               
            if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#inner2").append($("#inner").html());
             } });

           $("#remove_button").on("click", function(event) {
                $("#inner2").children().last().remove();
                event.preventDefault();
            });

           var max_fields = 4; 
            var i = 1;
            $("#eduadd").click(function() {
               
            if(i < max_fields){ //max input box allowed
            i++; //text box increment
            $("#eduinner2").append($("#eduinner").html());
             } });

           $("#eduremove_button").on("click", function(event) {
                $("#eduinner2").children().last().remove();
                event.preventDefault();
            });


            var max_fields = 4; 
            var j = 1;
            $("#certadd").click(function() {
               
            if(j < max_fields){ //max input box allowed
            j++; //text box increment
            $("#certinner2").append($("#certinner").html());
             } });

           $("#certremove_button").on("click", function(event) {
                $("#certinner2").children().last().remove();
                event.preventDefault();
            });

             var max_fields = 4; 
            var f = 1;
            $("#langadd").click(function() {
               
            if(f < max_fields){ //max input box allowed
            f++; //text box increment
            $("#langinner2").append($("#langinner").html());
             } });

           $("#langremove_button").on("click", function(event) {
                $("#langinner2").children().last().remove();
                event.preventDefault();
            });

        });
        $(document).on('focus', '.datepicker',function(){
            $(this).datepicker({
                todayHighlight:true,
                format:'yyyy-mm-dd',
                autoclose:true
            })
        });
        function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

    </script>
</body>
</html>
