<div class="form-group"><button class="btn btn-primary ResendMail" Email="<?php echo $_GET['Email']; ?>" Username="<?php echo $Username; ?>">Resend Account Verification Link</button></div>
<script>

  $('.ResendMail').click(function(){
      
      

var SendTo=$(this).attr('Email');
var Subject="Account Verification";
var Username=$(this).attr('Username');
var ActivateAccount="<a href='https://www.malta-fxpro.com/AccountActivation.php?Email="+SendTo+"&&Username="+Username+"' style='padding: 20px; background: #0095eb; color: white; text-decoration: none'>Activate Account</a>";
var htmlcontent="Thank you for choosing Maltafxpro, Click the link below to activate your account.  <br><br>"+ ActivateAccount+" <br><br> After your account has been activated, proceed to make a deposit to your account and start earning right away";
$.ajax({
url:'SendMail.php',
method:'POST',
data:{SendTo:SendTo, Subject:Subject, htmlcontent:htmlcontent},
success:function(data){
    if(data==1){
        alert('Account Verification Mail Sent Successfully');
    }else{
              alert('Could not send mail');
  
    }
}
})

  })
</script>