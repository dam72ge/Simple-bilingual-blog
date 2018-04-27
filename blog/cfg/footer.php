<!-- MODAL LOGIN -->
	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container" style="text-align: center">
					<h1>Admin</h1><br>

						<form action="" method="post"> <!-- action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" -->
						<!--input type="text" placeholder="Enter Username" name="user" required-->
						<input type="password" placeholder="Enter Password" name="pwd" required>
						<input type="submit" class="login loginmodal-submit" name="login" value="Login">
						</form>
					
			</div>
		</div>
	</div>


<!-- MODAL SINGOLA IMMAGINE -->
<div id="modal01" class="w3-modal" onclick="this.style.display='none'">
  <div class="w3-modal-content img-responsive">
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

        <footer>
            <p>

				<a href="#myPage" style="float:right; padding-right:20px" title="<?php print $lang['BT_TOP']; ?>"><span class="glyphicon glyphicon-eject"></span></a>
				&copy; BlogName<br/><br/>
            </p>
        </footer>



    <!-- Typewriter -->
    <script src="<?php print $url;?>js/typewrite.js"></script>


	<!-- ACCORDION -->
	<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    }
}
	</script>

</body>

</html>


