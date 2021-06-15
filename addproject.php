<?php
session_start();
require_once './connection.php';
$obj = new conect();

if (isset($_SESSION['admin'])) {

    $where['user_id'] = $_SESSION['admin'];
    $dataname = $obj->my_select("tbl_user", $where)->fetch_object();
    $name = $dataname->user_name . " - Artist";
} elseif (isset($_SESSION['manager'])) {
    $where['user_id'] = $_SESSION['manager'];
    $dataname = $obj->my_select("tbl_user", $where)->fetch_object();
    $name = $dataname->user_name . " - Manager";
} else {
    header('location:index.php');
}



if (isset($_POST['submit'])) {

    echo $_POST['submit'];
    $data['p_name'] = $_POST['name'];
    $data['p_manager'] = $_POST['manager'];
    $data['p_artist'] = $_POST['artist'];
    $data['p_create'] = $dataname->user_id;

    $data['p_date'] = date("Y-m-d h:i:s");
//    print_r($data);

    $obj->my_insert('tbl_project', $data);
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


                                <div class="card-body" data-toggle="match-height">

                                    <form method="post" name="submit" action=""  enctype="multipart/form-data">

                                        <div class="insert-from-div">

                                            <div class='col-md-12'>
                                                <div class="md-form-group md-label-floating">
                                                    <input class="md-form-control" type="text" name='name' placeholder="Enter Projetc name Name"  required="" />
                                                    <?php
                                                    if (isset($_SESSION['manager'])) {
                                                        
                                                        ?>
                                                        <input type="hidden" name="manager" value="<?php echo $_SESSION['manager']; ?>" />
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <p>Select Product Manager</p>
                                                        <select name="manager" class="md-form-control" required="">

                                                            <option disabled="">Select Product Manager</option>
                                                            <?php
                                                            $team = $obj->my_query("select * from tbl_user where user_role = 2 and user_status = 1 order by user_id desc");
                                                            while ($row = $team->fetch_object()) {
                                                                ?>
                                                                <option value="<?php echo $row->user_id ?>"><?php echo $row->user_name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <?php
                                                    }
                                                    ?>

                                                    <p>Select Artist</p>
                                                    <select name="artist" class="md-form-control" required="">
                                                        <option disabled="" >Select Artist</option>
                                                        <?php
                                                        $artist = $obj->my_query("select * from tbl_user where user_role = 3 and user_status = 1 order by user_id desc");

                                                        while ($arow = $artist->fetch_object()) {
                                                            ?>
                                                            <option value="<?php echo $arow->user_id ?>"><?php echo $arow->user_name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>


                                                </div>
                                            </div>




                                        </div>

                                        <button class="btn btn-outline-primary btn-thick btn-pill" name="submit" type="submit">Submit</button>

                                        <button class="btn btn-outline-default btn-thick btn-pill" type="reset">Erase</button>

                                    </form>
                                </div>

                            </div>
                            <a href="allproject.php">All Project</a>
                        </div>
                        


                    </div>
                </div>
                <?php
//                    }
                ?>
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