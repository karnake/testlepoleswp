jQuery(document).ready(function ($){
        
    $('html').click(function() {
        $('.example').hide(); 
    });

    $('.form-section').click(function(event){
        event.stopPropagation();
    });
    
    $("#search-btn").click(function(){
        $(".example").slideToggle();
        return false; 
    });
    
    $( '.widget_search label' ).after('<input class="search-submit" type="submit" value="Search">');
    
    /** Variables from Customizer for Slider settings */
    var slider_auto, slider_loop, slider_pager, slider_control, slider_animation;
    if( halcyon_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( halcyon_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( halcyon_data.pager == '1' ){
        slider_pager = true;
    }else{
        slider_pager = false;
    }
    
    if( halcyon_data.control == '1' ){
        slider_control = true;
    }else{
        slider_control = false;
    }

    if( halcyon_data.animation == 'slide' ){
       slider_animation = '';
    }else {
       slider_animation = 'fadeOut';
    }
    
    /** Home Page Slider */
    $('#lightSlider').owlCarousel({
        items               : 1,
        margin              : 0,
        animateOut          : slider_animation,
        autoplaySpeed       : halcyon_data.speed, //ms'
        autoplay            : slider_auto,
        loop                : slider_loop,
        autoplayTimeout     : halcyon_data.pause,
        nav                 : slider_control,
        dots                : slider_pager,
        mouseDrag           : false,
    });

    //mobile-menu
    var winWidth = $(window).width();

    if(winWidth < 992){
        $('.main-navigation').prepend('<div class="btn-close-menu"></div>');

        $('.main-navigation ul .menu-item-has-children').append('<div class="angle-down"></div>');

        $('.main-navigation ul li .angle-down').click(function(){
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#mobile-menu-opener').click(function(){
            $('body').addClass('menu-open');
        });

        $('.btn-close-menu').click(function(){
            $('body').removeClass('menu-open');
        });

        $('.overlay').click(function(){
            $('body').removeClass('menu-open');
        });
    }

    if(winWidth > 991){
        $("#site-navigation ul li a").focus(function() {
            $(this).parents("li").addClass("focus");
        }).blur(function() {
            $(this).parents("li").removeClass("focus");
        });
    }
});