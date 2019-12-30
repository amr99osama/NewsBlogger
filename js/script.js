
$(document).ready(function(){
    $(window).on('load' ,function(){
    $('.inner-preloader').fadeOut(1700,function()
    {
    $('.preloader').delay(100).fadeOut(800);
    });
    });
    
     AOS.init({
            duration: 1000,
            once: true
        });
});
