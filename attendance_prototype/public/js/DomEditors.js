
function editationMode()
{
    var shs=$("#attendanceTab > tbody > tr > td.column5");
    var ids=[];
    for(var i=0;i<shs.length;i++)
    {
        ids.push(shs[i].id.toString().trim());
    }
    //console.log(ids);
    var opts="";
    for(var i=0;i<shiftTypes.length;i++)
    {
        opts=opts+"<option>"+shiftTypes[i]+"</option>";
    }
    for(var i=0;i<shs.length;i++)
    {
        $("#attendanceTab > tbody > tr > #"+ids[i]).replaceWith("<td class='column5' id="+ids[i]+">"+"<select>"+opts+"</select></td>");
    }
    if(typeof ChangeBuffer === "undefined")
    {
        ChangeBuffer = new Object();
    }
    $("#attendanceTab > tbody > tr > td.column2").attr({contenteditable: "true"});
    $("#attendanceTab > tbody > tr > td.column3").attr({contenteditable: "true"});
    //$("#attendanceTab > tbody > tr > td.column5").replaceWith("<td class='column5'><select>"+opts+"</select></td>");
    $("#attendanceTab > tbody > tr > td.column3").addClass("cursor-text");
    $("#attendanceTab > tbody > tr > td.column2").addClass("cursor-text");
    $("#attendanceTab > tbody > tr > td.column2").on("keydown", (elem) => {
        var row=elem.target.id.trim().split("_");
        var x=elem.target.innerHTML.trim();
        var rgx=new RegExp("^([0-2]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}){1}$");
        if(rgx.test(x))
        {
            $(elem.target).popover("dispose");
            //console.log("case 0");
            if(typeof ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]==='undefined')//check if already initialized
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]=new ChangeRow({id: record_ids[parseInt(row[row.length-1])], col2: elem.target.innerHTML.trim()});
            //    console.log("first case 1");
            }
            else //otherwise no need to instantiate just alter already existing object
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].id=record_ids[parseInt(row[row.length-1])];
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].column2=elem.target.innerHTML.trim();
            //    console.log("second case 1");
            }
            console.log(ChangeBuffer);
        }
        else
        {
            $(elem.target).popover("dispose").popover({
                content: 'Value should be a valid time format',
                placement: 'right',
                trigger: 'manual'
            });
            $(elem.target).popover("show");
        //    console.log("case 1");
        }
    });
    $("#attendanceTab > tbody > tr > td.column2").on("keyup", (elem) => {
        var row=elem.target.id.trim().split("_");
        var x=elem.target.innerHTML.trim();
        var rgx=new RegExp("^([0-2]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}){1}$");
        if(rgx.test(x))
        {
            $(elem.target).popover("dispose");
            if(typeof ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]==='undefined')//check if already initialized
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]=new ChangeRow({id: record_ids[parseInt(row[row.length-1])], col2: elem.target.innerHTML.trim()});
            //    console.log("first case 2");
            }
            else //otherwise no need to instantiate just alter already existing object
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].id=record_ids[parseInt(row[row.length-1])]
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].column2=elem.target.innerHTML.trim();
            //    console.log("second case 2");
            }
            console.log(ChangeBuffer);
        }
        else
        {
            $(elem.target).popover("dispose").popover({
                content: 'Value should be a valid time format',
                placement: 'right',
                trigger: 'manual'
            });
            $(elem.target).popover("show");
        //    console.log("case 11");
        }
    });
    $("#attendanceTab > tbody > tr > td.column3").on("keydown", (elem) => {
        var row=elem.target.id.trim().split("_");
        var x=elem.target.innerHTML.trim();
        var rgx=new RegExp("^([0-2]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}){1}$");
        if(rgx.test(x))
        {
            $(elem.target).popover("dispose");
            //console.log("case 0");
            if(typeof ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]==='undefined')//check if already initialized
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]=new ChangeRow({id: record_ids[parseInt(row[row.length-1])], col3: elem.target.innerHTML.trim()});
            //    console.log("first case 1");
            }
            else //otherwise no need to instantiate just alter already existing object
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].id=record_ids[parseInt(row[row.length-1])];
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].column3=elem.target.innerHTML.trim();
            //    console.log("second case 1");
            }
            console.log(ChangeBuffer);
        }
        else
        {
            $(elem.target).popover("dispose").popover({
                content: 'Value should be a valid time format',
                placement: 'right',
                trigger: 'manual'
            });
            $(elem.target).popover("show");
        //    console.log("case 1");
        }
    });
    $("#attendanceTab > tbody > tr > td.column3").on("keyup", (elem) => {
        var row=elem.target.id.trim().split("_");
        console.log(elem.target);
        var x=elem.target.innerHTML.trim();
        var rgx=new RegExp("^([0-2]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}:){1}([0-5]{1}[0-9]{1}){1}$");
        if(rgx.test(x))
        {
            $(elem.target).popover("dispose");
            if(typeof ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]==='undefined')//check if already initialized
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]=new ChangeRow({
                    id: record_ids[parseInt(row[row.length-1])], col3: elem.target.innerHTML.trim()
                });
            //    console.log("first case 2");
            }
            else //otherwise no need to instantiate just alter already existing object
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].id=record_ids[parseInt(row[row.length-1])];
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].column3=elem.target.innerHTML.trim();
                //console.log("second case 2");
            }
            console.log(ChangeBuffer);
        }
        else
        {
            $(elem.target).popover("dispose").popover({
                content: 'Value should be a valid time format',
                placement: 'right',
                trigger: 'manual'
            });
            $(elem.target).popover("show");
            //console.log("case 11");
        }
    });

    $("#attendanceTab > tbody > tr > td.column5").on("click", (elem)=>{
        if($(elem.target).is("select"))
        {
            console.log("select " + elem.target.value.trim());
            var row=$(elem.target).parent().attr("id").trim().split("_");
            if(typeof ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]==='undefined')//check if already initialized
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]=new ChangeRow({
                    id: record_ids[parseInt(row[row.length-1])], sh: elem.target.value.trim()
                });
                //console.log("first case 2 ");
                //console.log(ChangeBuffer);
            }
            else //otherwise no need to instantiate just alter already existing object
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].id=record_ids[parseInt(row[row.length-1])];
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].shift=elem.target.innerHTML.trim();
                //console.log("first case 2 ");
                //console.log(ChangeBuffer);
            }
            //console.log(ChangeBuffer);
        }
        else if($(elem.target).is("option")) {
            console.log('opt');
            var row=$($(elem.target).parent()).parent().attr("id").trim().split("_");
            if(typeof ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]==='undefined')//check if already initialized
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()]=new ChangeRow({
                    id: record_ids[parseInt(row[row.length-1])], sh: elem.target.value.trim()
                });
            //    console.log("first case 2");
            }
            else //otherwise no need to instantiate just alter already existing object
            {
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].id=record_ids[parseInt(row[row.length-1])];
                ChangeBuffer[record_ids[parseInt(row[row.length-1])].toString()].shift=elem.target.innerHTML.trim();
                //console.log("second case 2");
            }
            //console.log(ChangeBuffer);
        }
    });
    $("#attendanceTab > tbody > tr > td.column2").off("blur");
    $("#attendanceTab > tbody > tr > td.column3").off("blur");
    //$("#attendanceTab > tbody > tr > td.column2").off("blur", modificationDetector($(this)));


    $("#editation-item").addClass("d-none");
    $("#left-btn-grp").append("<li id='save-item' class='nav-item'>"+
    "<button id='save' onclick='saveEditedData()' class='btn btn-success margin-10'>Save</button>"+
    "</li>");
    $("#left-btn-grp").append("<li id='cancel-item' class='nav-item'>"+
    "<button id='cancel' onclick='location.reload()' class='btn btn-danger margin-10'>Cancel</button>"+
    "</li>");
}
