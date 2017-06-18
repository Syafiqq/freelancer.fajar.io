<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 23 May 2017, 6:34 AM.
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
    <title>Dashboard</title>
    <meta name="description" content="">
    <?php foreach ((isset($meta) ? $meta : array()) as $k => $v)
    {
        echo "<meta name=\"${k}\" content=\"${v}\">";
    }
    ?>
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
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/bower_components/nprogress/nprogress.css') ?>">
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
                    <strong>Nomor</strong>
                </h4>
                <p id="modal_no">UU xx.xx.xxx</p>
                <hr>
                <h4>
                    <strong>Tentang</strong>
                </h4>
                <p id="modal_deskripsi"></p>
                <hr>
                <h4>
                    <strong>Status</strong>
                </h4>
                <p id="modal_status"></p>
            </div>
            <div class="modal-footer">
                <button id="modal-do-delete" class="btn btn-danger pull-left" data-toggle="confirmation" data-singleton="true"
                        data-btn-ok-label="Ya" data-btn-ok-icon="glyphicon glyphicon-trash"
                        data-btn-ok-class="btn-danger"
                        data-btn-cancel-label="Tidak"
                        data-btn-cancel-class="btn-success" data-btn-cancel-icon="glyphicon glyphicon-ok"
                        data-title="Hapus Status Hukum" data-content="Hapus Status Hukum Ini ?">
                    <i class="fa fa-trash"></i>
                    &nbsp;Delete Data
                </button>
                <a id="modal_source_download" class="btn btn-default" role="button" download>
                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    Download
                </a>
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
                    <a href="<?php echo site_url('dashboard') ?>" class="navbar-brand">
                        <strong>Status</strong>
                        Hukum
                    </a>
                </div>
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="<?php echo site_url('law/create') ?>">
                                <!-- The user image in the navbar-->
                                <i class="fa fa-plus"></i>
                                &nbsp;&nbsp;Status Hukum
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i>
                                &nbsp;&nbsp;Tag
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo site_url('tag/create') ?>">Tambah</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('tag') ?>">Modifikasi</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i>
                                &nbsp;&nbsp;Kategori
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo site_url('category/create') ?>">Tambah</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('category') ?>">Modifikasi</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-eye"></i>
                                &nbsp;&nbsp;Tampilan
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a class="view_layout_change" x-view="default" href="<?php echo site_url('dashboard') ?>">Default</a>
                                </li>
                                <li>
                                    <a class="view_layout_change" x-view="all" href="<?php echo site_url('dashboard') ?>">Semua Data</a>
                                </li>
                                <li>
                                    <a class="view_layout_change" x-view="search" href="<?php echo site_url('dashboard') ?>">Pencarian</a>
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
                    <li class="active">
                        <a href="<?php echo site_url('dashboard') ?>">
                            <i class="fa fa-dashboard"></i>
                            Dashboard
                        </a>
                    </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Peraturan</h3>
                    </div>
                    <div class="box-body" style="padding: 16px;min-height: 400px">
                        <div class="row" style="min-height: 600px">
                            <div class="col-md-10 col-md-offset-1">
                                <table id="uu_data" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 48px">No</th>
                                        <th style="width: 60px">Tahun</th>
                                        <th style="width: 250px">Kategori</th>
                                        <th>Nomor</th>
                                        <th style="width: 80px">Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($data as $key => $value)
                                    {
                                        $key += 1;
                                        echo '<tr>';
                                        echo "<td>{$key}</td><td>{$value['year']}</td><td>{$value['category']['name']}</td><td>{$value['no']}";
                                        foreach ($value['tag'] as $vt)
                                        {
                                            echo "&nbsp;&nbsp;<span class=\"label label-default\" style=\"background-color: #${vt['color']}; color: #${vt['colortext']}\"><abbr title=\"${vt['description']}\">${vt['name']}</abbr></span>";
                                        }
                                        echo "</td><td><button type=\"button\" action=\"" . site_url('law/do_get_detail?id=' . $value['id']) . "\" class=\"btn btn-go-detail btn-block btn-primary btn-xs\"><i class=\"fa fa-search\"></i> Detail</button></td>";
                                        echo '</tr>';
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Kategori</th>
                                        <th>Nomor</th>
                                        <th>Detail</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/js-cookie/src/js.cookie.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/bower_components/nprogress/nprogress.js') ?>"></script>
<script type="text/javascript">
    (function ($)
    {
        /*
         Fullscreen background
         */
        $(function ()
        {
            $(document).on('click', "a#sign-out, a#versioning", function (event)
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

            $(document).on('click', "button.btn-go-year", function (event)
            {
                event.preventDefault();
                location.href = $(this).attr('action');
            });

            $(document).on('click', "button.btn-go-detail", function (event)
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
                                $("p#modal_deskripsi").text("");
                                $("p#modal_status").text("");
                                $("h4#modal_title_no").text(data['data']['result']['no']);
                                $("p#modal_no").text(data['data']['result']['no']);
                                if (data['data']['result'].hasOwnProperty('tag'))
                                {
                                    for (var ti = -1, ts = data['data']['result']['tag'].length; ++ti < ts;)
                                    {
                                        $("p#modal_no").append("&nbsp;&nbsp;<span class=\"label label-default\" style=\"background-color: #" + data['data']['result']['tag'][ti]['color'] + "; color: #" + data['data']['result']['tag'][ti]['colortext'] + "\"><abbr title=\"" + data['data']['result']['tag'][ti]['description'] + "\">" + data['data']['result']['tag'][ti]['name'] + "</abbr></span>");
                                    }
                                }
                                $("p#modal_deskripsi").append(data['data']['result']['description']);
                                $("p#modal_status").append(data['data']['result']['status'] == null ? '-' : data['data']['result']['status']);
                                $("button#modal-do-edit").attr('action', data['data'].hasOwnProperty('edit') ? data['data']['edit'] : '<?php echo site_url('/dashboard')?>');
                                $("button#modal-do-delete").attr('action', data['data'].hasOwnProperty('delete') ? data['data']['delete'] : '<?php echo site_url('/dashboard')?>');
                                if (data['data']['result']['reference'] == null)
                                {
                                    $("a#modal_source_download").hide();
                                }
                                else
                                {
                                    $("a#modal_source_download").show();
                                    $("a#modal_source_download").attr('href', data['data']['result']['reference']);
                                }
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

            $(document).on('click', "button#modal-do-edit", function (event)
            {
                event.preventDefault();
                location.href = $(this).attr('action');
            });

            $('button#modal-do-delete').confirmation({
                popout: true,
                rootSelector: 'button#modal-do-delete',
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
                                        location.reload();
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

            var table = $('table#uu_data').DataTable({
                "paging": true,
                "pageLength": 15,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });

            $(document).on('click', 'a.view_layout_change', function (event)
            {
                event.preventDefault();
                var type = $(this).attr('x-view');
                var path = $('meta[name="path"]').attr('content');
                type = ((type === undefined) || (type === null)) ? 'default' : type;
                var attrib = {};
                if ((path !== undefined) && (path !== null))
                {
                    attrib['path'] = path;
                }
                Cookies.set('view_layout', type, attrib);
                location.reload(true);
            });

            NProgress.configure({
                showSpinner: false,
                template: '<div class="bar" role="bar" style="background-color: red"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'
            });
            NProgress.start();

            this.retreiveData = function (table, link, progress)
            {
                $.ajax({
                    type: 'post',
                    url: link,
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8; X-Requested-With: XMLHttpRequest'
                })
                    .done(function (data)
                    {
                        if (data.hasOwnProperty('data'))
                        {
                            if (data['data'].hasOwnProperty('data'))
                            {
                                var contents = data['data']['data'];
                                for (var i = -1; ++i < contents.length;)
                                {
                                    var content = contents[i];
                                    var tags = '';
                                    for (var j = -1; ++j < content['tag'].length;)
                                    {
                                        var tag = content['tag'][j];
                                        tags += "&nbsp;&nbsp;<span class=\"label label-default\" style=\"background-color: #" + tag['color'] + "; color: #" + tag['colortext'] + "\"><abbr title=\"" + tag['description'] + "\">" + tag['name'] + "</abbr></span>";
                                    }
                                    var edit_button = "<button type=\"button\" action=\"" + data['data']['on_edit'] + content['id'] + "\" class=\"btn btn-go-detail btn-block btn-primary btn-xs\"><i class=\"fa fa-search\"></i> Detail</button>";
                                    table.row.add([(i + 1), content['year'], content['category']['name'], content['no'] + tags, edit_button]);
                                }
                                table.draw(true);
                            }
                        }
                        progress.done();
                    })
                    .fail(function ()
                    {
                        progress.done();
                    });
            };

            var link = $('meta[name="source"]').attr('content');
            if ((link !== undefined) && (link !== null))
            {
                this.retreiveData(table, link, NProgress);
            }
        })

        /*
         * Run right away
         * */
    })(jQuery);
</script>
</body>
</html>
