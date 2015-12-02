    $(document).ready(function() {
        $(window).keydown(function(e){
            if(e.keyCode == 13) {
                var src = e.srcElement || e.target;
                if (src.tagName.toLowerCase() != "textarea") {
                    if (e.preventDefault) {
                        e.preventDefault();
                    } else {
                        e.returnValue = false;
                    }
                }
            }
        });
    });
