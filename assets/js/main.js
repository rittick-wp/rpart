const filterBtn = document.getElementById("filterBtn");
const body = document.querySelector("body");

jQuery(".Heroslider").flexslider({
  animation: "slide",
  namespace: "rpart-",
  easing: "swing",
  prevText: "",
  nextText: "",
  slideshowSpeed: 5000,
  animationSpeed: 600,
});

jQuery(".flexslider").flexslider({
  animation: "fade",
  directionNav: true,
  prevText: "&#11164",
  nextText: "&#11166",
  controlNav: false,
  easing: "swing",
  slideshowSpeed: 7000,
  animationSpeed: 600,
});

jQuery(".quick-view-btn").on("click", function (e) {
  e.preventDefault();
  jQuery(this).children().fadeIn();
  var product_id = jQuery(this).data("product_id");
  jQuery.ajax({
    url: ajaxurl,
    data: {
      action: "custom_quick_view",
      product_id: product_id,
    },
    type: "POST",
    async: true,
    success: function (response) {
      jQuery(".quick-view-btn svg").fadeOut();
      jQuery("#quick-view-product").html(response);
      jQuery("#quick-view-modal").fadeIn(300);
    },
  });
});

jQuery(".close-modal").on("click", function () {
  jQuery("#quick-view-modal").fadeOut(300);
});

// Prodyct Archive / Shop Page
if (
  body.classList.contains("tax-product_cat") ||
  body.classList.contains("post-type-archive") ||
  body.classList.contains("page-id-151")
) {
  filterBtn.addEventListener("click", () => {
    console.log("filter Button clicked");
  });
}

if (body.classList.contains("single-product")) {
  const timeData = document.getElementById("sales_timer").getAttribute("data-date");
  const year = timeData.split("-")[0];
  const month = timeData.split("-")[1];
  const days = timeData.split("-")[2];
  const countDownDate = new Date(year, month - 1, days);
  const x = setInterval(function () {
    const now = new Date().getTime();
    const distance = countDownDate - now;
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    days = days < 10 ? "0" + days : days;
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;

    if (distance < 0) {
      clearInterval(x);
      document.getElementById("sales_timer").innerHTML = "EXPIRED";
    }
  }, 1000);
}
