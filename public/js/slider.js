$(document).ready(function () {
  $('#films-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    prevArrow: '<button type="button" class="slick-prev btn-slider"><img src="http://moviematch.com/assets/arrow-left.png" alt=""></button>',
    nextArrow: '<button type="button" class="slick-next btn-slider"><img src="http://moviematch.com/assets/arrow-right.png" alt=""></button>',
  });
});