    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        .bg-dark {
            background-image: linear-gradient(to right, rgb(71, 16, 224, 0.7), rgb(179, 9, 217, 0.7), rgb(71, 16, 224, 0.7));
            background-color: red;

        }
    </style>
    <?php

if(isset($_SESSION['email'])){

}else{
    header('location:../../index.php');
}
    // $page = basename($_SERVER['PHP_SELF']);

    // $email = $_SESSION['email'];
    // $user_details = new Course();
    // $user_details->user_details($email);
    // $user_name =  $user_details->user_name;
    // $user_id =  $user_details->user_id;
    // if ($page == "index.php") {
    //     $aa = 'php';
    // } else if ($page == "TxnStatus.php") {
    //     $aa = '../../';
    // } else {
    //     $aa = '..';
    // }
    ?>

    <nav class="navbar navbar-light bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../admin/">
                <img src="https://www.learnvern.com/images/logo.png" alt="" width="auto" height="auto">
            </a>


            <div class="dropdown">
                <h5 style="color: white;" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"> Admin</i></option>

                </h5>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="../admin/index.php">Home</a></li>
                    <li>
                        <form action="edit_course.php" method="POST">
                            <button class="dropdown-item" type="submit" name="add_course" value="add_course" id="">Add Course </button>
                        </form>
                    </li>
                    <li><a class="dropdown-item" href="../login_registration/logout.php">Logout</a></li>
                </ul>
            </div>

    </nav>
    <br> <br> <br> <br>