<html>
<head>
    <!-- If you delete this meta tag, the ground will open and swallow you. -->
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Schoolopaedia - Smart School</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('school/css/email.css') }}">
</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<!-- HEADER -->
<table class="head-wrap" bgcolor="#999999">
    <tr>
        <td></td>
        <td class="header container" align="">
            <!-- /content -->
            <div class="content">
                <table bgcolor="#999999">
                    <tr>
                        <td><img src="{{ URL::asset('assets/images/logo.png') }}"/></td>
                        <td align="right"><h6 class="collapse">Schoolopaedia</h6></td>
                    </tr>
                </table>
            </div>
            <!-- /content -->
        </td>
        <td></td>
    </tr>
</table>
<!-- /HEADER -->
<!-- BODY -->
<table class="body-wrap" bgcolor="">
    <tr>
        <td></td>
        <td class="container" align="" bgcolor="#FFFFFF">
            @yield('content')    <!-- main container for body -->
        </td>
        <td></td>
    </tr>
</table>
<!-- /BODY -->
<!-- FOOTER -->
<!-- contact content -->
<div class="content">
    <table bgcolor="">
        <tr>
            <td>
                <!-- social & contact -->
                <table bgcolor="" class="social" width="100%">
                    <tr>
                        <td>
                            <!--- column 1 -->
                            <div class="column">
                                <table bgcolor="" cellpadding="" align="left">
                                    <tr>
                                        <td>
                                            <h5 class="">Connect with Us:</h5>
                                            <p class="">
                                                <a href="#" class="soc-btn fb">Facebook</a>
                                                <a href="#" class="soc-btn tw">Twitter</a>
                                                <a href="#" class="soc-btn gp">Google+</a>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                                <!-- /column 1 -->
                            </div>
                            <!--- column 2 -->
                            <div class="column">
                                <table bgcolor="" cellpadding="" align="left">
                                    <tr>
                                        <td>
                                            <h5 class="">Contact Info:</h5>
                                            <p>
                                                Phone: <strong>408.341.0600</strong><br/>
                                                Email: <strong><a href="emailto:summmmit44@gmail.com">summmmit44@gmail.com</a></strong>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                                <!-- /column 2 -->
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                </table>
                <!-- /social & contact -->
            </td>
        </tr>
    </table>
</div>
<!-- /contact content -->
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">
            <!-- content -->
            <div class="content">
                <table>
                    <tr>
                        <td align="center">
                            <p>
                                <a href="#">Terms</a> |
                                <a href="#">Privacy</a> |
                                <a href="#">
                                    <unsubscribe>Unsubscribe</unsubscribe>
                                </a>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /content -->
        </td>
        <td></td>
    </tr>
</table>
<!-- /FOOTER -->
</body>
</html>