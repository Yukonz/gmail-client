<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head >
    <meta http-equiv='content-type' content='text/html charset=utf-8' />
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
    <title> <?php echo $title; ?> </title>
</head>
<body>
<div id='wrapper'>
    <div id='login'>
        <?php echo $this->session->userdata('username') ?>
        <a href='/login/change_user'><button type='button' class='btn btn-primary'>Выход</button></a>
    </div>
    <div id='folders'>
        <a href='/newmail/'><button type='button' class='btn btn-success'>НАПИСАТЬ</button></a>
        <table class='table table-hover table-bordered table-folders'>

            <?php foreach ($folders as $folder): ?>
                <tr><td><a href='/inbox/<?php echo $folder; ?>'><?php echo $folder; ?></a></td></tr>
            <?php endforeach; ?>

        </table>
    </div>

    <style>

        body {
            background-color: white !important
        }

        #wrapper {
            display: flex;
            height: 100%
        }

        #login {
            position: absolute;
            display: inline-block;
            right: 30px;
            top: 3px;
            font-size: 16px
        }

        #folders {
            display: inline-block;
            width: 150px;
            min-width: 150px;
            min-height: 100%;
            margin-top: 45px;
            margin-left: 15px
        }

        .table-folders {
            margin-top: 15px
        }

    </style>