<?php

include "PHPMailer-master/src/Exception.php";
include "PHPMailer-master/src/OAuth.php";
include "PHPMailer-master/src/PHPMailer.php";
include "PHPMailer-master/src/POP3.php";
include "PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if (isset($_POST["btn_submit"])) {
    // kết nối đến db
    require_once "db.php";
    $email = $_POST["email"];
    
    // kiểm tra ô dữ liệu phải được điền vào không được bỏ trống
    if (empty($email)) {
        header("location:forgetpwd.php?message= Vui lòng điền email!");
        exit();
    }
    // kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:forgetpwd.php?message= Email không hợp lệ!");
        exit();
    }
    // kiểm tra email tồn tại trong db
    $conn        = getConnect();
    $check_email = $conn->prepare("SELECT email FROM users WHERE email = ? AND verified = '1'");
    $check_email->bindParam(1, $email);
    $check_email->execute();
    
    if ($check_email->rowCount() == 0) {
        header("location:forgetpwd.php?message= Email không tồn tại!");
        exit();
    } else {
        // tạo email xác nhân, được gửi khi không gặp lỗi nào ở trên
        // tạo mã verify
        $forgotPwdToken = md5(uniqid("nevertrustme", true));
        
        // gửi email xác nhận
        $forgotPwdLink = "http://afirebay.ml/dangnhap/reset_pwd.php?token=" . $forgotPwdToken;
        // tạo nội dung cho email
        $htmlStr       = "";
        $htmlStr .= "Hi " . $email . ",<br /><br />";
        
        
        $htmlStr .= "Please click the button below to allow to change your password.<br /><br /><br />";
        $htmlStr .= "<a href='{$forgotPwdLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff; text-decoration:none;'>Change password</a><br /><br /><br />";
        
        $htmlStr .= "Thanks you,<br />";
        $htmlStr .= "<a href='http://afirebay.ml/index.php' target='_blank'>Sofa Team</a><br />";
        
        
        // set mail to use STMP 
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sofateampoly@gmail.com';
        $mail->Password   = 'admin123@';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        
        // người nhận
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('sofateampoly@gmail.com', 'Hưng from SofaTeam');
        $mail->addAddress("$email");
        $mail->addReplyTo('sofateampoly@gmail.com');
        
        //content
        $mail->isHTML(true);
        $mail->Subject = 'Change Password | Sofa Team | FPT Polytechnic';
        $mail->Body    = $htmlStr;
        
        if ($mail->send()) {
            
            // lưu dữ liệu
            // $expire_token = date("U") + 1800;
            
            $conn = getConnect();
            $stmt = $conn->prepare("UPDATE users
                        set forgot_password_token = :forgotpwdtoken
                        where email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':forgotpwdtoken', $forgotPwdToken);
            // $stmt->bindParam(':expire_token', $expire_token);
            $stmt->execute();
            $affect = $stmt->rowCount();
            if ($affect) {
                header("location:forgetpwd.php?message= Hệ thống đã gửi link khôi phục, vui lòng check email!");
                die();
            } else {
                header("location:forgetpwd.php?message= Có lỗi xảy ra, vui lòng thử lại!");
                die();
            }
        } else {
            exit("Sending failed!");
        }
    }
    
    
    
}

?>