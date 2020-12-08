   let usernameFlag = true;
   let passwordFlag = true;
   let eflag = true;

function testUsername(user) {

var illegalChars = /\W/; // allow letters, numbers, and underscores

if (illegalChars.test(user)) {
       
        //error = "The username contains illegal characters.\n";
        //alert(error);
        usernameFlag = false;
 
    }

}

function testEmail(email) {

        let regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            emailFlag=false;
        
        } else {

            emailFlag = true;
        }

}

function testPassword(passw) {

        let pattPass = /^[A-Za-z]\w{7,14}$/;
        
        if(passw.match(pattPass)) {

            passwordFlag = true;

        } else {

            passwordFlag = false;
        }

}


   function studentLogin() {

        let reg = document.getElementById("stdreg").value;
        let pass = document.getElementById("stdpass").value;  
        let error = document.getElementById("showErrors"); 

      testPassword(pass);

      if(passwordFlag===false){

            error.innerHTML += "<li>The password contains illegal characters</li>";

            event.preventDefault();
            return false;

      }


   }

   function adminLogin() {

        let user = document.getElementById("aduser").value;
        let pass = document.getElementById("adpass").value;  
        let error = document.getElementById("showErrors");         

        alert(user);
        alert(usernameFlag);

        // testUsername(user);
        // testPassword(pass);

        // if(usernameFlag===false) {
        //     error.innerHTML += "<li>The username contains illegal characters</li>";
        // }

        // if(passwordFlag===false) {
        //     error.innerHTML += "<li>The password is not valid</li>";

        // }

        // if(usernameFlag===false || passwordFlag===false) {

        //     event.preventDefault();
        //     return false;

        // }

   } 


   function chairmanLogin() {

    let p = document.getElementById("pass").value;
    let error = document.getElementById("showErrors");

    testPassword(p) ;
    if(passwordFlag===false){
        
        error.innerHTML += "<li>The password is invalid</li>";
    }

    if(passwordFlag===false) {

        event.preventDefault();
        return false;
    }


   }

   function teacherLogin() {

         let ema = document.getElementById("teaemail").value;
         let pass = document.getElementById("teapass").value; 

          testEmail(ema);
          testPassword(pass);

          if(eflag===false) {

                document.getElementById("emailer").innerHTML = "Invalid email address";

          }  

          if(passwordFlag===false) {

                document.getElementById("passer").innerHTML = "invalid password";

          }


          if(eflag===false || passwordFlag===false) {

                event.preventDefault();
                return false;

          }
   }
