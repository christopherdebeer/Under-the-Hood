  
    var hash = "";
    
    $(document).ready(function() {
        
        //if javascript runs, then remove backup CSS link and leave it to LESS
        //$("link[href*='assets/css/style.css']").remove();
        
        // scroll to top, to remove status/address bars on mobile devices
        $("html, body").animate({ scrollTop: 0 }, "slow");
       
        // get the hash value if there is one
        hash = document.location.hash.replace("#","");
        $("body").addClass(hash);
        
       
        if (hash != "") {
            // alert(hash); // a debug line
            // get the contents of the corresponding page ie: #venues gets the content of venues.html
            hash += ".html";
            var link = hash;
            $.get(hash, function(data) {
                $("#main-nav li a").removeClass("current");
                $(this).addClass("current");
                $("#content").hide();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                var contents = $(data).find("#content");
                var page = link.replace(".html","");
                document.title = "Under the Hood : " + page.slice(0,1).toUpperCase() + page.substring(1);
                $("body").attr("class","").addClass(page);
                document.location.hash = "#" + page;
                $("#content").html(contents);
                $("#content").slideDown();
            });
            // replace the html of #content with fetched content
        }
       
        $("#main-nav li a").each(function () {
            
            $(this).click( function (e) {
                
                e.preventDefault();
                var link = $(this).attr("href");
                $.get(link, function(data) {
                    $("#main-nav li a").removeClass("current");
                    $(this).addClass("current");
                    $("#content").hide();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var contents = $(data).find("#content");
                    var page = link.replace(".html","");
                    document.title = "Under the Hood : " + page.slice(0,1).toUpperCase() + page.substring(1);
                    $("body").attr("class","").addClass(page);
                    document.location.hash = "#" + page;
                    $("#content").html(contents);
                    $("#content").slideDown();
                });
            });
        });
       
    });