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
            record_ids=x.ids;
            $("#tables-content").html(x.html);
            //$("#tst").html("<")
        }
    }
);}

function getPrevMonth()
{
    $.ajax({
        method: 'POST',
        url: '/month/'+(currentMonthIndex-1),
        data: {uname: $("#logout").text().trim()},
        dataType: 'json',
        success: function (data){
            var x= JSON.parse(data);
            months=x.months;
            currentMonthIndex=x.currentMonthIndex;
            record_ids=x.ids;
            $("#tables-content").html(x.html);
        }
    }
);
}
//this invokes saving of data
function saveEditedData()
{
    $.ajax({
        method: 'GET',
        url: '/alteration',
        data: {}
    });
}
//invoke editation cancellation
function cancelEditation()
{

}
