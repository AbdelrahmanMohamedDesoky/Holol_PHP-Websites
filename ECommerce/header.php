     <script type="text/javascript">

(function() {
    $('form > input').keyup(function() {

        var empty = false;
        $('form > input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#register').attr('disabled', 'disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
        } else {
            $('#register').removeAttr('disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
        }
    });
})()

	   
	   var hasFocus = false;

 function checkName(form)
{
  var eobj=document.getElementById('realnameerror');
  var sRealName = form.username.value;
  var oRE = /^[a-z0-9]+[_.-]?[a-z0-9]+$/i;
  var error=false;
  eobj.innerHTML='';
  if (sRealName == '') {
   error='*Username cannot be blank!';
  }
  else if (sRealName.length < 4)
{
    error="*UserName should be atleast 4 characters long";
  }
  else if (!oRE.test(sRealName))
{
   error="*Incorrect format.";
  }
  if (error)
{
   if (hasFocus == false) {
     form.username.focus();
     hasFocus = true;
   }
   eobj.innerHTML=error;
   return false;
  }
  return true;
 }

function checkEmail(form)          /* for email validation */
{
 var eobj=document.getElementById('emailerror');
 eobj.innerHTML='';
 var error = false;
  if (form.email.value.length == 0) {
    error = 'Please enter email.';
  } else if (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(form.email.value))
 {
  return true;
 } else {
   error = '*Invalid E-mail Address! Please re-enter.';
 }
 if (error) {
   eobj.innerHTML=error;
   if (!hasFocus) {
     form.email.focus();
     hasFocus = true;
   }
   return false;
 }

 return true;
}

function validatePwd(form)          /* password & retype-password verification */
{
 var eobj1=document.getElementById('passworderror');
 var eobj2=document.getElementById('password2error');
 var minLength=6;
 var invalid=' ';
 var pw1=form.password.value;
 var pw2=form.password_confirm.value;
 var error=false;
 eobj1.innerHTML='';
 eobj2.innerHTML='';
 if (pw1.length<1)
 {
  error='Please enter your password.';
 }
 else if (pw1.length < minLength)
 {
  error='Your password must be at least ' + minLength + ' characters long. Try again.';
 }
 else if (pw1.indexOf(invalid) > -1)
 {
  error='Sorry, spaces are not allowed.';
 } else if (pw2.length == 0) {
  error='Please retype password.';
   if (!hasFocus) {
     form.password_confirm.focus();
     hasFocus = true;
   }
  eobj2.innerHTML=error;
  return false;
 }
 if (error)
 {
   if (!hasFocus) {
     form.password.focus();
     hasFocus = true;
   }
    eobj1.innerHTML=error;
  return false
 }
 if (pw1 != pw2)
 {
  eobj2.innerHTML=' passwords not matching.Please re-enter your password.';
   if (!hasFocus) {
     form.password_confirm.focus();
     hasFocus = true;
   }
  return false;
 }
 return true;
}

function validPhone(form)              /* phone no validation */
{
 var eobj=document.getElementById('phonenoerror');
 var valid = '012345678901234';
 var phone = form.nationalId.value;
 var error=false;
 var i=0;
 var temp;
 eobj.innerHTML='';
 if (phone == '')
 {
  error='This field is required. Please enter National Id';
 }
 else if (!phone.length > 1 || phone.length < 14)
 {
  error='Invalid National Id ! Please try again.';
 }
 else
 {
  for (i=0; i < phone.length; i++)
 {
   temp = '' + phone.substring(i, i + 1);
   if (valid.indexOf(temp) == -1)
    {
    error='Invalid characters in your phone. Please try again.';
    }
  }
 }
 if (error)
 {
   if (!hasFocus) {
     form.nationalId.focus();
     hasFocus = true;
   }
  eobj.innerHTML=error;
  return false;
 }
 return true;
}

function validate()
 {
  hasFocus = false;
 var form = document.forms['form'];
 var ary=[checkName,checkEmail,validatePwd,validPhone];
 var rtn=true;
 var z0=0;
 for (var z0=0;z0<ary.length;z0++)
{
  if (!ary[z0](form))
  {
    rtn=false;
  }
 }
 return rtn;
}
</script>     <script type="text/javascript">
	   
	   var hasFocus = false;

 function checkName2(form2)
{
  var eobj=document.getElementById('realnameerror2');
  var sRealName = form2.username.value;
  var oRE = /^[a-z0-9]+[_.-]?[a-z0-9]+$/i;
  var error=false;
  eobj.innerHTML='';
  if (sRealName == '') {
   error='*Username cannot be blank!';
  }
  else if (sRealName.length < 7)
{
    error="*UserName should be atleast 6 characters long";
  }
  else if (!oRE.test(sRealName))
{
   error="*Incorrect form2at.";
  }
  if (error)
{
   if (hasFocus == false) {
     form2.username.focus();
     hasFocus = true;
   }
   eobj.innerHTML=error;
   return false;
  }
  return true;
 }


function validatePwd2(form2)          /* password & retype-password verification */
{
 var eobj1=document.getElementById('passworderror2');
 //var eobj2=document.getElementById('password2error');
 var minLength=6;
 var invalid=' ';
 var pw1=form2.password.value;
 //var pw2=form2.password_confirm.value;
 var error=false;
 eobj1.innerHTML='';
 //eobj2.innerHTML='';
 if (pw1.length<1)
 {
  error='Please enter your password.';
 }
 else if (pw1.length < minLength)
 {
  error='Your password must be at least ' + minLength + ' characters long. Try again.';
 }
 else if (pw1.indexOf(invalid) > -1)
 {
  error='Sorry, spaces are not allowed.';
 } 
/* else if (pw2.length == 0) {
  error='Please retype password.';
   if (!hasFocus) {
     form2.password_confirm.focus();
     hasFocus = true;
   }
  eobj2.innerHTML=error;
  return false;
 }*/
 if (error)
 {
   if (!hasFocus) {
     form2.password.focus();
     hasFocus = true;
   }
    eobj1.innerHTML=error;
  return false
 }
 /*if (pw1 != pw2)
 {
  eobj2.innerHTML=' passwords not matching.Please re-enter your password.';
   if (!hasFocus) {
     form2.password_confirm.focus();
     hasFocus = true;
   }
  return false;
 }*/
 //return true;
}


function validate2()
 {
  hasFocus = false;
 var form2 = document.forms['form2'];
 var ary=[checkName2,validatePwd2];
 var rtn=true;
 var z0=0;
 for (var z0=0;z0<ary.length;z0++)
{
  if (!ary[z0](form2))
  {
    rtn=false;
  }
 }
 return rtn;
}

</script>
<div id="modals">
                <!-- ***********************
                                Sign In Modal
                ************************ -->
                <div id="sign-in-modals">
                    <div class="ui modal small sign-in-modal">
                        <div class="header">Sign In</div>
                        <div class="content">
                            <form action="index.php" method="POST"  name="form2" onchange="return validate2()">
                             <input type="text" value="" name="username" placeholder="Username *" required="required"><span id="realnameerror2" style="color:red;" >*</span>
                                 <input type="password" value="" name='password' placeholder="Password *" maxlength="12" size="25" required="required"><span id="passworderror2" style="color:red;" >*</span>
                                <button type="submit" name="signin">Sign In</button>
                            </form>
                            <button><i class="fa fa-facebook" aria-hidden="true"></i>Sign in with facebook</button>
                        </div>
                    </div>
                </div>

                <!-- ***********************
                                Sign UP Modal
                ************************ -->
                <div id="sign-up-modals">
                    <div class="ui modal small sign-up-modal">
                        <div class="header">Sign Up</div>
                        <div class="content">
                            <form action="index.php" method="post"  name="form" onchange="return validate()">
                                <input type="text" value="" name="username" placeholder="Username *" required="required"><span id="realnameerror" style="color:red;" >*</span>
                                <input type="text" value="" name='email' placeholder="Email *" required="required"><span id="emailerror" style="color:red;" >*</span>
                                <input type="password" value="" name='password' placeholder="Password *" maxlength="12" size="25" required="required"><span id="passworderror" style="color:red;" ></span>
                                <input type="password" value="" name='password_confirm' placeholder="Confirm Password *"maxlength="12" size="25" required="required"><span id="password2error" style="color:red;" ></span>
                                <input type="text" value="" name='nationalId' placeholder="National ID *"><span id="phonenoerror" style="color:red;"  ></span>

                               <br> <label> Register As :</label> <br> <br>
                                <input type="radio" name="userType" value="0"> Customer &nbsp;&nbsp;
                                <input type="radio" name="userType" value="1"> Company <br>
                                <button type="submit" name="signup"/> Sign up </button>
                                <button><i class="fa fa-facebook" aria-hidden="true"></i>Sign up with facebook</button>
                            </form>
                        </div></div>
                </div>



            </div>

