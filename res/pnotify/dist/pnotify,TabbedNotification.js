var cnt = 10;

TabbedNotification = function (options) {
    var message = "<div id='ntf" + cnt + "' idnotify='"+options.id+"' type='"+((options.receiver !== '*') ? 'Notificacion' : 'Difusion')+"' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title +
            "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

    if (!document.getElementById('custom_notifications')) {
        alert('doesnt exists');
    } else {
        $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
        $('#custom_notifications #notif-group').append(message);
        cnt++;
        CustomTabs(options);
    }
};

CustomTabs = function (options) {
    $('.tabbed_notifications > div').hide();
    $('.tabbed_notifications > div:first-of-type').show();
    $('#custom_notifications').removeClass('dsp_none');
    $('.notifications a').click(function (e) {
        e.preventDefault();
        var $this = $(this),
                tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
                others = $this.closest('li').siblings().children('a'),
                target = $this.attr('href');
        others.removeClass('active');
        $this.addClass('active');
        $(tabbed_notifications).children('div').hide();
        $(target).show();
    });
};

CustomTabs();

var tabid = idname = '';

$(document).on('click', '.notification_close', function (e) {
    idname = $(this).parent().parent().attr("id");
    tabid = idname.substr(-2);
    idnotify = $('#ntf' + tabid).attr('idnotify');
    type = $('#ntf' + tabid).attr('type');
    if(type !== 'Difusion'){
       readNotify(idnotify);
    }
    $('#ntf' + tabid).remove();
    $('#ntlink' + tabid).parent().remove();
    $('.notifications a').first().addClass('active');
    $('#notif-group div').first().css('display', 'block');
    lengthLI = $('.quickNoty li:not(.statusNoty,.hide)').length;
    if(lengthLI == 1){
        $('.quickNoty .statusNoty').removeClass("bg-red").addClass("bg-green")
                .html('<div >\n\
                            <strong>No hay alertas!</strong>\n\
                            <i class="fa fa-exclamation"></i>\n\
                        </div>');
    }
    $('.quickNoty li.hide:first').removeClass("hide");
    $('#notiCounter').text(parseInt($('#notiCounter').text())-1);
});

$('ul.quickNoty').on("click", "li.deatilNty", function (event) {
    event.preventDefault();
    var id = $(this).attr("idnotify");
    $('#idNotyModal').text(id);
    var resp = consultarDatosNotificacion(id);
    $('#nty-title').html(resp.title + " - <b>Notificacón #" + resp.id + "</b>");
    $('#nty-sender').text(resp.nomsender);
    $('#nty-type').html('<img width="30" height="30" class="' + ((resp.receiver != '*') ? 'bg-' + resp.type : '') + '" src="/misc/images/' + ((resp.receiver != '*') ? 'notification' : 'difusion-2') + '.png" alt="' + ((resp.receiver != '*') ? 'Notificación' : 'Difusión') + '" />');
    $('#nty-id').text(resp.id);
    $('#nty-fecha').text(resp.fecha);
    $('#nty-hora').text(resp.hora2);
    $('#nty-message').html(resp.message);
    $('#modalNoty').modal("show");
    $('#notiCounter').text(parseInt($('#notiCounter').text())-1);
    readNotify(id);
});

function readNotify(idnotify){
    $.ajax({
           url : '/Notify/readNotificacion',
           type : 'post',
           dataType : 'json',
           data : {"id" : idnotify},
           success : function(resp){
                            $('ul.quickNoty li[idnotify='+idnotify+']').remove();
                     }
           });
}