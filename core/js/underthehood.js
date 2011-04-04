  
    var hash = "";
    
    // hide the address bar on mobile safari
    
    // When ready...
    //window.addEventListener("load",function() {
    //    // Set a timeout...
    //    setTimeout(function(){
    //            // Hide the address bar!
    //            window.scrollTo(0, 1);
    //    }, 0);
    //});

    
    $(document).ready(function() {
        
       
        // get the hash value if there is one
        hash = document.location.hash.replace("#","");
        $("body").addClass(hash);
        
       
        if (hash != "") {
            // alert(hash); // a debug line
            // get the contents of the corresponding page ie: #venues gets the content of venues.html
            hash += ".html";
            var link = hash;
            $("#content").slideUp();
            $("#content").html("<div class='loading'><img src='assets/images/loading.gif' alt='Loading data...' /></div>");
            $("#content").slideDown();
            $.get(hash, function(data) {
                $("#main-nav li a").removeClass("current");
                $(this).addClass("current");
                $("#content").hide();
                $("body").animate({ scrollTop: 0 }, "slow");
                var contents = $(data).find("#content");
                var page = link.replace(".html","");
                document.title = "Under the Hood : " + page.replace("_"," ");
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
                $("#content").slideUp();
                $("#content").html("<div class='loading'><img src='assets/images/loading.gif' alt='Loading data...' /></div>");
                $("#content").slideDown();
                $.get(link, function(data) {
                    $("#main-nav li a").removeClass("current");
                    $(this).addClass("current");
                    $("#content").hide();
                    $("body").animate({ scrollTop: 0 }, "slow");
                    var contents = $(data).find("#content");
                    var page = link.replace(".html","");
                    document.title = "Under the Hood : " + page.replace("_"," ");
                    $("body").attr("class","").addClass(page);
                    document.location.hash = "#" + page;
                    $("#content").html(contents);
                    $("#content").slideDown();
                });
            });
        });
       
    });