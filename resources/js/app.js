const setupAcuarelaCarousel = (carouselRoot) => {
	const track = carouselRoot.querySelector('[data-carousel-track]');
	const viewport = carouselRoot.querySelector('[data-carousel-viewport]');
	const prevButton = carouselRoot.querySelector('[data-carousel-prev]');
	const nextButton = carouselRoot.querySelector('[data-carousel-next]');

	if (!track || !viewport || !prevButton || !nextButton) {
		return;
	}

	const slides = Array.from(track.children);
	if (slides.length === 0) {
		return;
	}

	let currentIndex = 0;
	let pointerDownX = null;

	const slidesPerView = () => {
		if (window.innerWidth >= 1024) {
			return 3;
		}

		if (window.innerWidth >= 640) {
			return 2;
		}

		return 1;
	};

	const maxIndex = () => Math.max(0, slides.length - slidesPerView());

	const render = () => {
		const perView = slidesPerView();
		currentIndex = Math.min(currentIndex, maxIndex());
		const offset = (100 / perView) * currentIndex;
		track.style.transform = `translateX(-${offset}%)`;

		prevButton.disabled = currentIndex <= 0;
		nextButton.disabled = currentIndex >= maxIndex();
	};

	prevButton.addEventListener('click', () => {
		currentIndex = Math.max(0, currentIndex - 1);
		render();
	});

	nextButton.addEventListener('click', () => {
		currentIndex = Math.min(maxIndex(), currentIndex + 1);
		render();
	});

	viewport.addEventListener('pointerdown', (event) => {
		pointerDownX = event.clientX;
		viewport.classList.add('cursor-grabbing');
	});

	const handlePointerEnd = (event) => {
		if (pointerDownX === null) {
			return;
		}

		const dragDistance = event.clientX - pointerDownX;
		if (dragDistance <= -45) {
			currentIndex = Math.min(maxIndex(), currentIndex + 1);
		}

		if (dragDistance >= 45) {
			currentIndex = Math.max(0, currentIndex - 1);
		}

		pointerDownX = null;
		viewport.classList.remove('cursor-grabbing');
		render();
	};

	viewport.addEventListener('pointerup', handlePointerEnd);
	viewport.addEventListener('pointerleave', handlePointerEnd);
	viewport.addEventListener('pointercancel', () => {
		pointerDownX = null;
		viewport.classList.remove('cursor-grabbing');
	});

	window.addEventListener('resize', render);
	render();
};

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-acuarela-carousel]').forEach(setupAcuarelaCarousel);
});
