(function($) {
  var windowWidth = $(window).width();

$('.profile-submit-btn a').on('click', function(){
  $('.register-type-con').show();
  $('.register-type-btn').hide();
});


$('.edit-profile-btn').on('click', function(){
  $('.profile-img-step-1').addClass('modeEdit');
  $('.profile-submit-btn.profile-edit-step-1').hide();
  $('.profile-edit-step-2').show();
});

$('#edit-profile-cancle-btn').on('click', function(){
  //$('.profile-edit-step-1').show();
  $('.profile-submit-btn.profile-edit-step-1').show();
  $('.profile-img-step-1').removeClass('modeEdit');
  $('.profile-edit-step-2').hide();
});

if( $('#datepicker').length ){
  $('#datepicker').datepicker();
}
if( $('#datepicker2').length ){
  $('#datepicker2').datepicker();
}
if( $('#datepicker3').length ){
  $('#datepicker3').datepicker();
}


//on keypress 
$('#confpass').keyup(function(e){
  //get values 
  var pass = $('#newpass').val();
  var confpass = $(this).val();
  
  //check the strings
  if(pass == confpass){
    //if both are same remove the error and allow to submit
    $('.error').text('');
    allowsubmit = true;
  }else{
    //if not matching show error and not allow to submit
    $('.error').text('Password not matching');
    allowsubmit = false;
  }
});

//jquery form submit
$('#change_pass_form').submit(function(){

  var pass = $('#newpass').val();
  var confpass = $('#confpass').val();

  //just to make sure once again during submit
  //if both are true then only allow submit
  if(pass == confpass){
    allowsubmit = true;
  }
  if(allowsubmit){
    return true;
  }else{
    return false;
  }
});


$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
    //$(this).attr('checked', false);
    if (this.value == 1) {
      $(this).attr("checked", true);
    } else {
      $(this).attr("checked", false);
    }
});

$('input[type="checkbox"]').each(function(e){
    if($(this).val() == 1){
        $(this).attr("checked", true);
    }
});

if( windowWidth > 767 ){
  var windowHeight = $(window).height();

  var headerHeight = $('header.header').height();
  var loginFormLftColHeight = $('.login-form-lft-col').outerHeight();
  var contentCenterConHeight = ( windowHeight - headerHeight );
   //var finalWindowHeight = (contentCenterConHeight - headerHeight );

  if ( windowHeight > 650 ){
    $('.content-center-cntlr, .login-form-cntlr').css("min-height", contentCenterConHeight);
  }

}





/*shorting */

/*
if( $('.mixContainer').length ){
var sortOrder = 'asc';
var container = $('#MixContainer');
var toggleSort = document.querySelector('.toggle-sort');

  var config = document.querySelector('.mixContainer');
  var $sortSelect = $('#itemSort');
  var mixer = mixitup(config);
  
  $sortSelect.on('change', function(){
    mixer.sort(this.value);
  });

container.mixItUp({
    animation: {
        effects: 'fade',
        duration: 300, 
    },
    layout:{
        display:'table-row'
    },
});

toggleSort.addEventListener('click', function() {
  switch (sortOrder) {
    case 'asc':
      sortOrder = 'desc';
    break;
    case 'desc':
      sortOrder = 'asc';
    break;
  }

  container.mixItUp('sort', 'name:' + sortOrder);
});
}
*/

if( $('.mixContainer').length ){
  var config = document.querySelector('.mixContainer');
  var $sortSelect = $('#itemSort');
  var mixer = mixitup(config);
  
  $sortSelect.on('change', function(){
    mixer.sort(this.value);
  });
}

/**
Acount - Login/Register 1
**/
$('div.fl-tabs button').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('div.fl-tabs button').removeClass('current');
    $('.fl-tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
});

$('.register-type-btn a').on('click', function(){
  $('.register-type-con').show();
  $('.register-type-btn').hide();
  goToByScroll('.fl-login-form', 50);
});

$('.register-ngo-btn').on('click', function(){
  $('.ngo-name').show();
  $('.user-name').hide();
  $('#user-type-selection').val('Ngo');
  $('#user-type-selection').selectpicker('refresh');
});

$('.register-supporter-btn').on('click', function(){
  $('.ngo-name').hide();
  $('.user-name').show();
  $('#user-type-selection').val('User');
  $('#user-type-selection').selectpicker('refresh');
});

$('#user-type-selection').on('change', function(){
  var thisval = $(this).val(); 
    $("div.showCntrl").hide();
    $("#show"+thisval).show();
});

$('#goSinginTab').on('click', function(e){
  e.preventDefault();
    $('div.fl-tabs button').removeClass('current');
    $('.fl-tab-content').removeClass('current');
    $('.tabLogin').addClass('current');
    $("#tab-2").addClass('current');
    goToByScroll('.fl-login-form', 50);
});

$('span.actionHide').on('click', function(){
  var target = $(this).attr('data-target');
  $(this).closest(target).slideUp();
});


$('.fl-forget-pass-btn').on('click', function(e){
  e.preventDefault();
     $(".forgot-pass-field-after").toggleClass('forgot-pass-field-after-active');
     $(".forgot-pass-field-before").toggleClass('forgot-pass-field-after-deactive');
});

$('.showMgs').on('click', function(){
  var mgs = $(this).data('mgs');
  var target = $(this).data('target');
  $(target).html('<p>'+mgs+'</p>');
});

/*
Helper functions
**/
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

})(jQuery);