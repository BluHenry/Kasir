<?php
session_start();
include 'koneksi.php';

// if (isset($_POST['Login']))
if (isset($_POST['login'])) {
    $user =  htmlspecialchars($_POST['UserName']);
    $pass = $_POST['PassWord'];

    $sql = "SELECT * FROM users WHERE Username=? AND Password=?" ;
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $data = $stmt->get_result();
    $user = $data->fetch_assoc();

        if ($user) {
        $_SESSION['Username'] = $user['Username'];
        $_SESSION['Role'] = $user['Role'];

        if ($user['Role'] === 'admin') {
            header("Location:admin.php");
        } else {
            header("Location:petugas.php");
        }
    } else {
        echo "Login gagal!";
    }


}

if (isset($_POST['register'])) {
    $User = htmlspecialchars($_POST['UserRegister']);
    $password = $_POST['PassRegister'];

    $sql = "INSERT INTO users (Username, Password, Role) VALUES (?, ?, 'admin')";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $User, $password);
    $stmt->execute();

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "regitser gagals";
    }

}

?>



<!DOCTYPE html>
<html>
    <head>
<title>index</title>
    </head>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #58bcff, #85c1e9);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container */
.container {
    background: white;
    padding: 25px;
    border-radius: 12px;
    width: 320px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Title */
p {
    text-align: center;
    font-weight: bold;
    font-size: 18px;
}

/* Input */
input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
}

/* BUTTON LOGIN (biru tua) */
.Login button {
    width: 100%;
    padding: 10px;
    background: #2980b9;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
}

.Login button:hover {
    background: #1f618d;
}

/* BUTTON REGISTER (biru muda) */
.register button {
    width: 100%;
    padding: 10px;
    background: #5dade2;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
}

.register button:hover {
    background: #3498db;
}

/* Toggle */
.toggle {
    text-align: center;
    margin-top: 12px;
    cursor: pointer;
    color: #2980b9;
    font-size: 14px;
}

.toggle:hover {
    text-decoration: underline;
}

/* Hidden */
.hidden {
    display: none;
}

.Register {
    display: none;
}
</style>  
<body>
    <div class="container">
<!-- Login -->
 <div class="Login" id="LoginForm">
    <form method="POST" action="">
        <p> Login form </p>
        <input type="text" class="NameLogin" placeholder="Username" name="UserName">
        <input type="password" class="Pass" placeholder="Password" name="PassWord">
        <button type="submit" name="login">Login</button>
        <div class="toggle" onclick="ShowRegister()">Belum punya akun? Register</div>
    </form>
</div>

<!-- Register -->
 <div class="Register" id="RegisterForm">
    <form method="POST" action="">
        <p> Register form </p>
        <input type="text" class="NameRegister" placeholder="Username" name="UserRegister">
        <input type="password" class="PassRegister" placeholder="Password" name="PassRegister" required>
        <button type="submit" name="register" class="register">Register</button>
        <div class="toggle" onclick="ShowLoginForm()"> udah punya akun? </div>
    </form>
 </div>

    </div>

    <script> 
    function ShowRegister() {
        document.getElementById("LoginForm").classList.add("hidden");
        document.getElementById("RegisterForm").classList.remove("Register");
    }

    function ShowLoginForm() {
        document.getElementById("RegisterForm").classList.add("Register");
        document.getElementById("LoginForm").classList.remove("hidden");
    }
        

    </script>
</body>
</html>