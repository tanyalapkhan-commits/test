/**
 * КабельПро — интерактив: мега-меню, мобильное меню, модальное окно заявки.
 */
(function () {
	'use strict';

	var mobile = window.matchMedia('(max-width: 1024px)');
	var header = document.getElementById('header');
	var nav = document.getElementById('nav');
	var burger = document.querySelector('.burger');

	/* Высота шапки — для позиционирования мобильного меню */
	function setHeaderHeight() {
		if (!header) return;
		var rect = header.querySelector('.header__inner').getBoundingClientRect();
		document.documentElement.style.setProperty('--header-h', Math.round(rect.bottom) + 'px');
	}
	setHeaderHeight();
	window.addEventListener('resize', setHeaderHeight);
	window.addEventListener('scroll', setHeaderHeight, { passive: true });

	/* Бургер */
	if (burger && nav) {
		burger.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			burger.setAttribute('aria-expanded', open ? 'true' : 'false');
			document.body.classList.toggle('modal-open', open);
			setHeaderHeight();
		});
	}

	/* Кнопки раскрытия уровней меню (мобильный аккордеон и клавиатура на десктопе) */
	document.querySelectorAll('.mega__toggle').forEach(function (btn) {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			var item = btn.parentElement;
			var open = item.classList.toggle('is-open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			if (open && !mobile.matches) {
				Array.prototype.forEach.call(item.parentElement.children, function (sib) {
					if (sib !== item) sib.classList.remove('is-open');
				});
			}
		});
	});

	/* Десктоп: закрываем открытую с клавиатуры панель по Esc и клику вне меню */
	document.addEventListener('keydown', function (e) {
		if (e.key !== 'Escape') return;
		document.querySelectorAll('.mega__item.is-open').forEach(function (el) { el.classList.remove('is-open'); });
		closeModal();
	});
	document.addEventListener('click', function (e) {
		if (mobile.matches || e.target.closest('.mega')) return;
		document.querySelectorAll('.mega__item--d1.is-open').forEach(function (el) { el.classList.remove('is-open'); });
	});

	/* Модальное окно заявки */
	var modal = document.getElementById('request');
	var lastFocus = null;

	function openModal() {
		if (!modal) return;
		lastFocus = document.activeElement;
		modal.hidden = false;
		document.body.classList.add('modal-open');
		var first = modal.querySelector('input:not([type=hidden]):not([tabindex="-1"])');
		if (first) first.focus();
	}

	function closeModal() {
		if (!modal || modal.hidden) return;
		modal.hidden = true;
		if (!nav || !nav.classList.contains('is-open')) document.body.classList.remove('modal-open');
		if (lastFocus) lastFocus.focus();
	}

	document.addEventListener('click', function (e) {
		var trigger = e.target.closest('[data-modal="request"]');
		if (trigger) {
			e.preventDefault();
			openModal();
			return;
		}
		if (e.target.closest('[data-close]')) {
			e.preventDefault();
			closeModal();
		}
	});

	/* Плавная прокрутка оглавления с учётом липкой шапки */
	document.querySelectorAll('.toc a[href^="#"]').forEach(function (a) {
		a.addEventListener('click', function (e) {
			var target = document.getElementById(a.getAttribute('href').slice(1));
			if (!target) return;
			e.preventDefault();
			var top = target.getBoundingClientRect().top + window.pageYOffset - (header ? header.offsetHeight + 16 : 0);
			window.scrollTo({ top: top, behavior: 'smooth' });
			history.replaceState(null, '', a.getAttribute('href'));
		});
	});
})();
