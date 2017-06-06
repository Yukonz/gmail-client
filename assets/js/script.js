$(document).ready(function () {

    $('.folder').on('click',function () {
        var folder = $(this).attr('href');
        var url = document.location.origin + '/inbox/view_folder';

        $.ajax({
            url: url,
            method: 'post',
            data: {'folder': folder},
            datatype: 'html',
            success: function(data) {
                $('#display').html(data)
            }
        });

        return false;
    });

    $('#display').on('click','.mailHeader',function () {
        var mailHref = $(this).attr('href');
        var mailHrefArr = mailHref.split('/');
        var mailFolder = mailHrefArr[0];
        var mailNumber = mailHrefArr[1];
        var url = document.location.origin + '/inbox/view_mail';

        $.ajax({
            url: url,
            method: 'post',
            data: {'folder': mailFolder, 'number': mailNumber},
            datatype: 'html',
            success: function(data) {
                $('#display').html(data)
            }
        });

        return false;
    });

    $('#new_mail').on('click',function () {
        var url = document.location.origin + '/inbox/new_mail';

        $.ajax({
            url: url,
            method: 'post',
            datatype: 'html',
            success: function(data) {
                $('#display').html(data)
            }
        });

        return false;
    });

    $('#display').on('click','#sendmail',function () {
        var url = document.location.origin + '/inbox/send_mail';

        var mail = $("#mailaddress").val();
        var subject = $("#mailheader").val();
        var message = $("#mailbody").val();

        var folder = 'Отправленные';

        $.ajax({
            url: url,
            method: 'post',
            data: {'email': mail, 'title': subject, 'message': message},
            datatype: 'html',
            success: $.ajax({
                url: document.location.origin + '/inbox/view_folder',
                data: {'folder': folder},
                method: 'post',
                datatype: 'html',
                success: function(data) {
                    $('#display').html(data)
                }
                 })
        });

        return false;
    });

    $('#display').on('click','.mailHeader',function () {
        var mailHref = $(this).attr('href');
        var mailHrefArr = mailHref.split('/');
        var mailFolder = mailHrefArr[0];
        var mailNumber = mailHrefArr[1];
        var url = document.location.origin + '/inbox/view_mail';

        $.ajax({
            url: url,
            method: 'post',
            data: {'folder': mailFolder, 'number': mailNumber},
            datatype: 'html',
            success: function(data) {
                $('#display').html(data)
            }
        });

        return false;
    });


});




