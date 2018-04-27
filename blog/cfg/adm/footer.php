<!-- MODAL SINGOLA IMMAGINE -->
<div id="modal01" class="w3-modal" onclick="this.style.display='none'">
  <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
  <div class="w3-modal-content w3-animate-zoom">
    <img id="img01" style="width:100%">
  </div>
</div>
<script>
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
}
</script>


<!-- ALBUM imageslide -->
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

<!-- LIGHTBOX -->
<script>
function openLightboxModal() {
  document.getElementById('lightbox-myModal').style.display = "block";
}

function closeLightboxModal() {
  document.getElementById('lightbox-myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("lightbox-mySlides");
  var dots = document.getElementsByClassName("lightbox-demo");
  var captionText = document.getElementById("lightbox-caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>


  <!-- FOOTER -->
  </div>
  </div>

        <footer style="background-color:#046D04">
            <p>

				<a href="#myPage" style="float:right; padding-right:20px" title="<?php print $lang['BT_TOP']; ?>"><span class="glyphicon glyphicon-eject"></span></a>
				&copy; BlogName<br/><br/>
            </p>
        </footer>


    <!-- jQuery -->
    <script src="<?php print $url;?>js/jquery-3.2.1.min.js"></script>
    <script src="<?php print $url;?>js/lightbox-plus-jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php print $url;?>js/bootstrap.min.js"></script>

    <!-- Typewriter -->
    <script src="<?php print $url;?>js/typewrite.js"></script>



</body>

</html>

