<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/preview.min.css') }}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/font-awesome/font-awesome.min.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body style="padding: 7%">
@yield('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(function ()
    {
        $("a[href^='#demo']").click(function (evt)
        {
            evt.preventDefault();
            var scroll_to = $($(this).attr("href")).offset().top;
            $("html,body").animate({ scrollTop: scroll_to - 80 }, 600);
        });
        $("a[href^='#bg']").click(function (evt)
        {
            evt.preventDefault();
            $("body").removeClass("light").removeClass("dark").addClass($(this).data("class")).css("background-image", "url('bgs/" + $(this).data("file") + "')");
            console.log($(this).data("file"));


        });
        $("a[href^='#color']").click(function (evt)
        {
            evt.preventDefault();
            var elm = $(".tabbable");
            elm.removeClass("grey").removeClass("dark").removeClass("dark-input").addClass($(this).data("class"));
            if (elm.hasClass("dark dark-input"))
            {
                $(".btn", elm).addClass("btn-inverse");
            }
            else
            {
                $(".btn", elm).removeClass("btn-inverse");

            }

        });
        $(".color-swatch div").each(function ()
        {
            $(this).css("background-color", $(this).data("color"));
        });
        $(".color-swatch div").click(function (evt)
        {
            evt.stopPropagation();
            $("body").removeClass("light").removeClass("dark").addClass($(this).data("class")).css("background-color", $(this).data("color"));
        });
        $("#texture-check").mouseup(function (evt)
        {
            evt.preventDefault();

            if (!$(this).hasClass("active"))
            {
                $("body").css("background-image", "url(bgs/n1.png)");
            }
            else
            {
                $("body").css("background-image", "none");
            }
        });

        $("a[href='#']").click(function (evt)
        {
            evt.preventDefault();

        });

        $("a[data-toggle='popover']").popover({
            trigger:"hover",html:true,placement:"top"
        });
    });

</script>

</body>

<!-- Mirrored from codefeed.in.iis2103.shared-servers.com/tabs/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Oct 2016 15:38:10 GMT -->
</html>
