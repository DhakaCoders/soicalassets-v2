(function($) {
var windowWidth = $(window).width();
/*Google Map*/
var CustomMapStyles  = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
$('.navbar-toggle').on('click', function(){
	$('#mobile-nav').slideToggle(300);
});
	
//matchHeightCol
if($('.mHc').length){
  $('.mHc').matchHeight();
};

//$('[data-toggle="tooltip"]').tooltip();

//banner animation
$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  $('.page-banner-bg').css({
    '-webkit-transform' : 'scale(' + (1 + scroll/2000) + ')',
    '-moz-transform'    : 'scale(' + (1 + scroll/2000) + ')',
    '-ms-transform'     : 'scale(' + (1 + scroll/2000) + ')',
    '-o-transform'      : 'scale(' + (1 + scroll/2000) + ')',
    'transform'         : 'scale(' + (1 + scroll/2000) + ')'
  });
});


if($('.fancybox').length){ 
$('.fancybox').fancybox({
    //openEffect  : 'none',
    //closeEffect : 'none'
  });

}


// body animate
$(".hm-bnr-scroll").click(function(e) {
    e.preventDefault();
    var goto = $(this).attr('href');
    $('html, body').animate({
        scrollTop: $(goto).offset().top - 0
    }, 800);
});

/**
Responsive on 767px
*/

// if (windowWidth <= 767) {
  $('.toggle-btn').on('click', function(){
    $(this).toggleClass('menu-expend');
    $('.toggle-bar ul').slideToggle(500);
  });


// }



  $('.share-btn').on('click', function(){
    $(this).toggleClass('thisactive');
    $('.share-icons').slideToggle(300);
  });




if( $('#mapID').length ){
var latitude = $('#mapID').data('latitude');
var longitude = $('#mapID').data('longitude');

var myCenter= new google.maps.LatLng(latitude,  longitude);
function initialize(){
    var mapProp = {
      center:myCenter,
      mapTypeControl:true,
      scrollwheel: false,
      zoomControl: true,
      disableDefaultUI: true,
      zoom:7,
      streetViewControl: false,
      rotateControl: true,
      mapTypeId:google.maps.MapTypeId.ROADMAP,
      styles: CustomMapStyles
      };

    var map= new google.maps.Map(document.getElementById('mapID'),mapProp);
    var marker= new google.maps.Marker({
      position:myCenter,
        //icon:'map-marker.png'
      });
    marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);

}


$('.sa-main-slider').slick({
      pauseOnHover: false,
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1
});

$('.scroll-btn').on('click', function(e){
  e.preventDefault();
  var togo = $(this).data('to');
  goToByScroll(togo, 0);
});

function goToByScroll(id, offset){
  if(id){
      // Remove "link" from the ID
    id = id.replace("link", "");
      // Scroll
    $('html,body').animate(
        {scrollTop: $(id).offset().top - offset},
      500);
  }
}


$('.sa-testimonial-slider').slick({
      pauseOnHover: false,
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1
});


if( $('.sa-company-name').length ){
  $('.sa-company-name').slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
  });
}




/*
-----------------------
Start Contact Google Map ->> 
-----------------------
*/
if( $('#googlemap').length ){
    var latitude = $('#googlemap').data('latitude');
    var longitude = $('#googlemap').data('longitude');
    var markerurl = $('#googlemap').data('markerurl');
    var myCenter= new google.maps.LatLng(latitude,  longitude);
    var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
    function initialize(){
        var mapProp = {
          center:myCenter,

          mapTypeControl:false,
          scrollwheel: false,

          zoomControl: false,
          disableDefaultUI: true,
          zoom:17,
          streetViewControl: false,
          rotateControl: false,
          mapTypeId:google.maps.MapTypeId.ROADMAP,
          styles : CustomMapStyles
      };
      var map= new google.maps.Map(document.getElementById('googlemap'),mapProp);

      var marker= new google.maps.Marker({
        position:myCenter,
        icon: markerurl
        });
      marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
}


/*
 Product Details Slider
*/

if( $('.hm-banner-slider').length ){
  $('.hm-banner-slider').slick({
      autoplay: true,
      autoplaySpeed: 4000,
      dots: true,
      arrows: false,
      infinite: true,
      speed: 700,
      slidesToShow: 1,
      slidesToScroll: 1
  });
}

if( $('.hm-testimonials-slider').length ){
  $('.hm-testimonials-slider').slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1
  });
}



