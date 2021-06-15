<?php
session_start();
require_once './connection.php';
$obj = new conect();

if (isset($_SESSION['admin'])) {

    $where['user_id'] = $_SESSION['admin'];
    $dataname = $obj->my_select("tbl_user", $where)->fetch_object();
    $name = $dataname->user_name . " - Admin";
} elseif (isset($_SESSION['manager'])) {
    $where['user_id'] = $_SESSION['manager'];
    $dataname = $obj->my_select("tbl_user", $where)->fetch_object();
    $name = $dataname->user_name . " - Manager";
} elseif (isset($_SESSION['artist'])) {
    $where['user_id'] = $_SESSION['artist'];
    $dataname = $obj->my_select("tbl_user", $where)->fetch_object();
    $name = $dataname->user_name . " - Artist";
} else {
    header('location:index.php');
}

if (isset($_GET['project'])) {
    $project = $obj->mc_decrypt($_GET['project']);

    $pdata = $obj->my_select('tbl_project', ['p_id' => $project]);
    if ($pdata->num_rows == 1) {
        $pd = $pdata->fetch_object();
    } else {
        header('location:index.php');
    }
} else {
    header('location:index.php');
}



if (isset($_POST['submit'])) {

    $data['c_project_id'] = $project;
    $data['c_comment'] = $_POST['name'];
    $data['c_user_id'] = $_POST['user'];
    $data['c_date'] = date("Y-m-d h:i:s");
//    print_r($data);

    $obj->my_insert('tbl_comment', $data);
//    die();
}
?>


<!DOCTYPE html>
<html lang="en">


    <head>
        <?php
        require_once './head.php';
        ?>
    </head>
    <body class="layout layout-header-fixed">
        <?php
        require_once './header.php';
        ?>
        <div class="layout-main">
            <?php
            require_once 'sidebar.php';
            ?>
            <div class = "layout-content">

                <div class = "layout-content-body">




                    <div class="row gutter-xs" id="about">
                        <?php
//                        if (isset($_GET['insert'])) {
//                        $u_info = $obj->my_select('tbl_info', ['id' => $_GET['myupdate']])->fetch_object();
                        ?>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="col-md-12">
                                    <table class="table table-responsive table-bordered table-hover" >
                                        <thead>
                                            <tr class="mytr">

                                                <th style="text-align: center">
                                                    name
                                                </th>
                                                <th style="text-align: center">
                                                    Manager
                                                </th>
                                                <th style="text-align: center">
                                                    Artist
                                                </th>
                                                <th style="text-align: center">
                                                    Project Create
                                                </th>
                                                <th style="text-align: center" width='30%'>
                                                    Date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-capitalize"  style="text-align: center">
                                                    <?php echo $pd->p_name; ?>
                                                </td>
                                                <td class="text-capitalize"  style="text-align: center">

                                                    <?php
                                                    echo $obj->my_select('tbl_user', ['user_id' => $pd->p_manager])->fetch_object()->user_name;
                                                    ?>
                                                </td>
                                                <td class="text-capitalize"  style="text-align: center">
                                                    <?php echo $obj->my_select('tbl_user', ['user_id' => $pd->p_artist])->fetch_object()->user_name; ?>
                                                </td>
                                                <td class="text-capitalize"  style="text-align: center">
                                                    <?php echo $obj->my_select('tbl_user', ['user_id' => $pd->p_create])->fetch_object()->user_name; ?>
                                                </td>
                                                <td class="text-capitalize"  style="text-align: center">
                                                    <?php echo $pd->p_date ?>
                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>



                                <div class="card-body" data-toggle="match-height">

                                    <form method="post" name="submit" action=""  enctype="multipart/form-data">

                                        <div class="insert-from-div">

                                            <div class='col-md-12'>
                                                <div class="md-form-group md-label-floating">
                                                    <input class="md-form-control" type="text" name='name' placeholder="Enter Comment"  required="" />
                                              
                                                        <input type="hidden" name="user" value="<?php echo $dataname->user_id; ?>" />
                                                   


                                                </div>
                                            </div>




                                        </div>

                                        <button class="btn btn-outline-primary btn-thick btn-pill" name="submit" type="submit">Submit</button>

                                        <button class="btn btn-outline-default btn-thick btn-pill" type="reset">Erase</button>

                                    </form>
                                </div>
                                <div class="col-md-12 card">
                                    <?php
                                    $com = $obj->my_query("select * from tbl_comment where  c_project_id = " . $project . " order by c_id desc");
                                    while ($comment = $com->fetch_object()) {
                                        ?>
                                    <div style="background: #c9dde4;padding: 5px;margin: 10px;color: black">
                                        <p><?php echo $comment->c_comment; ?></p>
                                        <span>by. <b><?php echo $obj->my_select('tbl_user', ['user_id' => $comment->c_user_id])->fetch_object()->user_name; ?></b> - <?php echo $comment->c_date; ?></span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                            </div>
                            <a href="allproject.php">All Project</a>
                        </div>

                        <br />
                        <br />
                        <?php ?>

                    </div>
                    <div class="layout-footer">
                        <div class="layout-footer-body">
                            <small class="version">Version 1.0.0</small>
                            <!--<small class="copyright">2016 &copy; Elephant By <a href="http://naksoid.com/">Naksoid</a></small>-->
                        </div>
                    </div>
                </div>

                <?php
                require_once './footerjs.php';
                ?>
                </body>

                </html>