<?php

if (isset($_POST["btn_submit"])) {
    // kết nối đến db
    require_once "db.php";
    
    // $get_expire  = "SELECT expire_token FROM users WHERE email = $email ";
    // $token_expire = run($get_expire, true);
    // $get_token  = "SELECT forgot_password_token FROM users WHERE email = $email ";
    // $token_indb = run($get_token, true);
    // $get_time = date("U");
    // if ($get_time>$token_expire ) {
    //     header("location:reset_pwd.php?message= Mã xác nhận đã hết hạn, vui lòng gửi lại yêu cầu đổi mật khẩu!");
    //     exit();
    // } 
    // if ($token == $token_indb) {
        
        //lấy thông tin từ form nhập vào
        $password = $_POST["pwd"];
        $repwd    = $_POST["pwd-repeat"];
        $token    = $_POST["token"];
        // $email    = $_POST["email"];
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
        
        
        if (empty($password) || empty($repwd)) {
            header("location:reset_pwd.php?token=" . $token. "&message= Vui lòng điền đầy đủ thông tin");
            exit();
        }
        
        // kiểm tra mật khẩu có hợp lệ không
        if (!preg_match('/^[0-9A-Za-z]{1,12}$/', $password)) {
            header("location:reset_pwd.php?token=" . $token. "&message= Mật khẩu không hợp lệ ( mật khẩu chỉ có thể chứa số, chữ cái )");
            exit();
        }
        // kiểm tra mật xác nhận mật khẩu đúng không
        if ($repwd !== $password) {
            header("location:reset_pwd.php?token=" . $token."&message= Xác nhận mật khẩu không đúng");
            exit();
        }
        // lấy password từ db để so sánh với password mới
        // $get_pwd = "SELECT * FROM users where email = '$email' ";
        
        // $pwd_db = run($get_pwd);
        // if (password_verify($password, $pwd_db['password'])) {
        //     header("location:reset_pwd.php?message= Mật khẩu mới không thể trùng với mật khẩu cũ!");
        //     exit();
        // }
        
        else {
        	$forgotPwdToken = md5(uniqid("nevertrustme", true));
            $conn  = getConnect();
            $query = "UPDATE users
                set password = :password, forgot_password_token = :new_token
                where forgot_password_token = :forgotpwdtoken";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $hash);
            $stmt->bindParam(':new_token', $forgotPwdToken);
            $stmt->bindParam(':forgotpwdtoken', $token);
            // $stmt->bindParam(':expire_token', $get_time);
            $stmt->execute();
            $affect = $stmt->rowCount();
            
            if ($affect) {
                // tell the user
                    header("location:reset_pwd.php?token=" . $token."&email=".$email. "&message= Đổi mật khẩu thành công!");
                    die();
                } else {
                    header("location:reset_pwd.php?token=" . $token."&email=".$email. "&message= Mã xác nhận đã hết hạn, vui lòng gửi lại yêu cầu mới!");
                    die();
                }
            } 
        // }
        // else {
        // 	header("location:reset_pwd.php?message= Mã xác nhận sai, vui lòng  click lại mã xác nhận tại email!")
        // }
        
        
        
    }
    
    else {
        header("location:reset_pwd.php?message= Thông tin bạn nhập chưa được gửi đi, vui lòng thử lại!");
        exit();
    }
    
?>