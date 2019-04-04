
function editationMode()
{
    $("#attendanceTab > tbody > tr > td.column2").attr({contenteditable: "true"});
    $("#attendanceTab > tbody > tr > td.column3").attr({contenteditable: "true"});
    $("#attendanceTab > tbody > tr > td.column3").addClass("cursor-text");
    $("#attendanceTab > tbody > tr > td.column2").addClass("cursor-text");
    $("#attendanceTab > tbody > tr > td.column2").on("keydown", (elem) => {
        var x=elem.target.innerHTML.trim();
        var rgx=new RegExp("^([0-2]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}){1}$");
        if(rgx.test(x))
        {
            $(elem.target).popover("dispose");
            console.log("case 0");
        }
        else
        {
            $(elem.target).popover("dispose").popover({
                content: 'Value ...',
                placement: 'right',
                trigger: 'manual'
            });
            $(elem.target).popover("show");
            console.log("case 1");
        }
    });
    $("#attendanceTab > tbody > tr > td.column2").on("keyup", (elem) => {
        var x=elem.target.innerHTML.trim();
        var rgx=new RegExp("^([0-2]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}){1}$");
        if(rgx.test(x))
        {
            $(elem.target).popover("dispose");
            console.log("case 00");
        }
        else
        {
            $(elem.target).popover("dispose").popover({
                content: 'Value ...',
                placement: 'right',
                trigger: 'manual'
            });
            $(elem.target).popover("show");
            console.log("case 11");
        }
    });
    $("#attendanceTab > tbody > tr > td.column2").off("focus").on("focus", (elem)=>{
        $(elem.target).off("DOMSubtreeModified").on("DOMSubtreeModified", (eleme)=>{
            //console.log(eleme.target.id);
            var row=eleme.target.id.trim().split("_");
            var x=eleme.target.innerHTML.trim();
            var rgx=new RegExp("^([0-2]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}){1}$");
            if(rgx.test(x))
            {
                //$(eleme.target).popover("hide");
                if(typeof ChangeBuffer[row[row.length-1].toString()]==='undefined')//check if already initialized
                {
                    ChangeBuffer[row[row.length-1].toString()]=new ChangeRow({id: parseInt(row[row.length-1]), col2: eleme.target.innerHTML.trim()});
                    console.log("first case");
                }
                else //otherwise no need to instantiate just alter already existing object
                {
                    ChangeBuffer[row[row.length-1].toString()].id=parseInt(row[row.length-1]);
                    ChangeBuffer[row[row.length-1].toString()].column2=eleme.target.innerHTML.trim();
                    console.log("second case");
                }
            }
            else
            {
                //$(eleme.target).popover("toggle");
                //$(eleme.target).popover();//register popover
                //$(eleme.target).attr("data-content", "Value must be a valid time in German format");
                //$(eleme.target).popover("show");
            }
            console.log(ChangeBuffer);
        });
    });
    $("#attendanceTab > tbody > tr > td.column2").off("blur");
    //$("#attendanceTab > tbody > tr > td.column2").off("blur", modificationDetector($(this)));


    $("#editation-item").addClass("d-none");
    $("#left-btn-grp").append("<li id='save-item' class='nav-item'>"+
    "<button id='save' onclick='' class='btn btn-success margin-10'>Save</button>"+
    "</li>");
    $("#left-btn-grp").append("<li id='cancel-item' class='nav-item'>"+
    "<button id='cancel' onclick='' class='btn btn-danger margin-10'>Cancel</button>"+
    "</li>");
}
