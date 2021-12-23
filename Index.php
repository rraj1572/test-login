Elijah: You want all users to use the same username/password? – 
Sampson
 Sep 4 '09 at 20:02
1
No, not quite really, but now i saw that Mark posted a quick and dirty solution and i use it now! Thanks everybody for your help, i appreciate your time. – 
Elijah
 Sep 4 '09 at 20:04
2
@Elijah: The solution Mark provided is fine if you only one small list of users. That solution won't scale very well. – 
Sampson
 Sep 4 '09 at 20:05
Show 2 more comments
10 Answers
order by 
votes
Up vote
24
Down vote
Accepted
It's not an ideal solution but here's a quick and dirty example that shows how you could store login info in the PHP code:

<?php
session_start();

$userinfo = array(
                'user1'=>'password1',
                'user2'=>'password2'
                );

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
    }else {
        //Invalid Login
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login</title>
    </head>
    <body>
        <?php if($_SESSION['username']): ?>
            <p>You are logged in as <?=$_SESSION['username']?></p>
            <p><a href="?logout=1">Logout</a></p>
        <?php endif; ?>
        <form name="login" action="" method="post">
            Username:  <input type="text" name="username" value="" /><br />
            Password:  <input type="password" name="password" value="" /><br />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </body>
</html>
