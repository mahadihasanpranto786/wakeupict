 function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the link that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      } 
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());


    /*code for sidebar*/
 /*   $("#sidebar").toggleClass("collapsed");
    $("#content").toggleClass("col-md-12 col-md-9");*/

    //Init Scrollspy
    $('body').scrollspy({target: '#main-nav'});

    //smooth Scrolling
    $("#main-nav a, #header a, a").on('click',function(event){
      if(this.hash !== ""){
        event.preventDefault();
        const hash = this.hash;
        $('html,body').animate({
          scrollTop:$(hash).offset().top
        },800,function() {
            window.location.hash=hash;
          });
        }
      });
