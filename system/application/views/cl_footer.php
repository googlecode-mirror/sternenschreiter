</div>
	<div id="prop"></div>
</div>
<div id="footer">Weltenraum (c) by <a href="http://www.sternenkaiser.de">Sternenkaiser</a>|
<?php if ( !$this->cl_auth->isValidUser() ) {
echo anchor($this->config->item('CL_login_uri'), 'Login').' - ';
echo anchor($this->config->item('CL_register_uri'), 'Register').' ';
}else { ?><a href="index.php/auth/logout">Abmelden</a><?php } ?>|
  <a href="http://www.sternenschreiter.de/">Forum</a>
  </div>
</div>
</body>
</html>