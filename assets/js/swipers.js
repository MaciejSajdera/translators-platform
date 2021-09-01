// import Swiper JS
import Swiper, {
	Navigation,
	Autoplay,
	Pagination,
	Parallax,
	EffectFade,
	Lazy
} from "swiper";
// import Swiper styles
import "swiper/swiper-bundle.css";

document.addEventListener("DOMContentLoaded", () => {
	console.log("swipers");

	// configure Swiper to use modules
	Swiper.use([Navigation, Pagination, EffectFade]);

	var publicationsSwiper = new Swiper(
		".swiper-container--translator-publications",
		{
			direction: "horizontal",
			loop: false,
			// centeredSlides: true,
			spaceBetween: 50,
			slidesPerView: 2,
			initialSlide: 0,
			speed: 1000,
			autoplay: {
				delay: 3000
			},
			grabCursor: true,
			observer: true,
			observeParents: true,
			// breakpoints: {
			// 	992: {
			// 		slidesPerView: 1.5,
			// 		centeredSlides: true
			// 	}
			// },

			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev"
			}
		}
	);

	var soundGallerySwiper = new Swiper(
		".swiper-container--single-translator-sound-gallery",
		{
			direction: "horizontal",
			loop: false,
			// centeredSlides: true,
			spaceBetween: 50,
			slidesPerView: 1,
			initialSlide: 0,
			speed: 1000,
			autoplay: {
				delay: 2000
			},
			grabCursor: false,
			allowTouchMove: false,
			// observer: true,
			// observeParents: true,
			// breakpoints: {
			// 	992: {
			// 		slidesPerView: 1.5,
			// 		centeredSlides: true
			// 	}
			// },

			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev"
			}
		}
	);

	soundGallerySwiper.on("slideChange", function() {
		console.log("slide changed");
		let activeAudioFile = this.wrapperEl.querySelector(
			".swiper-slide-active audio"
		);
		activeAudioFile && activeAudioFile.pause();
	});

	var multimediaGallerySwiper = new Swiper(
		".swiper-container--single-translator-multimedia-gallery",
		{
			direction: "horizontal",
			loop: false,
			// centeredSlides: true,
			spaceBetween: 50,
			slidesPerView: 1,
			initialSlide: 0,
			speed: 1000,
			autoplay: {
				delay: 2000
			},
			grabCursor: false,
			allowTouchMove: false,
			// observer: true,
			// observeParents: true,
			// breakpoints: {
			// 	992: {
			// 		slidesPerView: 1.5,
			// 		centeredSlides: true
			// 	}
			// },

			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev"
			}
		}
	);
});
