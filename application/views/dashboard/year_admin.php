<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 10 December 2016, 10:42 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
if (!isset($data))
{
    $data = array();
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
    <title>UU Tahun <?php echo $dataYear ?></title>
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modal_title_no" style="font-weight: bold">New message</h4>
            </div>
            <div class=modal-body>
                <h4>
                    <strong>No</strong>
                </h4>
                <p id="modal_no">UU xx.xx.xxx</p>
                <hr>
                <h4>
                    <strong>Deskripsi</strong>
                </h4>
                <p id="modal_deskripsi">Ini adalah deskripsi</p>
                <hr>
                <h4>
                    <strong>Status</strong>
                </h4>
                <p id="modal_status">Ini adalah status</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="modal-do-edit" type="button" class="btn btn-primary">
                    <i class="fa fa-pencil"></i>
                    &nbsp;Edit Data
                </button>
            </div>
        </div>
    </div>
</div>
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
                    <a href="<?php echo base_url('dashboard') ?>" class="navbar-brand">
                        <strong>Status</strong>
                        Hukum
                    </a>
                </div>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <i class="fa fa-gears"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a id="sign-out" href="<?php echo base_url('auth/do_signout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
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
                        <a href="<?php echo base_url('dashboard') ?>">
                            <i class="fa fa-dashboard"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="active">Tahun</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Undang Undang Tahun <?php echo $dataYear ?></h3>
                    </div>
                    <div class="box-body">
                        <?php
                        if (count($data) > 0)
                        {
                            ?>
                            <div class="row" style="min-height: 600px">
                                <div class="col-md-10 col-md-offset-1">
                                    <table id="uu_data" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 48px">No</th>
                                            <th style="width: 60px">Tahun</th>
                                            <th>No Undang Undang</th>
                                            <th style="width: 80px">Detail</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($data as $key => $value)
                                        {
                                            $key += 1;
                                            echo '<tr>';
                                            echo "<td>{$key}</td><td>{$value['year']}</td><td>{$value['no']}";
                                            foreach ($value['tag'] as $vt)
                                            {
                                                echo "&nbsp;&nbsp;<span class=\"label label-default\" style=\"background-color: #${vt['color']}; color: #${vt['colortext']}\"><abbr title=\"${vt['description']}\">${vt['name']}</abbr></span>";
                                            }
                                            echo "</td><td><button type=\"button\" action=\"" . site_url('dashboard/do_get_detail?id=' . $value['id']) . "\" class=\"btn btn-go-detail btn-block btn-primary btn-xs\"><i class=\"fa fa-search\"></i> Detail</button></td>";
                                            echo '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>No Undang Undang</th>
                                            <th>Detail</th>
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
                                    <h5 align="center">Tidak Terdapat Undang Undang Pada Tahun Ini</h5>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
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
                <a href="<?php echo base_url('dashboard') ?>">
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
            $("a#sign-out, a#versioning").on('click', function (event)
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

            $("button#modal-do-edit").on('click', function (event)
            {
                event.preventDefault();
                console.log("abc");
            });

            $("button.btn-go-detail").on('click', function (event)
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
                            if (data['data'].hasOwnProperty('result'))
                            {
                                $("h4#modal_title_no").text(data['data']['result']['no']);
                                $("p#modal_no").text(data['data']['result']['no']);
                                if (data['data']['result'].hasOwnProperty('tag'))
                                {
                                    console.log(data['data']['result']['tag']);
                                    for (var ti = -1, ts = data['data']['result']['tag'].length; ++ti < ts;)
                                    {
                                        $("p#modal_no").append("&nbsp;&nbsp;<span class=\"label label-default\" style=\"background-color: #" + data['data']['result']['tag'][ti]['color'] + "; color: #" + data['data']['result']['tag'][ti]['colortext'] + "\"><abbr title=\"" + data['data']['result']['tag'][ti]['description'] + "\">" + data['data']['result']['tag'][ti]['name'] + "</abbr></span>");
                                    }
                                }
                                $("p#modal_deskripsi").text(data['data']['result']['description']);
                                $("p#modal_status").text(data['data']['result']['status'] == null ? '-' : data['data']['result']['status']);
                                $("button#modal-do-edit").attr('action', data['data'].hasOwnProperty('edit') ? data['data']['edit'] : '<?php echo site_url('dashboard/year?year=' . $dataYear)?>');
                                $('#myModal').modal('show');
                            }
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
                    })
                    .fail(function ()
                    {
                        $.notify({
                            message: 'Error'
                        }, {
                            // settings
                            type: 'danger'
                        });
                    });
            });

            $('table#uu_data').DataTable({
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
