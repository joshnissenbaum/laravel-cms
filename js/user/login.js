$( document ).ready(function() {

    $("#loginForm").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var error = 0;
        var username = $("#loginForm #username");
        var password = $("#loginForm #password");
        if(username.val() == "")
        { 
            username.css("border-color", "red").fadeTo('slow', 1); 
            error++;
        } 
        else 
        {
            username.css("border-color", "#ccc").fadeTo('slow', 1); 
        }
        if(password.val() == "")
        { 
            password.css("border-color", "red").fadeTo('slow', 1);
            error++;
        } 
        else 
        { 
            password.css("border-color", "#ccc").fadeTo('slow', 1);
        }
        if(error > 0) { 
            $("#login-error").text("These fields are required!");
            $("#login-error").fadeIn('slow');
            return false;
        }
        if(error == 0) {
        $("#login-error").fadeOut('fast');
        $.ajax({
            url:  $( form ).prop( 'action' ),
            type: 'POST',
            async: false,
            data: form.serialize(),
            
            success:(function(result) {
                if(result.success == false)
                {
                        $("#login-error").text("You have entered an incorrect username or password!");
                        $("#login-error").fadeIn('slow');
                }
               else
               {
                     $("#create-error").fadeOut('fast');
                     $(".login-page").fadeOut('fast');
                     $("#login-success").fadeIn('2000');
                     setTimeout(function(){ window.location.href = "./"; }, 3000);
               }
            }),
           error:function(result){
                console.log(result);
                alert('An error occured on the server side. Report to administration immediately.');
           }
        });
    }
    });    

        $("#createUserForm").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var errors = "";
        var username = $("#createUserForm #username");
        var password = $("#createUserForm #password");
        var email = $("#createUserForm #email");
        var confirmpassword = $("#createUserForm #confirmpassword");
        
        if(username.val() == "") { 
            username.css("border-color", "red").fadeTo('slow', 1); 
            errors += "- You did not enter a username!<br>";
        } else { 
            username.css("border-color", "#ccc").fadeTo('slow', 1);
        }
        if(email.val() == "") 
        { 
            email.css("border-color", "red").fadeTo('slow', 1); 
            errors += "- You did not enter an email address!<br>";
        } else { 
            email.css("border-color", "#ccc").fadeTo('slow', 1); 
        }
        if(password.val() == "") { 
            password.css("border-color", "red").fadeTo('slow', 1); 
           errors += "- You did not enter a password!<br>";
            } 
            else { password.css("border-color", "#ccc").fadeTo('slow', 1); 
            }
         if(confirmpassword.val() == "") { 
            confirmpassword.css("border-color", "red").fadeTo('slow', 1); 
           errors += "- You did not re-enter your password!<br>";
            } 
            else { confirmpassword.css("border-color", "#ccc").fadeTo('slow', 1); 
            }
        if(password.val() != confirmpassword.val()) { 
            password.css("border-color", "red").fadeTo('slow', 1); 
            confirmpassword.css("border-color", "red").fadeTo('slow', 1); 
            errors += "- Your password and confirm password do not match!<br>";
        }
            
        if(errors) { 
            $("#create-error").html(errors);
            $("#create-error").fadeIn('slow');
            return false;
        }
        else
        {
        $("#create-error").fadeOut('fast');
        $.ajax({
            url:  $( form ).prop( 'action' ),
            type: 'POST',
            async: false,
            data: form.serialize(),
            
            success:(function(result) {
                if(result.success == false)
                {
                      $("#create-error").text(result.msg);
                      $("#create-error").fadeIn('slow');
                }
               else
               {
                     $("#create-error").fadeOut('fast');
                     $(".login-page").fadeOut('fast');
                     $("#login-success").fadeIn('2000');
                     setTimeout(function(){ window.location.href = "./"; }, 3000);
               }
                console.log(result);
            }),
           error:function(result){
                console.log(result);
           }
        });
        }
    });   
    
});

