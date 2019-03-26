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
        dataType: 'json',
        success: function (data){
            var x= JSON.parse(data);
            months=x.months;
            currentMonthIndex=x.currentMonthIndex;
            $("#tables-content").html(x.html);
            //$("#tst").html("<")
        }
    }
);
}
function getPrevMonth()
{
    $.ajax({
        method: 'POST',
<<<<<<< HEAD
        url: '/month/'+(currentMonthIndex-1),
        data: {uname: $("#logout").text().trim()},
        dataType: 'json',
        success: function (data){
            var x= JSON.parse(data);
            months=x.months;
            currentMonthIndex=x.currentMonthIndex;
            $("#tables-content").html(x.html);
=======
        url: '/month/'+(currentMonthIndex+1),
        data: {uname: $("#logout").text().trim()},
        dataType: 'html',
        success: function (data){
            $("#tables-content").html(data);
>>>>>>> 38a896a727f526b099a2d27088c5f71d156d950a
        }
    }
);
}
