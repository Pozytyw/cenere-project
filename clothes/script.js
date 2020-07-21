$(".slider-items2").slick({
    dots: false,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: ".site-slider .btn-slider2 .left2",
    nextArrow: ".site-slider .btn-slider2 .right2",
	responsive: [
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
            }
        }
    ]
});