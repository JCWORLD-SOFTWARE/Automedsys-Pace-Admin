	<form class="register-form" action="getauto.html" method="post">
		<h3>Activate Online Account</h3>
		<p>
			 Enter your details below:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">First Name</label>
			<div class="input-icon">
				<i class="fa fa-font"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname"/>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Last Name</label>
			<div class="input-icon">
				<i class="fa fa-font"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname"/>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Country</label>
			<select name="country" id="select2_sample4" class="select2 form-control">
				<option value=""></option>
				<? $q = "SELECT code,country FROM country ORDER BY country"; $r = pg_query($q); while ($f=pg_fetch_row($r)) { ?>
								<option value="<?=$f[0]?>"><?=$f[1]?></option>			
				<? } ?>
			</select>
		</div>
		<p>


			 Enter your account details below:
		</p>
		
				<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Practice Code</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Practice Code" name="practice_code"/>
			</div>
		</div>		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Your Practice Username" name="username"/>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
			</div>
		</div>
		<p>
			 Select a username name, which could be your username if available
		</p>
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Online Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Select Online-Username" name="online_username"/>
			</div>
		</div>		
		<div class="form-group">
			<label>
			<input type="checkbox" name="tnc"/> I agree to the <a href="#">
			Terms of Service </a>
			and <a href="#">
			Privacy Policy </a>
			</label>
			<div id="register_tnc_error">
			</div>
		</div>
		<?
		  if ($error_message != '')
		  {
			  ?>
				<div class="alert alert-danger">
                  <?=$error_message?>
				</div>			  
			  
			  <?
		  }
		?>	
		
		<div class="form-actions">
			<button id="register-back-btn" type="button" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" id="register-submit-btn" class="btn blue pull-right">
			Sign Up <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	
		
	</form>
