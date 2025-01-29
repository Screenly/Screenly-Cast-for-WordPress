document.addEventListener('DOMContentLoaded', function() {
	"use strict";

	const article = document.querySelector('article');
	if (article) {
		const content = article.querySelector('.content');
		if (content) {
			const childs = content.children;

			/*
			 * LET'S START REMOVING CHILD BLOCKS THAT ARE OUT OF VIEW
			 */
			let i = childs.length - 1;
			while (i >= 0) {
				const child = childs[i];
				if (child && typeof child === 'object') {
					const childRect = child.getBoundingClientRect();

					if (childRect.top > article.clientHeight) {
						child.remove();
					} else if (childRect.top + child.offsetHeight > article.clientHeight) {
						/*
						 * NOW WE NEED TO WORK WORD BY WORD UNTIL NO SCROLL IS NEEDED
						 */
						const words = child.innerText.split(' ');
						const tlength = words.length;
						let a = tlength;
						while (a > 0) {
							child.innerText = words.slice(0, a).join(' ') + ' [...]';

							if (childRect.top + child.offsetHeight < article.clientHeight) {
								break;
							}
							a--;
						}
					}
				}
				i--;
			}
		}
	}
});
