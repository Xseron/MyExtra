const dropMenu = document.querySelectorAll(".drop-menu");

dropMenu.forEach((item) => {
   item.addEventListener("click", () => {
      const parent = item.closest("li");
      const dropContent = parent.querySelector(".drop-content");

      dropContent.classList.toggle("open");
   });

   // Add mouseleave event listener to close the dropdown when the mouse is not hovering
   const parent = item.closest("li");
   parent.addEventListener("mouseleave", () => {
      const dropContent = parent.querySelector(".drop-content");
      dropContent.classList.remove("open");
   });
});
