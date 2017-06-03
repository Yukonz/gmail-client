<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
    <head >
        <meta http-equiv='content-type' content='text/html charset=utf-8' />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/styles.css"); ?>" />
        <title> Welcome! </title>
    </head>
    <body>
        <div id='login-wrapper'>
            <div id='login-form'>
                <h4>Введите данные вашей учетной записи Gmail</h4>
                <hr>

                <?php echo validation_errors(); ?>
                <?php echo form_open('login/process') ?>

                <?php if(! is_null($msg)) echo "{$msg}<p>";?>

                    <div class='form-group'>
                        <label for='username'>Логин</label>
                        <input type='text' class='form-control' name='name' placeholder='имя'>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Пароль</label>
                        <input type='password' class='form-control' name='password' placeholder='пароль'>
                    </div>
                    <input type='submit' value='Вход' class='btn btn-success' placeholder='Отправить' name='login_button'>
                </form>
            </div>
        </div>
    </body>
</html>
