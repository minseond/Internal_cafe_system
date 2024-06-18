<?php
session_start();
  $db = mysqli_connect("localhost:3306","root","sieun119!","company_internal_cafe");

  if(!$db)
  {
    echo "DB접속실패";
  }

  function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}

if (isset($_POST['e_id']) && isset($_POST['password'])) {
    $user_id = mysqli_real_escape_string($db, $_POST['e_id']);
    $user_pass1 = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($user_id) || empty($user_pass1)) {
        echo "<script>
        alert('아이디와 비밀번호를 모두 입력해주세요.');
        location.replace('./login.php');
        </script>";
        exit();
    }

    $stmt = $db->prepare("SELECT * FROM EMPLOYEE WHERE e_id = '$user_id'");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hash = $row['password']; 

        if ($hash == $user_pass1) {
            $_SESSION['e_id'] = $row['e_id'];

            header("location: index.php");
            exit();
        } else {
            echo "<script>
            alert('로그인에 실패하였습니다.');
            location.replace('./login.php');
            </script>";
        }
    } else {
        echo "<script>
        alert('해당 아이디를 찾을 수 없습니다.');
        location.replace('./login.php');
        </script>";
    }

    $stmt->close();
} else {
    echo "<script>
    alert('알 수 없는 오류가 발생하였습니다.');
    location.replace('./index.php');
    </script>";
}
?>