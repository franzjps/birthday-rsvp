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

const initModal = (modal) => {
	const openButtons = document.querySelectorAll(`[data-open-modal="${modal.id}"]`);
	const closeButtons = modal.querySelectorAll('[data-close-modal]');
	const firstField = modal.querySelector('textarea, input, button');
	const contactRadios = modal.querySelectorAll('input[type="radio"][data-contact-radio]');
	const contactInputs = modal.querySelectorAll('[data-contact-input]');

	// Skip initialization if no open buttons and no close buttons
	if (!openButtons.length && !closeButtons.length) {
		return;
	}

	const updateContactInput = (value) => {
		contactInputs.forEach((section) => {
			const isActive = section.dataset.contactInput === value;
			section.classList.toggle('is-hidden', !isActive);
			section.querySelectorAll('input').forEach((input) => {
				input.required = isActive;
			});
		});
	};

	const openModal = () => {
		modal.classList.add('is-open');
		modal.setAttribute('aria-hidden', 'false');
		document.body.style.overflow = 'hidden';
		if (firstField) {
			firstField.focus();
		}
	};

	const closeModal = () => {
		modal.classList.remove('is-open');
		modal.setAttribute('aria-hidden', 'true');
		document.body.style.overflow = '';
	};

	openButtons.forEach((button) => {
		button.addEventListener('click', openModal);
	});

	contactRadios.forEach((radio) => {
		radio.addEventListener('change', (event) => {
			updateContactInput(event.target.value);
		});
	});

	closeButtons.forEach((button) => {
		button.addEventListener('click', closeModal);
	});

	modal.addEventListener('click', (event) => {
		if (event.target === modal) {
			closeModal();
		}
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && modal.classList.contains('is-open')) {
			closeModal();
		}
	});

	const defaultRadio = modal.querySelector('input[type="radio"][data-contact-radio]:checked');
	if (defaultRadio) {
		updateContactInput(defaultRadio.value);
	}

	// Auto-open if data-auto-open attribute is present
	if (modal.dataset.autoOpen === 'true') {
		openModal();
	}
};

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-carousel]').forEach(initCarousel);
	document.querySelectorAll('.modal').forEach(initModal);

	const successToast = document.getElementById('successToast');
	if (successToast) {
		window.scrollTo({ top: 0, behavior: 'smooth' });
		setTimeout(() => {
			successToast.remove();
		}, 5000);
	}

	const errorToast = document.getElementById('errorToast');
	if (errorToast) {
		window.scrollTo({ top: 0, behavior: 'smooth' });
		setTimeout(() => {
			errorToast.remove();
		}, 5000);
	}
});
