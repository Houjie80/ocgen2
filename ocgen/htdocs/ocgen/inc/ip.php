<br>
	
<div id="app">
<div class="container">
	<div class="justify-content-md-center text-center" style="font-family:courier" align="center">
		<span class="text-primary"><i class="fa fa-server"></i> IP	: {{ wan_ip }}</span>
    </div>

	<div class="justify-content-md-center text-center" style="font-family:courier" align="center">
		<span class="text-primary"><i class="fa fa-flag-o"></i> ISP	: {{ wan_net }} | {{ wan_country }}</span>
	</div>
				
	<div class="justify-content-md-center text-center" style="font-family:courier" align="center">
		<span class="text-primary"><i class="fa-brands fa-superpowers"></i> <b>Uptime : </b><span> <span id="uptime"></span>
	</div>				
	<div class="justify-content-md-center text-center" style="font-family:courier" align="center">
		<span class="text-primary"><i class="fa-solid fa-bolt"></i> <b>Openclash status : </b><span> <span id="clash_status" class="clash-status"></span>
	</div>				
</div>
</div>