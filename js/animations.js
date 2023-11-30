
//insta posztok behúzása
function reveal() {
    var reveals = document.querySelectorAll(".reveal");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        } else {
            reveals[i].classList.remove("active");
        }
    }
}

window.addEventListener("scroll", reveal);

//oldalról behúzás

function slidein() {
    var slidein = document.querySelectorAll(".slidein");

    for (var i = 0; i < slidein.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = slidein[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            slidein[i].classList.add("slider"); //ha érzékeli hogy az elem látható akkor hozzáadja a slider class-t, és a megfelelő animáció fog rá vonatkozni
        } else {
            slidein[i].classList.remove("slider"); //amint kikerül a képernyőről, akkor eltünteti a slider classt
        }
    }
}
window.addEventListener("scroll", slidein);


var bg = document.querySelector('.item-bg');
var items = document.querySelectorAll('.news__item');
var item = document.querySelector('.news__item');

function cLog(content) {
    console.log(content)
}

if ($(window).width() > 800) {
    $(document).on("mouseover", ".news__item", function (_event, _element) {

        var newsItem = document.querySelectorAll('.news__item');
        newsItem.forEach(function (element, index) {
            element.addEventListener('mouseover', function () {
                var x = this.getBoundingClientRect().left;
                var y = this.getBoundingClientRect().top;
                var width = this.getBoundingClientRect().width;
                var height = this.getBoundingClientRect().height;

                $('.item-bg').addClass('active');
                $('.news__item').removeClass('active');
                // $('.news__item').removeClass('active');


                bg.style.width = width + 'px';
                bg.style.height = height + 'px';
                bg.style.transform = 'translateX(' + x + 'px ) translateY(' + y + 'px)';
            });

            element.addEventListener('mouseleave', function () {
                $('.item-bg').removeClass('active');
                $('.news__item').removeClass('active');
            });

        });

    });
}


