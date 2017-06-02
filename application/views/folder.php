<div id="messages" style="display: inline-block; width: 100%; height: 100%; margin-left: 30px; margin-right: 30px">

    <h4><?php echo urldecode($folder) ?></h4>

    <?php $formAction = 'inbox/delete/' . $folder; ?>
    <?php echo form_open($formAction) ?>

        <table class="table table-hover table-striped">
            <tr style="font-size: 18px">
                <td style="width: 100px; text-align: center"><input type="submit" class="btn btn-danger" value="Удалить"></td>
                <td style="width: 50px; text-align: center"">№</td>
                <td style="width: 300px">Отправитель</td>
                <td>Тема письма</td>
                <td style="width: 300px" >Дата получения</td>
            </tr>

            <?php
                $mailsCount = count($mails);
                for ($i = $mailsCount - 1; $i >= 0; $i--)
                {
                    $mailUrl = '/inbox/' . $folder . '/' . $mails[$i]['number'];
                    echo "
                        <tr>
                             <td style=\"text-align: center\"><input type='checkbox' name='mail_number[]' value='{$mails[$i]['number']}'</td>
                             <td style=\"text-align: center\">{$mails[$i]['number']}</td>
                             <td><b>{$mails[$i]['from']}</b>[{$mails[$i]['fromaddress']}]</td>
                             <td><a href='{$mailUrl}'>{$mails[$i]['header']}</a></td>
                             <td>{$mails[$i]['date']}</td>
                        </tr>
                        ";
                }
            ?>

        </table>
    </form>
</div>
