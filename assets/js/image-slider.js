var slides = document.querySelectorAll(".slide");
var btns = document.querySelectorAll(".slide-nav-btn");
var before_btn = document.querySelectorAll(".slide .before");
var after_btn = document.querySelectorAll(".slide .after");
let currentSlide = 1;

// JS for MANUAL NAVIGATION
var manualNav = function (manual) {
   slides.forEach((slide) => {
      slide.classList.remove("active");

      btns.forEach((btn) => {
         btn.classList.remove("active");
      });
   });

   slides[manual].classList.add("active");
   btns[manual].classList.add("active");
};

btns.forEach((btn, i) => {
   btn.addEventListener("click", () => {
      manualNav(i);
      currentSlide = i;
   });
});

before_btn.forEach((btn, i) => {
   btn.addEventListener("click", () => {
      if (i == 0) {
         manualNav(slides.length - 1);
         currentSlide = slides.length - 1;
      } else {
         manualNav(i - 1);
         currentSlide = i - 1;
      }
   });
});

after_btn.forEach((btn, i) => {
   btn.addEventListener("click", () => {
      if (i == slides.length - 1) {
         manualNav(0);
         currentSlide = 0;
      } else {
         manualNav(i + 1);
         currentSlide = i + 1;
      }
   });
});

// JS for AUTOPLAY
var repeat = function (activeClass) {
   let active = document.getElementsByClassName("active");
   let i = 1;

   var repeater = () => {
      setTimeout(function () {
         [...active].forEach((activeSlide) => {
            activeSlide.classList.remove("active");
         });

         slides[i].classList.add("active");
         btns[i].classList.add("active");
         i++;

         if (slides.length == i) {
            i = 0;
         }
         if (i >= slides.length) {
            return;
         }
         repeater();
      }, 10000);
   };
   repeater();
};
repeat();
