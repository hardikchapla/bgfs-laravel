// menu toggler
$(".menu-toggler").click(()=>{
    $(".sidebar").toggleClass("sidebar-open");
    if ($(".sidebar").hasClass("sidebar-open")) {
        $(".menu-toggler").css({"position":"fixed"});
    } else {
        $(".menu-toggler").css({"position":"absolute"});
    }
});


// show hide course-details page comment box
let cmnts_inner_btns = document.querySelectorAll(".student-comments .cmnts-inner-btns");
let cmnts_inner_btns_arr = [...cmnts_inner_btns];
cmnts_inner_btns_arr.forEach((e)=>{
    e.addEventListener("click",()=>{
        $(e).toggleClass("active");
        $(e).parent().parent().parent().parent().find(".leave-a-cmnt-box").toggle(500);
    });
});



// course-details page video comment box
let vplay_btn = document.querySelectorAll(".std-video-cmnt .video-thumb .vplay-btn");
let vplay_btn_arr = [...vplay_btn];
// play video on click
vplay_btn_arr.forEach((e)=>{
    e.addEventListener("click",()=>{
        $(e).hide();
        $(e).parent().find("video").attr("controls",true);
        $(e).parent().find("video").get(0).play();
    });
});



// show hide multi-step form
$(".create-ac-form .form-step-2").hide();

$(".create-ac-form #go-to-form-2").click(()=>{
    $(".create-ac-form .form-step-1").hide();
    $(".create-ac-form .form-step-2").slideToggle("slow");
});
$(".create-ac-form #go-back-form-1").click(()=>{
    $(".create-ac-form .form-step-2").hide();
    $(".create-ac-form .form-step-1").slideToggle("slow");
});

let flag = false;
$(".show-hide-pass").click(()=>{
    if (!flag) {
        $("#password[type='password']").attr('type','text');
        flag = true;
    } else{
        $("#password[type='text']").attr('type','password');
        flag = false;
    }
    $(".login-form .show-hide-pass").toggleClass("show-pass");
});