function ajaxGenerico(url_peticion, data, _callback) {
                $.ajax({
                    url: url_peticion,
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    success: _callback
                });
            }			