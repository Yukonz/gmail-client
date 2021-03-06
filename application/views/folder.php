<div id='mails-folder'>
    <h4><?php echo urldecode($folder) ?></h4>

    <?php $formAction = 'inbox/delete/' . $folder; ?>
    <?php echo form_open($formAction) ?>

        <table class='table table-hover table-striped'>
            <tr class='mails-header'>
                <td class='mails-select'><input type='submit' class='btn btn-danger' value='Удалить'></td>
                <td class='mails-number'>№</td>
                <td class='mails-from'>Отправитель</td>
                <td class='mails-subject'>Тема письма</td>
                <td class='mails-date'>Дата получения</td>
            </tr>

            <?php
                $mailsCount = count($mails);
                for ($i = $mailsCount - 1; $i >= 0; $i--)
                {
                    $mailUrl = '/inbox/' . $folder . '/' . $mails[$i]['number'];
                    echo "
                        <tr>
                             <td class='mails-select'><input type='checkbox' name='mail_number[]' value='{$mails[$i]['number']}'</td>
                             <td class='mails-number'>{$mails[$i]['number']}</td>
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
