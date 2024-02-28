// $("#calendar").evoCalendar();

$("li.month").click(function (){
    $(".name_info").html(this.innerHTML);
});

$(".iks").click(function (){
    $(".modal").fadeToggle();
});

$(".modal").click(function (e){
    if(e.target == e.currentTarget){
        $(this).fadeToggle();
    }
});

function getData(data){
    dt = data.split(" ");
    return dt[1];
}

function getTime(data){
    dt = data.split(":");
    return dt[0]+":"+dt[1];
}

function getDay(data){
    dt = data.split("/");
    return dt[1];
}

function getAmsativ(data){
    dt = data.split(" ");
    return dt[0];
}

function getStart(data){
    dt = getAmsativ(data);
    or = dt.split("-");
    return or[2];
}

function getInfo(elem){
    $(".event-list").html("");
    // console.log(elem);
    if(elem.length == 0){
        $(".event-list").html("<div class='event-empty'><p>Գրանցումներ չկան</p></div>");
    }else{
        for(today of elem){
            // console.log(today)
            if(today.patient == null){
                if(today.soc == null){
                    today.soc = ''
                }

                event_result.innerHTML+="<div class='event-empty'>" +
                    "<p class='p_anun'>"+today.name+"</p>"+
                    "<p>" +
                        "<span class='skizb'>"+getData(getTime(today.start))+"</span>-" +
                        "<span class='verj'>"+getTime(today.end)+"</span>" +
                    "</p>"+
                    "<p class='coment'>"+today.comments+"</p>" +
                    "<input type='hidden' value="+today.id+" class='p_id'>" +
                    "<input type='hidden' value="+today.soc+" class='p_soc'>" +
                    "<button onclick='edit(this)'>Փոփոխել</button>" +
                "</div>";
            }else{
                if(today.name == null){
                    today.name = "";
                }
                if(today.comments == null){
                    today.comments = "";
                }
                if(today.soc == null){
                    today.soc = '';
                }
                event_result.innerHTML+="<div class='event-empty'>" +
                    "<p>"+today.patient["all_names"]+"</p>"+
                    "<p>" +
                    "<span class='skizb'>"+getData(getTime(today.start))+"</span>-" +
                    "<span class='verj'>"+getTime(today.end)+"</span>" +
                    "</p>"+
                    "<p class='p_anun'>"+today.name+"</p>"+
                    "<p class='coment'>"+today.comments+"</p>" +
                    "<input type='hidden' value="+today.id+" class='p_id'>" +
                    "<input type='hidden' value="+today.patient.soc_card+" class='p_soc'>" +
                    "<button onclick='edit(this)'>Փոփոխել</button>" +
                "</div>";
            }
        }
    }
}

function galochka(elem){
    $(".day").each(function (){
        let or = getDay($(this).attr("data-date-val"));
        // console.log(or);
        for(esor of elem){
            if(or == getStart(esor.start)){
                // console.log(or+" "+getStart(esor.start));
                $(this).append(`<span class="event-indicator"><div class="type-bullet">
                    <div class="type-bullet"><div class="type-event"></div></div>
                </span>`);
            }
        }
    });
}

$(window).on("load",()=>{
    getInfo(todayData);
    if(auth_man_type == 0){
        $("button.plus").css({"display":"none"});
    }
    galochka(all);
    // console.log(all);
});



let data = new Date();

function plus(that){
    var date = new Date(that.getAttribute("data-date-val"));
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
    if(day < data.getDate() && month <= data.getMonth()){
        $(".plus").prop("disabled",true);
    }else if(year < data.getFullYear()){
        $(".plus").prop("disabled",true);
    }else{
        $(".plus").prop("disabled",false);
    }

    if(year > data.getFullYear()){
        $(".plus").prop("disabled",false);
    }
}


function modalToggle(){
    let data = $(".calendar-active").attr("data-date-val");
    $(".modal").fadeToggle();
    $(".modal").css("display","flex");
    $("#amsativ").val(data);
    $(".block input:not([name='_token'],[name='user_id']),.block textarea").val("");
    that = $(".calendar-active").attr("data-date-val");
    document.getElementById('datehidden').value=that;
}


$("input,textarea").on("input",function (){
    let anun = $("#anun").val();
    let cart = $("#carti_hamar").val();
    let start_jam = $("#start_jam").val();
    let end_jam = $("#end_jam").val();
    let txt = $("#txt").val();
    if(anun != ""  && start_jam != "" && end_jam.value != "" && txt != ""){
        $(".send").prop("disabled",false);
    }else{
        $(".send").prop("disabled",true);
    }
});



function ajax(that){
    var result = that.getAttribute("data-date-val");
    // console.log(result);
var user_data=[
    {
        "user_id":user_id,
        "calendar":result,
    }
]
    save(user_data);




}
function fetchsend(token,url,method,data,dataName){
    fetch(url, {
        method: method,
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": token
        }
    }).then(function(response){
        return response.json();
    })  .then(function(json){

        window[dataName](json);
    })
        .catch(function(error){

        });
}

document.querySelector(".send").onclick=()=>{
    var data = $(".calendar-active").attr("data-date-val");
    console.log(anun.value);
    console.log(carti_hamar.value);
    console.log(data);
    console.log(start_jam.value);
    console.log(end_jam.value);
    console.log(txt.value);

    var user_add_data=[
        {
            "name":anun.value,
            "soc":carti_hamar.value,
            "user_id":user_id,
            "calendar":data+' '+start_jam.value,
            "end":end_jam.value,
            "description":txt.value,
        }
    ]
    addCalendar(user_add_data);
}
function htmltype(data){
    console.log(data)
    getInfo(data);
}
function resultCal(json){
alert(json);
}

function edit(that){
    $(".modal").fadeToggle();
    $(".modal").css("display","flex");
    anun.value = $(that).parent().find(".p_anun").text();
    carti_hamar.value = $(that).parent().find(".p_soc").val();
    if(carti_hamar.value == "undefined"){
        carti_hamar.value = "";
    }
    start_jam.value = $(that).parent().find(".skizb").text();
    end_jam.value = $(that).parent().find(".verj").text();
    txt.value = $(that).parent().find(".coment").text();
    hid_id.value = $(that).parent().find(".p_id").val();

    let data = $(".calendar-active").attr("data-date-val");
    document.getElementById('datehidden').value=data;
}
