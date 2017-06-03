<!DOCTYPE html>
<html xmlns=”http://www.w3.org/1999/xhtml” xml:lang=”en” lang=”en”>
<head >
    <meta http-equiv="content-type" content="text/html charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title> <?php echo $title; ?> </title>
</head>
<body style="background-color: white !important">
<div id="wrapper" style="display: flex; justify-content: space-around; height: 100%">
<div id="folders" style="display: inline-block; width: 150px; min-width: 150px; min-height: 100%; margin-top: 45px; margin-left: 15px">
    <a href="/newmail/"><button type="button" class="btn btn-success">НАПИСАТЬ</button></a>
    <table class="table table-hover table-bordered" style="margin-top: 15px">

        <?php foreach ($folders as $folder): ?>
            <tr><td><a href="/inbox/<?php echo $folder; ?>"><?php echo $folder; ?></a></td></tr>
        <?php endforeach; ?>

    </table>
    <a href="/login/change_user"><button type="button" class="btn btn-primary">Выход</button></a>
</div>