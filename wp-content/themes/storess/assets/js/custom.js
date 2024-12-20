(function($) {
  'use strict';
  
	if($("body").hasClass("slider5")){
		$(".slider-overlay").show();
	}
	
	// get the image wrapper
        const imagewrapper = document.querySelector(".cycle-image-wrapper");
		 if(imagewrapper) {
			const images = imagewrapper.children;
			images[0].classList.add("active");
			let i = 0;
			function cyclePhotos() {
				images[i].classList.remove("active");
				i = i + 1 < images.length ? i + 1 : 0;
				images[i].classList.add("active");
			}
			let repeater;
			imagewrapper.addEventListener("mouseover", (e) => {
				repeater = setInterval(cyclePhotos, 500);
			});

			imagewrapper.addEventListener("mouseout", (e) => {
				clearInterval(repeater);
			});
		 }
}(jQuery));
