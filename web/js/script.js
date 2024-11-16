
      let menu = document.querySelector("#menu");
      let overlay = document.querySelector("#overlay");
      let left = document.querySelector("#left");

      menu.addEventListener("click", function () {
        let leftDisplayStyle = window.getComputedStyle(left).getPropertyValue("display");
        if (leftDisplayStyle === "none") {
          overlay.style.display = "block";
          left.style.display = "block";
        } else {
          overlay.style.display = "none";
          left.style.display = "none";
        }
      });
        overlay.addEventListener("click", function () {
        overlay.style.display = "none";
        left.style.display = "none";
      });



