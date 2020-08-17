$('document').ready(function(){
  $('.signUP').on('blur',function(){
    $('#signTitle').html('Sign up');
    var val=$(this).val();
    var id=$(this).attr('id');
    var msgBX='#M' + id;
    var type='input';
    $.get('ajax/signup.php?inpt=' + id  + '&value=' + val + '&type=' + type, function(data){
       $(msgBX).html(data);
    });
  });
  $('#signPs').add('#newPassword').on('blur',function(){
    $('#signCp').val('');
    $('#MsignCp').html('');
    $('#newPassword2').val('');
    $('#MnewPassword2').html('');
  });
  $("#signUp").on("submit",function(event){
    event.preventDefault(); //prevent default action 
    var form_data = new FormData(this); //Creates new FormData object
    //form_data.append("type", 'form');
    $.ajax({
            url : 'ajax/signup.php',
            type: 'post',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false
           }).done(function(data){
             $('#signTitle').html(data);
             setTimeout(function(){
               window.location.href="index.php";
             }, 1000);
           });

  }); 
  $('.LogIN').on('blur',function(){
    $('#logInTitl').html('Sign in');
    var val=$(this).val();
    var id=$(this).attr('id');
    var msgBX='#M' + id;
    var type='input';
    $.get('ajax/login.php?inpt=' + id  + '&value=' + val + '&type=' + type, function(data){
       $(msgBX).html(data);//alert(data);
    });
  });
  $("#LogIn").on("submit",function(event){
    event.preventDefault(); //prevent default action 
    var form_data = new FormData(this); //Creates new FormData object
    $.ajax({
      url : 'ajax/login.php',
      type: 'post',
      data: form_data,
      contentType: false,
      cache: false,
      processData:false
    }).done(function(data){
        //alert(data);
        $('#logInTitl').html(data);
        //$("#header").load(location.href + " #header");
        setTimeout(function(){
          window.location.href="index.php";
        }, 1000);
    });
  }); 
  $('.UserUpdate').on('blur',function(){//alert('e');
    $('#titleUpdate').html('User details');
    var val=$(this).val();
    var id=$(this).attr('id');
    var msgBX='#M' + id;
    var type='input';
    $.get('ajax/UserUpdate.php?inpt=' + id  + '&value=' + val + '&type=' + type, function(data){
       $(msgBX).html(data);
    });
  });
  $("#UserUpdt").on("submit",function(event){
    event.preventDefault(); //prevent default action 
    var form_data = new FormData(this); //Creates new FormData object
    //form_data.append("type", 'form');
    $.ajax({
            url : 'ajax/UserUpdate.php',
            type: 'post',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false
           }).done(function(data){
             $('#titleUpdate').html(data);//alert(data);
             $('.message').html('');
           });
  }); 
  $('.UpdatePs').on('blur',function(){//alert('e');
  $('#titleUpdatePs').html('Update password');
  var val=$(this).val();
  var id=$(this).attr('id');
  var msgBX='#M' + id;
  var type='UdPsw';
  $.get('ajax/UserUpdate.php?inpt=' + id  + '&value=' + val + '&type=' + type, function(data){
     $(msgBX).html(data);
  });
});
$("#UserUpdtPs").on("submit",function(event){//alert('');
  event.preventDefault(); //prevent default action 
  var form_data = new FormData(this); //Creates new FormData object
  //form_data.append("type", 'form');
  $.ajax({
          url : 'ajax/UserUpdate.php',
          type: 'post',
          data: form_data,
          contentType: false,
          cache: false,
          processData:false
         }).done(function(data){
           $('#titleUpdatePs').html(data);
           $('.messagePs').html('');
         });
  });
});
function volumeToggle(params) {
  var muted = $(".previewVideo").prop("muted");
  $(".previewVideo").prop("muted", !muted);

  $(params).find('i').toggleClass("fa-volume-off");
  $(params).find('i').toggleClass("fa-volume-up");
}
function goBack() {
  window.history.back();
}
function watchVideo(videoID){
  window.location.href="watch.php?id=" + videoID;
}
$(document).scroll(function() {
  var isScrolled = $(this).scrollTop() > $("#hedr").height();
  if(isScrolled){
    $("#hedr").css("background-color", "#141414");
  }else{
    $("#hedr").css("background-color", "rgba(51,51,51,0.1)");
  }
  $("#hedr").toggleClass("scrolled", isScrolled);
});
function showUpNext() {
  $(".upNext").fadeIn();
}
function restartVideo() {
  $("video")[0].currentTime = 0;
  $("video")[0].play();
  $(".upNext").fadeOut();
}
function startHideTimer() {
  var timeout = null;
  
  $(document).on("mousemove", function() {
      clearTimeout(timeout);
      $(".watchNav").fadeIn();

      timeout = setTimeout(function() {
          $(".watchNav").fadeOut();
      }, 2000);
  })
}
function initVideo(videoId, username) {
 startHideTimer();
 setStartTime(videoId, username);
 updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
  addDuration(videoId, username);

  var timer;

  $("video").on("playing", function(event) {
      window.clearInterval(timer);
      timer = window.setInterval(function() {
          updateProgress(videoId, username, event.target.currentTime);
      }, 3000);
  })
  .on("ended", function(event) {
      setFinished(videoId, username);
      window.clearInterval(timer);
  })
}

function addDuration(videoId, username) {
  $.post("ajax/addDuration.php", { videoId: videoId, username: username }, function(data) {
      if(data !== null && data !== "") {
          alert(data);
      }
  })
}

function updateProgress(videoId, username, progress) {
  $.post("ajax/updateDuration.php", { videoId: videoId, username: username, progress: progress }, function(data) {
      if(data !== null && data !== "") {
          alert(data);
      }
  })
}
function setFinished(videoId, username) {
  $.post("ajax/setFinished.php", { videoId: videoId, username: username }, function(data) {
      if(data !== null && data !== "") {
          alert(data);
      }
  })
}
function setStartTime(videoId, username) {
  $.post("ajax/getProgress.php", { videoId: videoId, username: username }, function(data) {
      if(isNaN(data)) {
          alert(data);
          return;
      }

      $("video").on("canplay", function() {
          this.currentTime = data;
          $("video").off("canplay");
      })
  })
}