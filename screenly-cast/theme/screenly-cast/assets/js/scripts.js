(function () {
	'use strict';

	const article = document.querySelector('article');
	if (article) {
		const content = article.querySelector('.content');
		if (content) {
			const childs = content.children;

			/*
			 * LET'S START REMOVING CHILD BLOCKS THAT ARE OUT OF VIEW
			 */
			let i = childs.length;
			for (i; i > 0; i--) {
				const child = childs[i];
				if (typeof child === 'object') {
					const childRect = child.getClientRects()[0];

					if (childRect.top > article.clientHeight) {
						child.remove(child);
					} else if (
						childRect.top + child.offsetHeight >
						article.clientHeight
					) {
						/*
						 * NOW WE NEED TO WORK WORD BY WORD UNTIL NO SCROLL IS NEEDED
						 */
						const words = child.innerText.split(' ');
						const tlength = words.length;
						let a = tlength;
						for (a; a > 0; a--) {
							child.innerText =
								words.slice(0, a).join(' ') + '[...]';

							if (
								childRect.top + child.offsetHeight <
								article.clientHeight
							) {
								break;
							}
						}
					}
				}
			}
		}
	}
})();
