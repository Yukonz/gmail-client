<div id="messages" style="display: inline-block; width: 80%; height: 100%">
    <?php $formAction = 'inbox/delete/' . $folder; ?>
    <?php echo form_open($formAction) ?>

        <table class="table table-hover">
            <tr align="center">
                <td><input type="submit" class="btn btn-danger" value="Удалить"></td>
                <td>№</td>
                <td>Отправитель</td>
                <td>Тема письма</td>
                <td>Дата получения</td>
            </tr>

            <?php
            $mailsCount = count($mails) -1;
            for ($i = $mailsCount; $i >= 0; $i--){
                $mailUrl = '/inbox/' . $folder . '/' . $mails[$i]['number'];
                echo "
                    <tr>
                    <td align='center'><input type='checkbox' name='mail_number[]' value='{$mails[$i]['number']}'</td>
                    <td align='center'>{$mails[$i]['number']}</td>
                    <td>{$mails[$i]['from']}</td>
                    <td><a href='{$mailUrl}'>{$mails[$i]['header']}</a></td>
                    <td>{$mails[$i]['date']}</td>
                    </tr>
                ";
            }
?>

        </table>
    </form>
</div>

