
$('document').ready(function() {

function darkmode(){
    $('body').addClass('dark-mode');
        $('#copy').addClass('dark-mode');
        $('p').removeClass('large text-muted');
        $('#gallery').removeClass('bg-light');
        $('#privacy').removeClass('bg-light');
        $('#gallery').addClass('dark-mode');
        $('h3').addClass('dark-mode');
        $('h4').addClass('dark-mode');
        $('h5').addClass('dark-mode');
        $('p').addClass('dark-mode');
        $('li').addClass('dark-mode');
        $('#plantilla').addClass('dark-mode');
        $('#cmn-toggle-4').prop('checked', true);
    localStorage.setItem("mode", "dark");

}



function nodark(){
        $('body').removeClass('dark-mode');
        $('#copy').removeClass('dark-mode');
        $('#gallery').removeClass('dark-mode');
        $('#gallery').addClass('bg-light');
        $('h3').removeClass('dark-mode');
        $('h4').removeClass('dark-mode');
        $('h5').removeClass('dark-mode');
        $('p').removeClass('dark-mode');
        $('li').removeClass('dark-mode');
        $('#plantilla').removeClass('dark-mode');
        $('p').addClass('large text-muted');
        $('#cmn-toggle-4').prop('checked', false);
    localStorage.setItem("mode", "light");
}

  if(localStorage.getItem("mode")=="dark")
    darkmode();
  else
    nodark();

$('#cmn-toggle-4').change(function(){   

    if ($(this).prop('checked'))
    {
        darkmode();
    }
    else
    {
        nodark();
    }

});


/*
$('#cmn-toggle-4').change(function(){   
    
    if ($(this).prop('checked'))
    {
        $('body').addClass('dark-mode');
        $('#copy').addClass('dark-mode');
        $('p').removeClass('large text-muted');
        $('#gallery').removeClass('bg-light');
        $('#privacy').removeClass('bg-light');
        $('#gallery').addClass('dark-mode');
        $('h3').addClass('dark-mode');
        $('h4').addClass('dark-mode');
        $('h5').addClass('dark-mode');
        $('p').addClass('dark-mode');
        $('li').addClass('dark-mode');
    }
    else
    {
        $('body').removeClass('dark-mode');
        $('#copy').removeClass('dark-mode');
        $('#gallery').removeClass('dark-mode');
        $('#gallery').addClass('bg-light');
        $('h3').removeClass('dark-mode');
        $('h4').removeClass('dark-mode');
        $('h5').removeClass('dark-mode');
        $('p').removeClass('dark-mode');
        $('li').removeClass('dark-mode');
        $('p').addClass('large text-muted');
    }   
});

*/

    $("#M").hide();
    $("#A").hide();
    $("#F").hide();
    $("#Mf").hover(function(){
    $("#Mf").hide();
    $("#M").show();

  });
  $("#M").mouseleave(function(){
    $("#M").hide();
    $("#Mf").show();
  });
  $("#Af").hover(function(){
    $("#Af").hide();
    $("#A").show();
  });
  $("#A").mouseleave(function(){
    $("#A").hide();
    $("#Af").show();
  });
  $("#Ff").hover(function(){
    $("#Ff").hide();
    $("#F").show();
  });
  $("#F").mouseleave(function(){
    $("#F").hide();
    $("#Ff").show();
  });
  $("#utrc").hide();
  $("#utr").hover(function(){
    $("#utr").hide();
    $("#utrc").show();
  });
    $("#utrc").mouseleave(function(){
    $("#utrc").hide();
    $("#utr").show();
  });
  $("#thincrsc").hide();
  $("#thincrs").hover(function(){
    $("#thincrs").hide();
    $("#thincrsc").show();
  });
    $("#thincrsc").mouseleave(function(){
    $("#thincrsc").hide();
    $("#thincrs").show();
  });
  $("#googlec").hide();
  $("#google").hover(function(){
    $("#google").hide();
    $("#googlec").show();
  });
    $("#googlec").mouseleave(function(){
    $("#googlec").hide();
    $("#google").show();
  });
  $("#mlc").hide();
  $("#ml").hover(function(){
    $("#ml").hide();
    $("#mlc").show();
  });
    $("#mlc").mouseleave(function(){
    $("#mlc").hide();
    $("#ml").show();
  });
  $('#allTeam').on('click',function(){
    if($(this).attr('data-click-state') == 0) {
        $("#M").hide();
        $("#A").hide();
        $("#F").hide();
        $("#Mf").show();
        $("#Af").show();
        $("#Ff").show();
        $(this).attr('data-click-state', 1);
    } else {
        $("#Af").hide();
        $("#Ff").hide();
        $("#Mf").hide();
        $("#M").show();
        $("#A").show();
        $("#F").show();
        $(this).attr('data-click-state', 0);
    }
  });

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
});

     

