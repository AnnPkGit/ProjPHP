<div class="wrapper">
    <main>
        <?php if( isset( $view_data['reg_error'] ) ) : ?>
            <div class="reg-error"><?= $view_data['reg_error'] ?></div>
        <?php endif ?>

        <?php if( isset( $view_data['reg_ok'] ) ) : ?>
            <div class="reg-error"><?= $view_data['reg_ok'] ?></div>
        <?php endif ?>

        <div class="reg-form-container">
            <div class="reg-form">
                <div class="reg-form-title">Create Account</div>
                <form class="registerForm" method="post">
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="login">Login</label>
                            <input name="login" value='<?= (isset($view_data['login'])) ? $view_data['login'] : "" ?>'  />
                            <p class="error"><?php echo isset( $view_data['reg_error']['login'] )  ? $view_data['reg_error']['login'] : "" ; ?></p>
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userName">Username</label>
                            <input name="userName" value='<?= (isset($view_data['userName'])) ? $view_data['userName'] : "" ?>' />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userPassword1">Password</label>
                            <input type="password" name="userPassword1" required />
                            <p class="error"><?php echo isset( $view_data['reg_error']['first_password'] )  ? $view_data['reg_error']['first_password'] : "" ; ?></p>
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="confirm">Confirm Password</label>
                            <input type="password" name="confirm" />
                            <p class="error"><?php echo isset( $view_data['reg_error']['password'] )  ? $view_data['reg_error']['password'] : "" ; ?></p>
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="email">Email</label>
                            <input type="email" name="email" required value='<?= (isset($view_data['email'])) ? $view_data['email'] : "" ?>' />
                            <p class="error"><?php echo isset( $view_data['reg_error']['email'] )  ? $view_data['reg_error']['email'] : "" ; ?></p>
                        </div>
                    </div>
                    <button class="reg-button">Registration</button>
                </form>
            </div>
        </div>
    </main>
</div>