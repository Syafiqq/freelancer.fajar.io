<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 10 December 2016, 10:42 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

if (!isset($dataCount))
{
    $dataCount = array();
}

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
    <title>Label Pendukung</title>
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" href="<?php echo base_url('/favicon-32x32.png') ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo base_url('/favicon-16x16.png') ?>" sizes="16x16">
    <link rel="manifest" href="<?php echo base_url('/manifest.json') ?>">
    <link rel="mask-icon" href="<?php echo base_url('/safari-pinned-tab.svg') ?>" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/datatables/media/css/dataTables.bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/bootstrap/dist/css/bootstrap-theme.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/AdminLTE/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css') ?>">

    <script src="<?php echo base_url('assets/frontend/bower_components/initializr/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') ?>"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets/frontend/bower_components/AdminLTE/dist/js/html5shiv.min.js')?>"></script>
    <script src="<?php echo base_url('assets/frontend/bower_components/AdminLTE/dist/js/respond.min.js')?>"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue layout-top-nav">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an
    <strong>outdated</strong>
                          browser. Please
    <a href="http://browsehappy.com/">upgrade your browser</a>
                          to improve your experience.
</p>
<![endif]-->
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="<?php echo site_url('dashboard') ?>" class="navbar-brand">
                        <strong>Status</strong>
                        Hukum
                    </a>
                </div>
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-plus"></i>
                                Tambah
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo site_url('dashboard/create') ?>">Status Hukum</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('dashboard/createtag') ?>">Label Pendukung</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo site_url('dashboard/tag') ?>">Modifikasi Label Pendukung</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <!-- Menu Toggle Button -->
                            <a id="sign-out" href="<?php echo site_url('auth/do_signout') ?>">
                                <!-- The user image in the navbar-->
                                <i class="fa fa-sign-out"></i>
                                &nbsp;&nbsp;Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    &nbsp;
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo site_url('dashboard') ?>">
                            <i class="fa fa-dashboard"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="active">Label Pendukung</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Label Pendukung</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        if (count($dataCount) > 0)
                        {
                            ?>
                            <div class="row" style="min-height: 600px">
                                <div class="col-md-10 col-md-offset-1">
                                    <table id="table_edittag" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 48px">No</th>
                                            <th>Label Pendukung</th>
                                            <th style="width: 80px">Edit</th>
                                            <th style="width: 80px">Hapus</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($dataCount as $key => $value)
                                        {
                                            $key += 1;
                                            echo '<tr>';
                                            echo "<td>{$key}</td>
                                                  <td><span class=\"label label-default\" style=\"background-color: #${value['color']}; color: #${value['colortext']}\"><abbr title=\"${value['description']}\">${value['name']}</abbr></span></td>
                                                  <td><button type=\"button\" action=\"" . site_url('dashboard/edittag?id=' . $value['id']) . "\" class=\"btn btn-do-edit btn-block btn-primary btn-xs\"><i class=\"fa fa-pencil\"></i>&nbsp;&nbsp;Edit</button></td>
                                                  <td><button action=\"" . site_url('dashboard/do_deletetag?id=' . $value['id']) . "\"  class=\"btn btn-do-delete btn-block btn-danger btn-xs\" data-toggle=\"confirmation\" data-singleton=\"true\"
                                                        data-btn-ok-label=\"Ya\" data-btn-ok-icon=\"glyphicon glyphicon-trash\"
                                                        data-btn-ok-class=\"btn-danger\"
                                                        data-btn-cancel-label=\"Tidak\"
                                                        data-btn-cancel-class=\"btn-success\" data-btn-cancel-icon=\"glyphicon glyphicon-ok\"
                                                        data-title=\"Hapus Label\" data-content=\"Hapus Label Ini ?\">
                                                    <i class=\"fa fa-trash\"></i>
                                                    &nbsp;&nbsp;Hapus
                                                    </button></td>";
                                            echo '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Pendukung</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="row" style="height: 800px">
                                <div class="col-md-12">
                                    <h5 align="center">Tidak Ada Status Hukum yang dapat dimuat</h5>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="box-footer">
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <strong>Copyright &copy; Freelancer <?php echo isset($year) ? $year : 2016; ?>
                <a href="<?php echo site_url('dashboard') ?>">
                    <strong>Status</strong>
                    Hukum
                </a>
                    .
            </strong>
            All rights reserved.
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/jquery/dist/jquery.min.js')?>"><\/script>')</script>

<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/bootstrap-confirmation2/bootstrap-confirmation.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/datatables/media/js/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/fastclick/lib/fastclick.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/AdminLTE/dist/js/app.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/initializr/js/plugins.js') ?>"></script>
<script type="text/javascript">
    (function ($)
    {
        /*
         Fullscreen background
         */
        $(function ()
        {
            $("a#sign-out").on('click', function (event)
            {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: $(this).attr('href'),
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
                                    $.notify({message: notify[i][0]}, {
                                        type: notify[i][1],
                                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                                        '<span data-notify="icon"></span> ' +
                                        '<span data-notify="title">{1}</span> ' +
                                        '<span style="color: black" data-notify="message">{2}</span>' +
                                        '<div class="progress" data-notify="progressbar">' +
                                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                        '</div>' +
                                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                        '</div>'
                                    });
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
                            // settings
                            type: 'danger'
                        });
                    })
            });

            $("button.btn-do-edit").on('click', function (event)
            {
                event.preventDefault();
                location.href = $(this).attr('action');
            });

            $('button.btn-do-delete').confirmation({
                popout: true,
                rootSelector: 'button.btn-do-delete',
                container: 'body',
                onConfirm: function ()
                {
                    event.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: $(this).attr('action'),
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
                                        $.notify({message: notify[i][0]}, {
                                            type: notify[i][1],
                                            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                                            '<span data-notify="icon"></span> ' +
                                            '<span data-notify="title">{1}</span> ' +
                                            '<span style="color: black" data-notify="message">{2}</span>' +
                                            '<div class="progress" data-notify="progressbar">' +
                                            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                            '</div>' +
                                            '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                            '</div>'
                                        });
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
                                // settings
                                type: 'danger'
                            });
                        })
                }
            });

            $('table#table_edittag').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        /*
         * Run right away
         * */
    })(jQuery);
</script>
</body>
</html>
