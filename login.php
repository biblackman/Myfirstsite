
			
			<!-- Both login sign up boxes -->		
			<div id="logSign">
					<div  class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed">
						<button type="button">Login</button>
						<div class="morph-content">
							<div>
								<div class="content-style-form content-style-form-1">
									<span class="icon icon-close">Close the dialog</span>
									<h2>Login</h2>
									<form action="checkUser.php" method="POST">
										<p><label>Email</label><input type="text" /></p>
										<p><label>Password</label><input type="password" /></p>
										<input type="submit" name="submit" value="Login">
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- morph-button -->
					
					<strong class="joiner">or</strong>
					<div class="morph-button morph-button-modal morph-button-modal-3 morph-button-fixed">
						<button type="button">Signup</button>
						<div class="morph-content">
							<div>
								<div class="content-style-form content-style-form-2">
									<span class="icon icon-close">Close the dialog</span>
									<h2>Sign Up</h2>
									<form action="signUpInsert.php" method="POST">
										<p><label>Firs Name</label><input type="text" name="fName" /></p>
										<p><label>Last Name</label><input type="text" name="lName" /></p>
										<p><label>Email</label><input type="text" name="username" placeholder="email" required="" /></p>
										<p><label>Password</label><input type="password" name="pswrd" placeholder="password" required /></p>
										<p><label>Repeat Password</label><input type="password" /></p>
										<input type="submit" name="submit" value="Sign Up">	
									</form>
								</div>
							</div>
						</div>
					</div>
	
	
			</div> 
		
		
		<script src="js/classie.js"></script>
		<script src="js/uiMorphingButton_fixed.js"></script>
		<script>
			(function() {
				var docElem = window.document.documentElement, didScroll, scrollPosition;

				// trick to prevent scrolling when opening/closing button
				function noScrollFn() {
					window.scrollTo( scrollPosition ? scrollPosition.x : 0, scrollPosition ? scrollPosition.y : 0 );
				}

				function noScroll() {
					window.removeEventListener( 'scroll', scrollHandler );
					window.addEventListener( 'scroll', noScrollFn );
				}

				function scrollFn() {
					window.addEventListener( 'scroll', scrollHandler );
				}

				function canScroll() {
					window.removeEventListener( 'scroll', noScrollFn );
					scrollFn();
				}

				function scrollHandler() {
					if( !didScroll ) {
						didScroll = true;
						setTimeout( function() { scrollPage(); }, 60 );
					}
				};

				function scrollPage() {
					scrollPosition = { x : window.pageXOffset || docElem.scrollLeft, y : window.pageYOffset || docElem.scrollTop };
					didScroll = false;
				};

				scrollFn();

				[].slice.call( document.querySelectorAll( '.morph-button' ) ).forEach( function( bttn ) {
					new UIMorphingButton( bttn, {
						closeEl : '.icon-close',
						onBeforeOpen : function() {
							// don't allow to scroll
							noScroll();
						},
						onAfterOpen : function() {
							// can scroll again
							canScroll();
						},
						onBeforeClose : function() {
							// don't allow to scroll
							noScroll();
						},
						onAfterClose : function() {
							// can scroll again
							canScroll();
						}
					} );
				} );

				// for demo purposes only
				[].slice.call( document.querySelectorAll( 'form button' ) ).forEach( function( bttn ) { 
					bttn.addEventListener( 'click', function( ev ) { ev.preventDefault(); } );
				} );
			})();
		</script>
