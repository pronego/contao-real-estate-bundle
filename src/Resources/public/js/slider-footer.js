(() => {
    window.addEventListener("load", function () {
		var quartier_el = $('.swa-property-reader__title');
		var quartier = '';
		
		if(quartier_el.length > 0){
			quartier = quartier_el[0].innerHTML;
		}else{
			quartier_el = $('.swa-apartment-reader__project-name');
			if(quartier_el.length > 0){
				quartier = quartier_el[0].innerHTML;
			}
		}
		
		if(quartier != ''){
			quartier = quartier.replace(/\s+/g, '-')
			$('.slider_'+quartier).remove();
			const c = getSlideCount() - 1;
			document.getElementById("swa-image-slider-footer").dataset.count = c.toString();	
		}
		
        const controlPrev = document.getElementById("swa-image-slider-footer__control--previous");
        const controlNext = document.getElementById("swa-image-slider-footer__control--next");

        controlPrev.addEventListener("click", function () {
            changeSlide(-1);
        });

        controlNext.addEventListener("click", function () {
            changeSlide(1);
        });
		
        initializeSlider();
    });

    function getCurrentSliderPosition() {
        const slider = document.getElementById("swa-image-slider-footer");
        return parseInt(slider.dataset.position);
    }

    function setCurrentSliderPosition(position) {
        const slider = document.getElementById("swa-image-slider-footer");
        slider.dataset.position = position;
    }

    function getSlideDistance() {
        const slider = document.getElementById("swa-image-slider-footer");
        return parseFloat(slider.dataset.distance);
    }

    function getSlideCount() {
        const slider = document.getElementById("swa-image-slider-footer");
        return parseInt(slider.dataset.count);
    }

    function initializeSlider() {
        slideToPosition(getCurrentSliderPosition())
    }

    function changeSlide(direction) {
        const newSliderPosition = getCurrentSliderPosition() + direction;

        slideToPosition(newSliderPosition);
    }

    function slideToPosition(position) {
		const sliderFooter = document.getElementById("footerslider");
        if (0 <= position && position < getSlideCount()) {
            const sliderContainer = document.getElementById("swa-image-slider-footer__slides");
            const slides = sliderFooter.getElementsByClassName("swa-image-slider__slide");
            const currentSliderPosition = getCurrentSliderPosition();
            const slideDistance = getSlideDistance() * -1 * position;

            sliderContainer.style.transform = "translate3d(" + slideDistance + "%, 0, 0)";
            setCurrentSliderPosition(position);
            slides[currentSliderPosition].classList.remove("swa-image-slider__slide--active");
            slides[position].classList.add("swa-image-slider__slide--active");
        }
    }
})();