if( $('.hm-partner-slider').length ){
  $('.hm-partner-slider').slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
  });
}


if( $('.miraclePlanBigSlider').length ){
   $('.miraclePlanBigSlider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: false,
    speed: 700,
    dots: false,
    arrows: false,
    fade: true,
    asNavFor: '.miraclePlanthumbSlider',
  });
}

if( $('.miraclePlanthumbSlider').length ){
  $('.miraclePlanthumbSlider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: false,
    speed: 700,
    dots: false,
    arrows: false,
    focusOnSelect: true,
    asNavFor: '.miraclePlanBigSlider',
  });

}

if ($('#socialCookie').length) {
  $('#socialCookie').on('click', function(){
  $('#social-cookie-bar').hide('slow');
  });
}


var allPanels = $('.hh-accordion-des').hide();
$('.hh-accordion-tab-row').removeClass('remove-border');
  $('.hh-accordion-title').click(function() {
        allPanels.slideUp();
        $('.hh-accordion-title').removeClass('hh-accordion-active');
        $('.hh-accordion-tab-row').removeClass('remove-border');
        $(this).next().slideDown();
        $(this).addClass('hh-accordion-active');
        $(this).parent().next().addClass('remove-border');
        return false;
});


if (windowWidth > 767) {
  if( $('#sidebar').length ){
  $('#sidebar').stickySidebar({
      topSpacing: 100,
      bottomSpacing: 60
  });
}
}

if( $('#scrollToAarea').length ){
  $('#scrollToAarea').onePageNav({
    changeHash: false,
    scrollSpeed: 500,
    scrollThreshold: 0.5,
    filter: '',
    easing: 'swing',
  });
}


/*if( $('.masonry').length ){
  $('.masonry').masonry({
    // options
    //itemSelector: 'ul.masonry li',
    columnWidth: '.campaigns-list-item-wrp',
    percentPosition: true,
    fitWidth: true

  });
}*/



function campMasonry(){
  if( $('.masonry').length ){
  $('.masonry').packery({
      // options
      itemSelector: '.campaigns-list-item-wrp',
    });

  }
}

$(window).load(function() {
    campMasonry();
});

if (windowWidth > 991) {
  $('.humberger-menu-btn').on('click', function(){
    $(this).toggleClass('humber-menu-expend');
    $('.humberger-menu-xlg').slideToggle(300);
  });
}

if (windowWidth < 992) {
  $('.humberger-menu-btn').on('click', function(){
    $(this).toggleClass('humber-menu-expend');
    $('.humberger-menu-xs').slideToggle(300);
  });
}


$('.login-btn button').on('click', function(){
  $(this).toggleClass('login-menu-expend');
  $('.login-btn ul').slideToggle(300);
});

$('.hdr-login-profile').on('click', function(){
  $(this).toggleClass('login-btn-expend');
  $('.hdr-login-profile ul').slideToggle(300);
});

$('.humberger-menu-items > ul > li.menu-item-has-children > a').on('click', function(e){
  e.preventDefault();
  $(this).toggleClass('xs-sub-menu-expend');
  $(this).parent().find('.sub-menu').slideToggle(300);
});

$('.site-lang a.active').on('click', function(e){
  e.preventDefault();
});


mycampaigns_url = '';
if( $('#all_campaign').length ){
  var mycampaigns_url = $('#all_campaign').data('campurl');
}

