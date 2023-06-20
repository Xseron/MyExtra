// Add a click event listener to each list item
const position = document.querySelectorAll(".our-team ul li h3");

position.forEach(function (item) {
   item.addEventListener("click", function () {
      const memberNames = this.nextElementSibling;
      memberNames.classList.toggle("open");
   });
});
