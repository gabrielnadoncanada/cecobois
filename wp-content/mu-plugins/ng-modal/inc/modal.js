const MODAL_SELECTOR = '[data-modal]';
const MODAL_OPEN_SELECTOR = '.modal-open';
const MODAL_CLOSE_SELECTOR = '.modal-close';
const MODAL_SCREEN_OVERLAY_SELECTOR = '.modal-screen-overlay';
const MODAL_CONTENT_SELECTOR = '.modal-content';

function initModals() {
	const modals = document.querySelectorAll(MODAL_SELECTOR);

	if (modals.length) {
		modals.forEach((modal) => {
			const modalOpenCloseButtons = modal.querySelectorAll(
				`${MODAL_OPEN_SELECTOR}, ${MODAL_CLOSE_SELECTOR}, ${MODAL_SCREEN_OVERLAY_SELECTOR}`
			);
			modalOpenCloseButtons.forEach((btn) => {
				btn.addEventListener('click', handleModalButtonClick);
			});

			modal.querySelector(MODAL_CONTENT_SELECTOR).addEventListener(
				'click',
				handleModalContentClick
			);
		});
	}

	if (window.location.hash) {
		handlePopState();
	}

	window.addEventListener('hashchange', handlePopState, false);
	document.addEventListener('keydown', handleKeyDown);
}

function handleModalButtonClick(event) {
	event.preventDefault();
	const modal = event.target.closest(MODAL_SELECTOR).querySelector(
		MODAL_SCREEN_OVERLAY_SELECTOR
	);

	if (modal.classList.contains('is-active')) {
		history.pushState(null, null, ' ');
		modal.classList.remove('is-active');
	} else {
		window.location.hash = event.target.closest(MODAL_SELECTOR).getAttribute('id');
		modal.classList.add('is-active');
	}
}

function handleModalContentClick(event) {
	event.stopPropagation();
}

function handlePopState() {
	const modalId = window.location.hash.substring(1);
	const modal = document.getElementById(modalId);

	if (modal && modal.hasAttribute('data-modal')) {
		modal.querySelector(MODAL_SCREEN_OVERLAY_SELECTOR).classList.add('is-active');
	}
}

function handleKeyDown(event) {
	if (event.keyCode === 27) {
		const modalOpened = document.querySelector('.modal-screen-overlay.is-active');

		if (modalOpened) {
			modalOpened.classList.remove('is-active');
			history.pushState(null, null, ' ');
		}
	}
}

initModals();
