function getNextMonth()//let's handle the array overflow on backend
{
    if($("#save-item") || $("#cancel-item"))
    {
        $("#save-item").remove();
        $("#cancel-item").remove();
        $("#editation-item").removeClass("d-none");
        ChangeBuffer = new Object();
    }
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
    if($("#save-item") || $("#cancel-item"))
    {
        $("#save-item").remove();
        $("#cancel-item").remove();
        $("#editation-item").removeClass("d-none");
        ChangeBuffer = new Object();
    }
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
        method: 'POST',
        url: '/saveChanges',
        data: {uname: $("#logout").text().trim(), data: ChangeBuffer},
        dataType: 'json',
        success: function(){
            location.reload();
        }
    });
}
