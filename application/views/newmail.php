<div id='newmail'>
    <h4>Новое сообщение</h4>
    <hr>

    <?php echo validation_errors(); ?>
    <?php echo form_open('inbox/send_mail') ?>

        <div class='form-group'>
            <label for='email'>Email</label>
            <input type='email' id='mailaddress' class='form-control' name='email' placeholder='e-Mail адрес'>
        </div>

        <div class='form-group'>
            <label for='header'>Заголовок письма</label>
            <input type='text' id='mailheader' class='form-control' name='title' placeholder='Заголовок'>
        </div>

        <div class='form-group'>
            <label for='comment'>Сообщение</label>
            <textarea class='form-control' id='mailbody' rows='5' name='message'></textarea>
        </div>

        <input type='submit' id='sendmail' class='btn btn-success' value='Отправить'>
        <a href='/inbox/'><button id='cancelmail' type='button' class='btn btn-warning'>Отмена</button></a>

    </form>
</div>