

    <div class="login_main">

        <div class="col-sm-6">
            <div class="login">
                <?php echo $this->Form->create('Customer'); ?>
                    <div class="login_in">
                        <h1>Sign in</h1>
                        <div class="login_left_in">
                            <ul>

                                <li class="login_input"><input type="text" placeholder="Mobile Number/Email" name="data[Customer][username]"></li>

                                <li class="login_input"><input type="text" placeholder="Password"  name="data[Customer][password]"></li>

                                <li class="login_input"><input type="checkbox"><p>Remember me</p><a>Forgot password</a></li>
                            </ul>
                        </div>
                        <div class="login_submit center-block">
                            <button type="submit"><img src="/img/submit.png"></button>
                            <a href="#" onclick="fb_login();"><img src="/img/login.png"></a>
                            <div id="fb-root"></div>
                        </div>
                    </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>

        <div class="col-sm-6">

            <div class="login">
                <div class="login_in">
                    <h1>Sign up</h1>
                    <div class="login_left_in">
                        <ul>

                            <li class="login_input"><input type="text" placeholder="User name"></li>

                            <li class="login_input"><input type="text" placeholder="Email"></li>

                            <li class="login_input"><input type="text" placeholder="Password"></li>

                            <li class="login_input"><input type="text" placeholder="Re-Password"></li>

                        </ul>
                    </div>
                    <div class="login_submit center-block">
                        <button><img src="/img/submit.png"></button>
                    </div>
                </div>
            </div>

        </div>

    </div>






