<?php
$token = $_GET['token'];
$email = $_GET['email'];
if (isset($_POST["btn_submit"])) {
    // kết nối đến db
    require_once "db.php";
    
    $get_expire  = "SELECT expire_token FROM users WHERE email = $email ";
    $token_expire = run($get_expire, true);
    $get_token  = "SELECT forgot_password_token FROM users WHERE email = $email ";
    $token_indb = run($get_token, true);
    $get_time = date("U");
    if ($get_time>$token_expire ) {
        header("location:reset_pwd.php?message= Mã xác nhận đã hết hạn, vui lòng gửi lại yêu cầu đổi mật khẩu!");
        exit();
    } 
    if ($token == $token_indb) {
        
        //lấy thông tin từ form nhập vào
        $password = $_POST["pwd"];
        $repwd    = $_POST["pwd-repeat"];
        $token    = $_POST["token"];
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
        
        
        if (empty($password) || empty($repwd)) {
            header("location:reset_pwd.php?message= Vui lòng điền đầy đủ thông tin");
            exit();
        }
        
        // kiểm tra mật khẩu có hợp lệ không
        if (!preg_match('/^[0-9A-Za-z]{1,12}$/', $password)) {
            header("location:reset_pwd.php?message= Mật khẩu không hợp lệ ( mật khẩu chỉ có thể chứa số, chữ cái )");
            exit();
        }
        // kiểm tra mật xác nhận mật khẩu đúng không
        if ($repwd !== $password) {
            header("location:reset_pwd.php?message= Xác nhận mật khẩu không đúng");
            exit();
        }
        // lấy password từ db để so sánh với password mới
        $get_pwd = "SELECT password FROM users where forgot_password_token = '$token' ";
        
        $pwd_db = run($get_pwd);
        if (password_verify($password, $pwd_db)) {
            header("location:reset_pwd.php?message= Mật khẩu mới không thể trùng với mật khẩu cũ!");
            exit();
        }
        
        else {
            $conn  = getConnect();
            $query = "UPDATE users
                set password = :password, expire_token = :expire_token
                where forgot_password_token = :forgotpwdtoken";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $hash);
            $stmt->bindParam(':forgotpwdtoken', $token);
            $stmt->bindParam(':expire_token', $get_time);
            $stmt->execute();
            $affect = $stmt->rowCount();
            
            if ($affect) {
                // tell the user
                    header("location:reset_pwd.php?message= Đổi mật khẩu thành công!");
                    die();
                } else {
                    header("location:reset_pwd.php?message= Đổi mật khẩu không thành công, vui lòng thử lại!");
                    die();
                }
            } 
        }
        
        
        
    }
    
    else {
        header("location:reset_pwd.php?message= Mã xác nhận sai, vui lòng  click lại mã xác nhận tại email!");
        exit();
    }
    
?>