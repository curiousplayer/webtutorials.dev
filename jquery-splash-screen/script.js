$(document).ready(function () {
  setTimeout(function () {
    $('#splash').fadeOut(600, function () {
      $('body').css('visibility', 'visible');
    });
  }, 2000);
});
