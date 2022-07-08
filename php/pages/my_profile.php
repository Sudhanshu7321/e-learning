<?php
session_start();

include '../class/course.php';
$e_msg = "";
$s_msg = "";


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    // $user_name = $_SESSION['user_name'];

    include '../header_footer/login.php';
} else {
    header('location: ../../index.php');
}

if (isset($_REQUEST['profile_update'])) {
    $name =  $_POST['name'];
    $mobile_no =  $_POST['mobile'];
    $current_password = $_POST['current_password'];
    $update = new Course();
    $email;
    $update->profile_update($email, $current_password, $name, $mobile_no);
    $s_msg = $update->s_msg;
    $e_msg = $update->msg;
}

if (isset($_REQUEST['password_update'])) {
    $current_password = $_REQUEST['current_password'];
    $new_password = $_REQUEST['new_password'];
    $re_new_password = $_REQUEST['re_new_password'];
    $update = new Course();
    $update->password_update($email, $current_password, $new_password, $re_new_password);
    $s_msg = $update->s_msg;
    $e_msg = $update->msg;
}
?>

<body onload="onload()">


    <script>
        function onload() {
            document.getElementById('edit').style.display = 'none';

        }

        function display(active_body, deactive_body) {

            document.getElementById(active_body).style.display = 'block';
            document.getElementById(deactive_body).style.display = 'none';
        }
    </script>

    <center>
        <br><br>
        <div class="fluid" id="display" style="padding-top: 3.5%;">
            <div style="height: 405px;">
                <div class="card text-end" style="width: 80%;">
                    <div class="card-body">
                        <h4>MY Profile</h4>
                        <?php
                        $email = $_SESSION['email'];
                        $user_details = new Course();
                        $user_details->user_details($email);
                        echo '<h4 style="color: red;">' . $e_msg . '</h4>';
                        echo '<h4 style="color: green;">' . $s_msg . '</h4>';

                        ?>
                        <br>

                        <p class="card-text">
                        <table class="table">
                            <tr>
                                <td>
                                    <b>
                                        Name:

                                    </b>
                                </td>
                                <td>
                                    <?php echo  $user_details->user_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Mobile no:

                                    </b>
                                </td>
                                <td>
                                    <?php echo  ' ' . $user_details->mobile_no; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        Email id:

                                    </b>
                                </td>
                                <td>
                                    <?php echo   $user_details->email_id; ?>
                                </td>
                            </tr>
                            <tr>
                        </table>
                        </p>
                        <div style="float: right;">
                            <a href="#" class="btn btn-primary" onclick="display('edit','display')">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>


    <center>
        <div class="fluid" id="edit" style="padding-top: 3.5%;padding-bottom: 3.5%">
            <div class=" card-body" style="height: 405px;">
                <div class="card text-end" style="width: 80%;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <h4>Update Profile</h4>
                            <form action="" method="post">
                                <table class="table">
                                    <tr>
                                        <td>
                                            Name:
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="name" required value="<?php echo  $user_details->user_name; ?>">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Mobile no:
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="mobile" required value="<?php echo  $user_details->mobile_no; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email id:
                                        </td>
                                        <td>
                                            <?php echo  $user_details->email_id; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Currrent Password:
                                        </td>
                                        <td>
                                            <input class="form-control" type="password" required name="current_password">
                                        </td>
                                    </tr>
                                    <tr>
                                </table>

                                <div style="float: right;">
                                    <button type="submit" class="btn btn-success" name="profile_update">Update</button>
                                </div>
                            </form>
<br><br>
                            <p class="card-text"><b>Or Change Password</b></p>
                            <form action="" method="post">
                                <table class="table">
                                    <tr>
                                        <td>
                                            New Password:
                                        </td>
                                        <td>
                                            <input class="form-control" type="password" required name="new_password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Re-type New Password:
                                        </td>
                                        <td>
                                            <input class="form-control" type="password" required name="re_new_password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Currrent Password:
                                        </td>
                                        <td>
                                            <input class="form-control" type="password" required name="current_password">
                                        </td>
                                    </tr>
                                    <tr>
                                </table>

                                <div style="float: right;">
                                    <button type="submit" class="btn btn-success" name="password_update">Change Password</button>
                                    <a href="#" class="btn btn-primary" onclick="display('display','edit')">Cancle</a>
                                </div>
                            </form>


                    </div>
                </div>
            </div>
        </div>
        </div>

    </center>
</body>