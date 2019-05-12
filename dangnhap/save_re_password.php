<?php
session_start();

if (isset($_POST["btn_submit"])) {
    if (!isset($_SESSION['save_session'])) {
    header('location:signin.php?loi=Bạn cần đăng nhập trước !');die;
    }
    // kết nối đến db
    require_once "db.php";
    // if (!$user){
    //         header('Location: signin.php'); // Di chuyển đến trang chủ
    //     }
        $user = $_SESSION['save_session'];
        //lấy thông tin từ form nhập vào
        $cur_pwd = $_POST["cur_pwd"];
        $new_pwd    = $_POST["new_pwd"];
        $re_new_pwd = $_POST["re_new_pwd"];
        
        $hash = password_hash($new_pwd, PASSWORD_BCRYPT);
        //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
        
        
        if (empty($cur_pwd) || empty($new_pwd) || empty($re_new_pwd)) {
            header("location:re_password.php?&message= Vui lòng điền đầy đủ thông tin");
            exit();
        }
        // kiểm tra mật khẩu hiện tại có dúng k

        if (!password_verify($cur_pwd, $user['password'])) {
            header("location:re_password.php?&message= Mật khẩu hiện tại không đúng");
            exit();
        }
        // kiểm tra mật khẩu mới không được trùng với mật khẩu hiện tại
        if ($new_pwd == $cur_pwd) {
            header("location:re_password.php?&message= Mật khẩu mới không được trùng với mật khẩu hiện tại");
            exit(); 
        }
        // kiểm tra mật khẩu có hợp lệ không
        if (!preg_match('/^[0-9A-Za-z]{1,12}$/', $new_pwd)) {
            header("location:re_password.php?&message= Mật khẩu không hợp lệ ( mật khẩu chỉ có thể chứa số, chữ cái )");
            exit();
        }
        // kiểm tra mật xác nhận mật khẩu đúng không
        if ($new_pwd !== $re_new_pwd) {
            header("location:re_password.php?&message= Xác nhận mật khẩu không đúng");
            exit();
        }

        
        else {
        	$conn  = getConnect();
            $query = "UPDATE users
                set password = :new_pwd
                where email = :email";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':new_pwd', $hash);
            $stmt->bindParam(':email', $user['email']);
            $stmt->execute();
            $affect = $stmt->rowCount();
            
            if ($affect) {
                // tell the user
                    header("location:re_password.php?&message= Đổi mật khẩu thành công!");
                    die();
                }
                else {
                    header("location:re_password.php?message= Đổi mật khẩu không thành công!");
                    die();
                }
            } 
        
        
        
    }
    
    else {
        header("location:re_password.php?message= Thông tin bạn nhập chưa được gửi đi, vui lòng thử lại!");
        exit();
    }
    
?>