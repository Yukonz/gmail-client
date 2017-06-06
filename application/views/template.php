<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head >
    <meta http-equiv='content-type' content='text/html charset=utf-8' />
    <link rel='stylesheet' href='<?php echo base_url('assets/css/bootstrap.min.css'); ?>' />
    <link rel='stylesheet' href='<?php echo base_url('assets/css/styles.css'); ?>' />
    <script type='text/javascript' src='<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>'></script>
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
