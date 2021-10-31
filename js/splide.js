new Splide( '.splide', {
            type  : 'fade',
            rewind: true,   
            autoplay: true,
          } ).mount();
    
document.addEventListener("DOMContentLoaded", function () {
    slider_one();
    slider_two();
//   global_carousel__ctrl();
});

function slider_one() {
    var one = new Splide("#one", {
            type  : 'fade',
            rewind: true,   
            autoplay: true,
    }).mount();
}

function slider_two() {
    var two = new Splide("#two", {
    type     : 'loop',
    perPage : 4,
    breakpoints: {
    '991.98': {
        perPage: 3,
    },
    '577': {
        perPage: 1,
    }
    },
    // autoplay: true,
    focus : 'center',
    }).mount();
}