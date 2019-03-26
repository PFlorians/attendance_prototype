var buffer=[];
function editationMode()
{
    $("#attendanceTab > tbody > tr > td.column2").attr({contenteditable: "true"});
    $("#attendanceTab > tbody > tr > td.column3").attr({contenteditable: "true"});
    $("#attendanceTab > tbody > tr > td.column3").addClass("cursor-text");
    $("#attendanceTab > tbody > tr > td.column2").addClass("cursor-text");
    $("#attendanceTab > tbody > tr > td.column2").off("focus").on("focus", (elem)=>{
        console.log(elem.target.innerHTML);
        let x=parseInt(elem.target.innerHTML.trim());
        $(elem.target).off("DOMSubtreeModified").on("DOMSubtreeModified", (eleme)=>{
            console.log(eleme.target.innerHTML);
        });
    });
    $("#attendanceTab > tbody > tr > td.column2").off("blur");
    //$("#attendanceTab > tbody > tr > td.column2").off("blur", modificationDetector($(this)));


    $("#editation-item").addClass("d-none");
    $("#left-btn-grp").append("<li id='save-item' class='nav-item'>"+
    "<button id='save' onclick='' class='btn btn-primary'>Save</button>"+
    "</li>");
    $("#left-btn-grp").append("<li id='cancel-item' class='nav-item'>"+
    "<button id='cancel' onclick='' class='btn btn-primary'>Cancel</button>"+
    "</li>");
}
