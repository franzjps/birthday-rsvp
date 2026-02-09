import './bootstrap';

const initCarousel = (carousel) => {
	const track = carousel.querySelector('[data-carousel-track]');
	const prevButton = carousel.querySelector('[data-carousel-prev]');
	const nextButton = carousel.querySelector('[data-carousel-next]');
	const dotsContainer = carousel.querySelector('[data-carousel-dots]');

	if (!track) {
		return;
	}

	const slides = Array.from(track.children);
	let currentIndex = 0;
	let timerId = null;
	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	const stopAllVideos = () => {
		slides.forEach((slide) => {
			const video = slide.querySelector('video');
			if (video) {
				video.pause();
			}
		});
	};

	const playActiveVideo = () => {
		const activeSlide = slides[currentIndex];
		const video = activeSlide?.querySelector('video');
		if (video) {
			video.play().catch(() => {});
		}
	};

	const updateDots = () => {
		if (!dotsContainer) {
			return;
		}
		const dots = Array.from(dotsContainer.querySelectorAll('button'));
		dots.forEach((dot, index) => {
			dot.classList.toggle('is-active', index === currentIndex);
		});
	};

	const goToSlide = (index) => {
		if (!slides.length) {
			return;
		}
		currentIndex = (index + slides.length) % slides.length;
		track.style.transform = `translateX(-${currentIndex * 100}%)`;
		slides.forEach((slide, slideIndex) => {
			slide.classList.toggle('is-active', slideIndex === currentIndex);
		});
		updateDots();
		stopAllVideos();
		playActiveVideo();
	};

	const resetTimer = () => {
		if (prefersReducedMotion) {
			return;
		}
		if (timerId) {
			window.clearInterval(timerId);
		}
		timerId = window.setInterval(() => {
			goToSlide(currentIndex + 1);
		}, 6000);
	};

	if (dotsContainer) {
		slides.forEach((_, index) => {
			const dot = document.createElement('button');
			dot.type = 'button';
			dot.className = 'carousel-dot';
			dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
			dot.addEventListener('click', () => {
				goToSlide(index);
				resetTimer();
			});
			dotsContainer.appendChild(dot);
		});
	}

	if (prevButton) {
		prevButton.addEventListener('click', () => {
			goToSlide(currentIndex - 1);
			resetTimer();
		});
	}

	if (nextButton) {
		nextButton.addEventListener('click', () => {
			goToSlide(currentIndex + 1);
			resetTimer();
		});
	}

	goToSlide(0);
	resetTimer();
};

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-carousel]').forEach(initCarousel);
});
