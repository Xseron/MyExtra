const dropMenu = document.querySelectorAll(".drop-menu");

dropMenu.forEach((item) => {
   item.addEventListener("click", () => {
      // get to the nearest parent element of .drop-menu
      const parent = item.closest("li");
      const dropContent = parent.querySelector(".drop-content");

      dropContent.classList.toggle("open");
   });
});
