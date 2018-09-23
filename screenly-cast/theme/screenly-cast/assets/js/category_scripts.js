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

jQuery(document).ready(function($) {
	srly_next_post_id=1;
	srly_current_post_id=0;
	srly_post_ceiling=2;
	
	//rotate posts on category
	srly_category_manager={
		rotate_post:function(){			
			
			$("#srly_category_section_"+srly_current_post_id).hide("slow");
			$("#srly_category_section_"+srly_next_post_id).show("slow");
			$("#srly_category_nav_"+srly_next_post_id).addClass("srly_category_nav_item_active");
			
			srly_current_post_id = srly_next_post_id ;
			if(srly_current_post_id==srly_post_ceiling){
				srly_next_post_id = 0;				
			}
			else{
				srly_next_post_id = srly_next_post_id+1;
			}
			if(srly_current_post_id==0){
				$(".srly_category_nav_item ").removeClass("srly_category_nav_item_active");
				$("#srly_category_nav_"+srly_current_post_id).addClass("srly_category_nav_item_active");
			}
			//alert(current_post_id+" "+next_post_id);
			console.log("a rotation happened");
			
		}
	};
	//display countdown
	
	$("#srly_category_section_0").show();
	setInterval(
	function(){
		srly_category_manager.rotate_post();
	},srly_category_switch_period );
});