(function()
{
    "use strict";

    var article = document.querySelector('article');
    if (article) {
        var content = article.querySelector('.content');
        if (content) {
            var childs = content.children;

            /*
             * LET'S START REMOVING CHILD BLOCKS THAT ARE OUT OF VIEW
             */
            var i = childs.length;
            for (i; i>0; i--) {
                var child = childs[i];
                if (typeof child === 'object') {
                    var childRect = child.getClientRects()[0];

                    if (childRect.top > article.clientHeight) {
                        child.remove(child);
                    } else if (childRect.top + child.offsetHeight > article.clientHeight) {
                        /*
                         * NOW WE NEED TO WORK WORD BY WORD UNTIL NO SCROLL IS NEEDED
                         */
                        var words = child.innerText.split(' ');
                        var tlength = words.length;
                        var a = tlength;
                        for (a; a>0; a--) {
                            child.innerText = words.slice(0, a).join(' ') + '[...]';

                            if (childRect.top + child.offsetHeight < article.clientHeight) {
                                break;
                            }
                        }
                    }
                }
            }
        }
    }
})();
