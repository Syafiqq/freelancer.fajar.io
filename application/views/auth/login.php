<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 10 December 2016, 1:22 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
?>
<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" href="<?php echo base_url('/favicon-32x32.png') ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo base_url('/favicon-16x16.png') ?>" sizes="16x16">
    <link rel="manifest" href="<?php echo base_url('/manifest.json') ?>">
    <link rel="mask-icon" href="<?php echo base_url('/safari-pinned-tab.svg') ?>" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/tether/dist/css/tether.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/tether/dist/css/tether-theme-arrows-dark.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/bootstrap/dist/css/bootstrap-theme.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/auth/login/css/login.css') ?>">

    <script src="<?php echo base_url('assets/frontend/bower_components/initializr/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') ?>"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an
    <strong>outdated</strong>
                          browser. Please
    <a href="http://browsehappy.com/">upgrade your browser</a>
                          to improve your experience.
</p>
<![endif]-->
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" id="user_login" action="<?php echo site_url('auth/do_login') ?>" method="post">
                        <fieldset>
                            <div class="row">
                                <div class="center-block">
                                    <img class="profile-img"
                                         src="<?php echo base_url('assets/frontend/img/icon/justice-144px.png') ?>" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <h2 style="text-align: center">Status Hukum</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-envelope"></i>
                                                </span>
                                            <input class="form-control" placeholder="Email@host.com" name="user[email]" type="email" autofocus value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                            <input class="form-control" placeholder="Password" name="user[password]" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input id="user_login_submit" type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!--<div class="panel-footer ">
                    <p align="center">Don't have an account!</p>
                    <p align="center"><a href="#" onClick=""><h4 align="center">Sign Up Here !</h4></a></p>
                </div>-->
            </div>
        </div>
    </div>

    <footer>
        <p align="center">&copy; Freelancer <?php echo isset($year) ? $year : 2015; ?></p>
    </footer>
</div> <!-- /container -->
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/jquery/dist/jquery.min.js')?>"><\/script>')</script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/jquery-serialize-object/dist/jquery.serialize-object.min.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/initializr/js/plugins.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/auth/login/js/login.js') ?>"></script>
<script type="text/javascript">
    (function ($)
    {
        /*
         Fullscreen background
         */
        $(function ()
        {
            $("#user_login").on('submit', function (event)
            {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serializeObject(),
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8; X-Requested-With: XMLHttpRequest'
                })
                    .done(function (data)
                    {
                        if (data.hasOwnProperty('data'))
                        {
                            if (data['data'].hasOwnProperty('notify'))
                            {
                                var notify = data['data']['notify'];
                                for (var i = -1; ++i < notify.length;)
                                {
                                    $.notify({message: notify[i][0]}, {type: notify[i][1]});
                                }
                            }
                        }
                        if (data.hasOwnProperty('code'))
                        {
                            if (data['code'] == 200)
                            {
                                setTimeout(function ()
                                {
                                    if (data.hasOwnProperty('redirect'))
                                    {
                                        location.href = data['redirect'];
                                    }
                                }, 2000);
                            }
                        }

                    })
                    .fail(function ()
                    {
                        $.notify({
                            message: 'Error'
                        }, {
                            type: 'danger'
                        });
                    })
            });
        });

        /*
         * Run right away
         * */
    })(jQuery);
</script>
</body>
</html>

