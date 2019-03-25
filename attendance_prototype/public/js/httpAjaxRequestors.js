function registerHandlers()
{
    $('#nxtMonth').click(getNextMonth());
    console.log("registered");
}

function getNextMonth()
{
    $.ajax({
        method: 'POST',
        url: '/month/'+(currentMonthIndex+1),
        data: {uname: $("#logout").text().trim()},
        dataType: 'html',
        success: function (data){
            console.log("signal detected");
            $("#tables-content").html(data);
        }
    }
);
    console.log("triggered");
}
function getPrevMonth()
{

}
