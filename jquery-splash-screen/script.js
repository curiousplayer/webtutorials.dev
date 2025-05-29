$(document).ready(function () {
  setTimeout(function () {
    $('#splash').fadeOut(600, function () {
      $('#content').fadeIn(400);
    });
  }, 2100);
});
