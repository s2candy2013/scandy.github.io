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
	require_once "db.php";
	// kết nối đến db

  			//lấy thông tin từ các form bằng phương thức POST
  			$username = $_POST["username"];
  			$password = $_POST["pwd"];
  			$repwd = $_POST["pwd-repeat"];
  			$email = $_POST["email"];
  			$hash = password_hash($password, PASSWORD_BCRYPT);
  			//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống

			if (empty($username) || empty($password) || empty($email) || empty($repwd)) {
			header("location:signup.php?message= Vui lòng điền đầy đủ thông tin");
			exit();
		    }
				// kiểm tra ký tự hợp lệ
			if(!preg_match('/^[a-zA-Z0-9\s]+$/', $username)) {
				    header("location:signup.php?message= Tên không hợp lệ (Tên chỉ có thể chứa chữ cái, số và khoảng trắng)");
				    exit();
				}
				// kiểm tra email đúng chuẩn chưa
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header("location:signup.php?message= Email không hợp lệ");
					exit();
				}

				// kiểm tra mật khẩu có hợp lệ không
			if (!preg_match('/^[0-9A-Za-z]{1,12}$/', $password)) {
					header("location:signup.php?message= Mật khẩu không hợp lệ ( mật khẩu chỉ có thể chứa số, chữ cái )");
					exit();
				}
				// kiểm tra mật xác nhận mật khẩu đúng không
			if ($repwd !== $password) {
					header("location:signup.php?message= Xác nhận mật khẩu không đúng");
					exit();
				}
			// kiểm tra email tồn tại chưa
			$conn = getConnect();
			$check_email = $conn->prepare("SELECT email FROM users WHERE email = ? AND verified = 1");
			$check_email->execute([$email]);

			if ($check_email->rowCount()>0) {
					header("location:signup.php?message= Email đã tồn tại");
					exit();
				}

			// kiểm tra nếu email đã có trong hệ thống nhưng chưa được verified
			$conn = getConnect();
			$check_verified = $conn->prepare("SELECT email FROM users WHERE email = ? AND verified = 0");
			$check_verified->execute([$email]);
			if ($check_verified->rowCount()>0) {
						header("location:signup.php?message= Email đã tồn tại trong hệ thống nhưng chưa được xác nhận email!");
						exit();
			}
			else {
				try {
            				// tạo email xác nhân, được gửi khi không gặp lỗi nào ở trên
                // tạo mã verify
                $verificationCode = md5(uniqid("nevertrustme", true));

                // gửi email xác nhận
                $verificationLink = "http://afirebay.ml/dangnhap/verify_account.php?code=" . $verificationCode; //đổi link ở máy m
 				// tạo nội dung cho email
                $htmlStr = "";
                $htmlStr .= "Hi " . $email . ",<br /><br />";


                $htmlStr .= "Please click the button below to verify your account.<br /><br /><br />";
                $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff; text-decoration:none;'>VERIFY EMAIL</a><br /><br /><br />";

                $htmlStr .= "Thanks you,<br />";
                $htmlStr .= "<a href='http://afirebay.ml/index.php' target='_blank'>Sofa Team</a><br />";

     				// set mail to use STMP
     				$mail->SMTPDebug = 2;
     				$mail->isSMTP();
     				$mail->Host = 'smtp.gmail.com';
     				$mail->SMTPAuth = true;
     				$mail->Username = 'sofateampoly@gmail.com';
     				$mail->Password = 'admin123@';
     				$mail->SMTPSecure = 'tls';
     				$mail->Port = 587;

     				// người nhận
     				$mail->CharSet = 'UTF-8';
     				$mail->setFrom('sofateampoly@gmail.com','Hưng from SofaTeam');
     				$mail->addAddress("$email");
     				$mail->addReplyTo('sofateampoly@gmail.com');

     				//content
     				$mail->isHTML(true);
     				$mail->Subject = 'Verification Link | Sofa Team | FPT Polytechnic';
     				$mail->Body = $htmlStr;




                	if ($mail->send()) {

                	// lưu dữ liệu
					$conn = getConnect();
					$stmt = $conn->prepare('INSERT INTO users (email, name, password, role, verification_code, verified) values (:email, :username, :password, :role, :verificationcode, :verified)');

                	$stmt->bindParam(':email', $email);
					$stmt->bindParam(':username', $username);
					$stmt->bindParam(':password', $hash);
					$stmt->bindParam(':role', $role);
					$stmt->bindParam(':verified', $verified);
					$stmt->bindParam(':verificationcode', $verificationCode);
					$verified = 0;
					$role = 3;
   					$stmt->execute();
   					$affect = $stmt->rowCount();
   					if ($affect) {
   						header("location:signup.php?message= Đăng ký thành công, mời bạn xác nhận email!");
   					}
   					else {
   						header("location:signup.php?message= Xảy ra lỗi không đăng ký thành công!");
   					}
                	}
                	else {
                		exit("Sending failed!");
                	}
				    }
				catch(Exception $e){
 					 echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}


				}



			}



?>
