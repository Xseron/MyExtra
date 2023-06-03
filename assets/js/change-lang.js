$("#rus-btn").click(function (e) {
  e.preventDefault();
  $.ajax({
    type: "GET",
    url: "/languages/lang.php?lang=ru",
    success: function (response) {
      console.log("rus activate");
      window.location.reload();
    },
  });
});
$("#kz-btn").click(function (e) {
  e.preventDefault();
  $.ajax({
    type: "GET",
    url: "/languages/lang.php?lang=kz",
    success: function (response) {
      console.log("kz activate");
      window.location.reload();
    },
  });
});
$("#eng-btn").click(function (e) {
  e.preventDefault();
  $.ajax({
    type: "GET",
    url: "/languages/lang.php?lang=en",
    success: function (response) {
      console.log("eng activate");
      window.location.reload();
    },
  });
});
