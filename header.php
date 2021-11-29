<!-- HEADER DE L'INDEX -->
<?php

?>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunctioncompte() {
    document.getElementById("myDropdowncompte").classList.toggle("show");
}

function myFunctionlivre() {
    document.getElementById("myDropdownlivre").classList.toggle("show");
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


<header>

    <div class="hleftbox">

        <div class="hleftboxsup">
            <a href="index.php"><img src="assets/logo" alt="logo" class="headerlogo" ></a>
        </div>


    </div>

    <div class="hrightbox">

        <div class="hbuttons">
            <div class="dropdown" id="comptebtn">
                <button onclick="myFunctioncompte()" class="dropbtn" id="compte"></button>
                <div id="myDropdowncompte" class="dropdown-content">
                    <a href="inscription.php">Inscription</a>
                    <a href="connexion.php">Connexion</a>
                </div>
            </div>
        </div>
            
        <div class="hbuttons">
            <div class="dropdown" id="bookbtn">
                <button onclick="myFunctionlivre()" class="dropbtn" id="livre"></button>
                <div id="myDropdownlivre" class="dropdown-content">
                    <a href="livre-or.php">Livre d'or</a>
                    <a href="commentaire.php">Commentaire</a>
                </div>
            </div>
        </div>

    </div>




</header>