$('.archive_date').change(function(){               
  var userDate = $(this).val();
  var datearr = userDate.split('/');
  var date_string = datearr[0]+'-'+datearr[1]+'-'+datearr[2];
  window.location.href = mycampaigns_url+'/?archive='+date_string;
  //$('#archive_form').submit();
});
if($("#hashtag").length){
  var tagVal = $("#hashtag").data('htag');
}
function queryTag(){
  if (tagVal !='' )
    return tagVal;
  else
    return false;
}

if($("#sorting").length){
  var querySort = $("#sorting").data('sort');
}
function querySorting(){
  if(querySort !='')
    return querySort;
  else
    return false;
}
if($("#key_word").length){
  var key_word = $("#key_word").data('keyword');

}
function campKeyWord(){
  if(key_word != '' && typeof key_word != "undefined")
    return key_word;
  else
    return false;
}
$('#campaign_sort').on('change', function(){               
  var campSort = $(this).val();
  var key_word = '';
  var hashtag = '';
  if(campKeyWord() != '' && typeof campKeyWord() != "undefined"){
    key_word = campKeyWord();
    window.location.href = mycampaigns_url+'/?search='+key_word+'&sorting='+campSort;
  }
  else if(queryTag() != '' && typeof queryTag() != "undefined"){
    hashtag = queryTag();
    window.location.href = mycampaigns_url+'/?hashtag='+hashtag+'&sorting='+campSort;
  }
  else{
    window.location.href = mycampaigns_url+'/?sorting='+campSort;
  }
  
  //$('#archive_form').submit();
});

$('#keyword_form').click(function(event){  
  event.preventDefault();             
  var keyWord = $('#keyword').val();
  window.location.href = mycampaigns_url+keyWord;
});

$('#perpage_set').on('change', function(){ 
  var pageNum = $(this).val();
  setCookie('per_page', pageNum, 1);              
  window.location.href = location.href;
});

if($("#catID").length){
  var catID = $("#catID").data('termid');
}

function catId(){
  if(catID != '')
    return catID;
  else
    return false;
}

if($("#totalPost").length){
  var totalP = $("#totalPost").data('totalp');
  var tloadp = $("#totalPost").data('tloadp');
  $("#putCount").text(totalP);
  $("#ploadCount").text(tloadp);
}

$("#loadMore").on('click', function(e) {
    e.preventDefault();
    var catID = '';
    var key_word = '';
    var sortQuery = '';
    var query_Tag = '';
    if(catId() != '') catID = catId();

    if(campKeyWord() != '') key_word = campKeyWord();

    if(querySorting() != '' ) sortQuery = querySorting();
    if(queryTag() != '' ) query_Tag = queryTag();
    //init
    var that = $(this);
    var page = $(this).data('page');
    var newPage = page + 1;
    var ajaxurl = that.data('url');
    //ajax call
    $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            page: page,
            cat_id: catID,
            key_word: key_word,
            sorting: sortQuery,
            htag: query_Tag,
            el_li: 'not',
            action: 'ajax_camp_script_load_more'
        },
        beforeSend: function ( xhr ) {
            $('#ajxaloader').show();
             
        },
        
        success: function(html ) {
            //check
            if (html  == 0) {
                $('.show-more-btn').prepend('<div class="clearfix"></div><div class="text-center"><p>Geen producten meer om te laden.</p></div>');
                $('.show-more-btn').hide();
                $('#ajxaloader').hide();
            } else {
                /* packery */
                var $container = $('.masonry').packery();
                var $html = $( html );
                $container.append( $html );
                $container.packery( 'appended', $html );
                /* packery */
                $('#ajxaloader').hide();
                that.data('page', newPage);
                //$('#ajax-content').append(html .substr(html .length-1, 1) === '0'? html.substr(0, html.length-1) : html);
                var num = $container.find("li").length;
                if (num > 1) {
                  $("#ploadCount").text(num);
                }
            }
        },
        error: function(html ) {
            console.log('asdfsd');
        },
    });
});


    //new WOW().init();

})(jQuery);

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}