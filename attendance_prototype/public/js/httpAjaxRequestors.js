function registerHandlers()
{
    $('#nxtMonth').click(getNextMonth());
    console.log("registered");
}

<<<<<<< HEAD
function getNextMonth()//let's handle the array overflow on backend
=======
function getNextMonth()
>>>>>>> 92075f17db7de6550bb105827bd3f0a1c6714ac0
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
<<<<<<< HEAD
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
=======
    console.log("triggered");
}
function getPrevMonth()
{

>>>>>>> 92075f17db7de6550bb105827bd3f0a1c6714ac0
}
