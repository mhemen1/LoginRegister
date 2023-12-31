<?php 
require_once 'core/init.php';
if (Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate=new Validate();
        $validation=$validate->check($_POST,array(
            'username'=> array('required'=> true),
            'password'=> array('required'=> true)
        ));
        if($validation->passed()) {
            $user=new User();
            $remember = (Input::get('remember')=== 'on') ? true:false;
            $login = $user->login(Input::get('username'), Input::get('password'),$remember);

            if($login)
            Redirect::to('index.php');
            else echo 'Failed to login.';

        }else 
        foreach($validation->errors() as $error) {
            echo $error, '<br/>';
        }
    }
}

?>

<form action="" method="post">
    <div class="filed">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" />
    </div>

    <div class="filed">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
        
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    
    <label for="remember">
        <input type="checkbox" name="remember" id="remember"> Remember me
    </label>
    <input type="submit" value="Log in"/>

</form>