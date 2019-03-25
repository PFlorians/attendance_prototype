function registerHandlers()
{
    $('#nxtMonth').click(getNextMonth());
    console.log("registered");
}

function getNextMonth()//let's handle the array overflow on backend
{
    $.ajax({
        method: 'POST',
        url: '/month/'+(currentMonthIndex+1),
        data: {uname: $("#logout").text().trim()},
        dataType: 'html',
        success: function (data){
            $("#tables-content").html(data);
        }
    }
);
}
function getPrevMonth()
{
    $.ajax({
        method: 'POST',
        url: '/month/'+(currentMonthIndex-1),
        data: {uname: $("#logout").text().trim()},
        dataType: 'html',
        success: function (data){
            $("#tables-content").html(data);
        }
    }
);
}
