
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>FUO Hostel Portal</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="student.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
                        <?php
                                session_start();
                                include ('db_config.php');
                                if (isset($_SESSION['message'])) {
                                    echo '<div class="container-close" id="logclose" style="background-color: red;">';
                                    echo '<p class="error" style="color: #fff;">' . htmlspecialchars($_SESSION['message']) . '</p>';
                                    echo "</div>";
                                    unset($_SESSION['message']);
                                }
                                ?>
    <!-- information div -->
    <div class="master-div">
        <div class="first-div">
            <div class="Logo"><a href="index.php"><img src="img/fuo logo.png" alt="Fountain University Logo"></a></div>
            <div class="first-div-sub">
                <h1>FUO Hostel Portal</h1>
            </div>
            <div class="first-div-sub-button">
                <button onclick="window.location.href = 'https://www.fuo.edu.ng'">FUO Website</button>
                <button onclick="window.location.href = 'https://portal.fuo.edu.ng/returning-student'">Student's
                    Portal</button>
            </div>

        </div>
        <div class="line-div"></div>
        <div class="log-div">
            <div class="log-div-sub">
                <div class="log-div-sub-master">
                    <div class="log-type">
                        <div class="log-type-student login-type" id="studentlog">
                            <div class="login-typee">
                                <i class="bi bi-person-fill" id="fill1"></i>
                                <p>Students</p>
                            </div>
                        </div>
                        <div class="log-type-manager login-type" id="managerlog">
                            <div class="login-typee">
                                <i class="bi bi-person-workspace" id="fill2"></i>
                                <p>Managers</p>
                            </div>
                        </div>
                        <div class="log-type-works login-type" id="workslog">
                            <div class="login-typee">
                                <i class="bi bi-house-gear-fill" id="fill3"></i>
                                <p>Works Unit</p>
                            </div>
                        </div>

                    </div>
                    <div class="login-div">
                        <div class="login-div-master">

                            <!-- students login  -->
                            <div class="login-div-master-sub one" id="studentlogin">
                                <img src="img/login.png" alt="login logo">
                                <h2>Login</h2>
                                <form action="login-check.php" method="POST">
                                    <input type="text" name="username" required placeholder="Matric No/Application No."><br>
                                    <input type="password" name="password" required placeholder="Password"><br>
                                    <button type="submit" name="submit">Enter <i class="bi bi-box-arrow-in-right"></i></button>
                                </form>
                            </div>

                            <!-- Managers login -->
                            <div class="login-div-master-sub two" id="managerslogin">
                                <img src="img/login1.png" alt="login logo">
                                <h2>Login</h2>
                                <form action="login-check-manager.php" method="POST">
                                    <input type="text" name="staffid" required placeholder="Staff Id."><br>
                                    <input type="password"  name="passd" required placeholder="Password"><br>
                                    <button type="submit">Enter <i class="bi bi-box-arrow-in-right"></i></button>
                                </form>
                            </div>

                             <!-- Works login -->
                             <div class="login-div-master-sub three" id="workslogin">
                                <img src="img/login2.png" alt="login logo">
                                <h2>Login</h2>
                                <form action="login-check-works.php" method="POST">
                                <input type="text" name="staffid" required placeholder="Staff Id."><br>
                                    <input type="password"  name="passd" required placeholder="Password"><br>
                                    <button type="submit">Enter <i class="bi bi-box-arrow-in-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="main.js"></script>

</body>

</html>