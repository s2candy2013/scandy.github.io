<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Khôi phục mật khẩu</title>
    <link rel="shortcut icon" type="image/png" href="upload/logo/icon_ai.png">
    <style type="text/css">
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    /* Full-width input fields */
    input[type=text] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    /* Add a background color when the inputs get focus */
    input[type=text]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for all buttons */
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    button:hover {
        opacity: 1;
    }

    /* Extra styles for the cancel button */

    /* Float cancel and signup buttons and add an equal width */


    /* Add padding to container elements */
    .container {
        padding: 0px 16px 16px 16px;
    }

    .container .logo {
        margin: auto;
        width: 60%;
    }

    .logo {
        margin: auto;
        width: 60%;
    }

    /* The Modal (background) */
    .modal {
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: #474e5d;
        padding-top: 50px;
    }


    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 40%;
        /* Could be more or less, depending on screen size */
    }

    /* Style the horizontal ruler */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }


    /* Clear floats */
    .clearfix:after {
        content: "";
        clear: both;
        display: table;
        width: 100%;
    }

    .clearfix a {
        font-size: 13px;
        text-decoration: none;
        color: black;
    }

    .clearfix a:hover {
        color: red;
    }


    .forgetpsw {
        width: 100%;
    }

    .container p {
        text-align: center;
    }
    </style>
</head>

<body>
    <div id="id01" class="modal">
        <form class="modal-content" action="checkemail.php" method="post">
            <div class="container">
                <div class="logo"><img src="img/logo.jpg" alt="" width="100%"></div>
                <p>
                    <?php if (isset($_GET['message'])): ?>
                    <?= $_GET['message']?>
                    <?php else: ?>
                    Please enter your email for recovery your password!
                    <?php endif ?>
                </p>
                <hr>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Please enter your email" name="email" >
                <div class="clearfix">
                    <button type="submit" name="btn_submit" class="forgetpsw">Recovery password</button>
                    
                    <a href="signin.php"><b>Have account?</b></a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>