</div>
	<script>
		var isOpenNav = false;

		function toggleNav(){
			if(!isOpenNav){
				openNav();
			}
			else{
				closeNav();
			}
		}
		function openNav() {
		    document.getElementById("icon-bar").style.width = "90px";
		    document.getElementById("main").style.marginLeft = "90px";
		    document.getElementById("nav").style.marginLeft = "90px";
		    isOpenNav = true;
		}

		function closeNav() {
		    document.getElementById("icon-bar").style.width = "0";
		    document.getElementById("main").style.marginLeft= "0";
		    document.getElementById("nav").style.marginLeft= "0";
		    isOpenNav = false;
		}
	</script>
</body>
</html>