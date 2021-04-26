let $myTaskTable = $('#myTasks')
let $ok = $('#ok')
let $reset = $('#reset')

$(document).ready(function () {
    $myTaskTable.bootstrapTable({
        columns: [
            {
                field: 'id',
                title: 'Item ID'
            },
            {
                field: 'name',
                title: "Тема",
            },
        ],
    });

    $ok.click(function () {
        $myTaskTable.bootstrapTable('refresh', {
            query: {'TasksSearch':queryParams()}
        });
    });

    $reset.click(function () {
        $myTaskTable.bootstrapTable('refresh', {
            query: {'TasksSearch':queryParamsReset()}
        });
    });

    $('#toolbar').find('input[type="checkbox"]').click(function () {

        $myTaskTable.bootstrapTable('refresh', {
            query: {'TasksSearch':queryParams()},
            rowStyle: function (row, index) {
                var customClass = "";

                if (row.Efficiency == 0 || row.Efficiency == null) {
                    // do nothing
                }
                else if (row.Efficiency < 100) {
                    customClass= 'success';
                }
                else if (row.Efficiency > 100) {
                    customClass= 'danger';
                }

                return {
                    classes: customClass
                };
            }
        });
    });
    $(document).on("click", '.task-clickable-tr', function(){
        var myLink = $(this).attr('href');
        window.location.href = myLink;
    });
})

function queryParams() {
    var params = {}
    $('#toolbar').find('input[name]').each(function () {
        params[$(this).attr('name')] = $(this).val()
    })

    params['status'] = [];
    $('#toolbar').find('input[type="checkbox"]').each(function () {
        if($(this).is(":checked")){
            params['status'].push($(this).data("status"));
        }
    })

    return params
}

function queryParamsReset() {
    $('#toolbar').find('input[name]').each(function() {
        $(this)[0].value = '';
    });

    var params = {};
    params['status'] = [];
    $('#toolbar').find('input[type="checkbox"]').each(function() {
        if($(this).is(":checked")) {
            params['status'].push($(this).data("status"));
        }
    });

    return params;
}

function responseHandler(res) {
    return res.rows
}

function LinkFormatter(value, row, index) {
    return row.name;
}

function winDateFormatter(value, row, index) {
    console.log("date = " + value)
    if(value != null){
        var date = new Date(value);
        var mm = date.getMonth() + 1;
        var dd = date.getDate();
        var yy = new String(date.getFullYear());
        if (mm < 10) {
            mm = "0"+mm;
        }
        if (dd < 10) {
            dd = "0"+dd;
        }

        //28.01.2019
        return dd + "-" + mm + "-" + yy;
    }
}

function winDateTimeFormatter(value, row, index) {
    console.log("date-time = " + value)
    if(value != null){
        var date = new Date(value);
        var mm = date.getMonth() + 1;
        var dd = date.getDate();
        var yy = new String(date.getFullYear());
        if (mm < 10) {
            mm = "0"+mm;
        }
        if (dd < 10) {
            dd = "0"+dd;
        }

        var hh = date.getHours();
        if (hh < 10) {
            hh = "0"+hh;
        }
        var MM = date.getMinutes();
        if (MM < 10) {
            MM = "0"+MM;
        }
        //28.01.2019
        return dd + "-" + mm + "-" + " " + yy + " " + hh +":" + MM;
    }
}

function statusFormatter(value, row, index) {
    if(value != null){

        switch (value){
            case 1: return "Новая";
            case 2: return "В процессе";
            case 3: return "Завершена";
            case 4: return "Делегирована"
        }

    }
}

function runningFormatter(value, row, index) {
    return index + 1;
}

function operateFormatter(value, row, index) {
    return '<a href="javascript:void(0)" title="Remove"></a>'
}

$(window.operateEvents = {
    'click .remove': function (e, value, row, index) {
        alert('You clicked remove action, row: ' + JSON.stringify(row))
    }
});

function editClick(id){
    $.get(
        ['setting/space-room/update?id=' + id],
        {
            id: $(this).closest('tr').data('key')
        },
        function (data) {
            $('.modal-body').html(data);
            $('#activity-modal').modal();
        }
    );
}


