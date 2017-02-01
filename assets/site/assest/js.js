/*jslint browser: true*/
/*global $, jQuery, alert*/
'use strict';


// ghada scripts

$(function () {

    var $geturl=$('.rateyo').attr('data-geturl');
    var $product_id=$('.rateyo').attr('data-productId');

    //get rate value and  display it
    //$(document).ready(function(){

    $.ajax({
        url:$geturl+"/"+$product_id,
        type:"GET",
        success:function(data){
            if(data.status=='success'){
                $('.rateyo').rateYo('rating',data.value[0]);
            }
        }
    });
    //add rate

    var $url=$('.rateyo').attr('data-url');

    $(".rateyo").rateYo({
        rtl: true,
        fullStar: true,
        spacing   : "15px",
        ratedFill: "#f5cb0c",
        starWidth: "20px"
    }).on("rateyo.set", function (e, data)
    {
        $.ajax({
            url:$url+"/"+$product_id+"/"+data.rating,
            type:"GET",
            success:function(data){
                if(data.status=='login')
                {
                    toastr.error(data.msg);
                }else if(data.status=='notallowed')
                {
                    toastr.warning(data.msg);
                }else if(data.status=='success')
                {
                    toastr.success(data.msg);
                }else
                {
                    toastr.error(data.msg);
                }
            }
        });
    });

});




function fix(){
    if ($(window).width() < 991) {
        $('.main-box').removeAttr('style');
    }
}
jQuery(window).resize(function($) {
    fix();
});
$(".up-menu > li:has(ul)").children('a').addClass('togg');


jQuery(document).ready(function() {

    $('.qtyplus').click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name=' + fieldName + ']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name=' + fieldName + ']').val(0);
        }
    });


    window.onresize = function () {
        if (window.innerWidth <= 800) {
            $("ul.up-menu").removeAttr("style");
        }
    }
    $(".open-menuxx").on('click', function (e) {
        $("ul.up-menu").slideToggle("fast", function () {});
    });
    $('.togg').parent('li').hover(function () {
        if ($(this).hasClass('active')) {
            $(this).find('ul').slideUp('fast');
            $(this).removeClass('active');
        } else {
            $('.up-menu > li > ul').slideUp('fast');
            $('.up-menu > li').removeClass('active');
            $(this).addClass('active');
            $(this).children('ul').slideDown();
        }
    });
    $(document).click(function (event) {
        if (!$(event.target).closest('.up-menu').length) {
            $('.up-menu > li > ul').slideUp('fast');
            $('.up-menu > li').removeClass('active');
        }
    })


    $('.shopping-cart').hover(function(){
        $('#cart-content').slideDown();
    }).mouseleave(function(){
        $('#cart-content').slideUp();
    });
    $(document).on('click','.menu-toggle', function(){
        $('.mainer-menu').slideToggle();
    });

    fix();

    $("#main-slider").owlCarousel({
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        pagination: true,
        theme: "main-sz",
        mouseDrag: false,
        navigationText : ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    });
    $(".carousel1").owlCarousel({
        items : 6,
        itemsDesktop      : [1199,6],
        itemsDesktopSmall     : [979,4],
        itemsTablet       : [768,3],
        itemsMobile       : [479,1],
        navigation: true,
        pagination:false,
        mouseDrag : false,
        theme : "owl-themez",
    });
    $(".carousel2").owlCarousel({
        items : 4,
        itemsDesktop      : [1199,4],
        itemsDesktopSmall     : [979,3],
        itemsTablet       : [768,2],
        itemsMobile       : [479,1],
        navigation: true,
        pagination:false,
        mouseDrag : false,
        theme : "owl-themez",
    });









    $(".slider")
    .slider({
        max: 12,
        range: true,
        values: [5, 15]
    })
    .slider("pips", {
        rest: false
    });


    var sync1 = $(".big-images");
    var sync2 = $(".thumbs");

    sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: false,
        pagination:false,
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
    });

    sync2.owlCarousel({
        items : 3,
        itemsDesktop      : [1199,3],
        itemsDesktopSmall     : [979,2],
        itemsTablet       : [768,1],
        itemsMobile       : [479,1],
        pagination:false,
        responsiveRefreshRate : 100,
        afterInit : function(el){
            el.find(".owl-item").eq(0).addClass("synced");
        }
    });

    function syncPosition(el){
        var current = this.currentItem;
        $(".thumbs")
        .find(".owl-item")
        .removeClass("synced")
        .eq(current)
        .addClass("synced")
        if($(".thumbs").data("owlCarousel") !== undefined){
            center(current)
        }
    }

    $(".thumbs").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
    });

    function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for(var i in sync2visible){
            if(num === sync2visible[i]){
                var found = true;
            }
        }

        if(found===false){
            if(num>sync2visible[sync2visible.length-1]){
                sync2.trigger("owl.goTo", num - sync2visible.length+2)
            }else{
                if(num - 1 === -1){
                    num = 0;
                }
                sync2.trigger("owl.goTo", num);
            }
        } else if(num === sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
            sync2.trigger("owl.goTo", num-1)
        }

    }
    $(".ddd").on("click", function () {
        var $button = $(this);
        var $input = $button.closest('.sp-quantity').find("input.quntity-input");

        $input.val(function(i, value){
            value = Number(value) + Number($button.data('multi'));
            if(value >= $input.data('max')){
                return $input.data('max');
            }else if(value <= $input.data('min')){
                return $input.data('min');
            }
            return value;
        });
    });


});



function request(url, data, completeHandler, errorHandler, progressHandler) {
    if (typeof progressHandler === 'string' || progressHandler instanceof String) {
        method = progressHandler;
    } else {
        method = "POST"
    }

    $.ajax({
        url: url, //server script to process data
        type: method,
        xhr: function () {  // custom xhr
            myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // if upload property exists
                myXhr.upload.addEventListener('progress', progressHandler, false); // progressbar
            }
            return myXhr;
        },
        // Ajax events
        success: completeHandler,
        error: errorHandler,
        // Form data
        data: data,
        // Options to tell jQuery not to process data or worry about the content-type
        cache: false,
        contentType: false,
        processData: false
    }, 'json');
}


function toggleChevron(e) {
    $(e.target)
    .prev('.panel-heading')
    .find("i.indicator")
    .toggleClass('fa-caret-down fa-caret-right');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);


//fliter product script

$('input').change(function(){

    // var url      = window.location.href
    // var data=$("#filterSubmit").serialize();
    //  url=url+'/?'+data;
    //  window.location.href = url
    $("#filterSubmit").submit();
})
