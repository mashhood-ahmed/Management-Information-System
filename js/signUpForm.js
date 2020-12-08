let fnameFlag=true;
let lnameFlag=true;
let regNoFlag=true;
let emailFlag=true;
let passOneFlag=true;
let username = true;

function testUsername(user) {

var illegalChars = /\W/; // allow letters, numbers, and underscores

if (illegalChars.test(user)) {
       
        //error = "The username contains illegal characters.\n";
        //alert(error);
        username = false;
 
    }

}

function testFirstName(fname) {

	   let regex = /^[a-zA-Z\s]+$/;
 
        if(regex.test(fname) === false) {
            
            fnameFlag = false;
        
        } else {

        	fnameFlag = true;
        } 

}

function testLastName(lname) {

	   let regex = /^[a-zA-Z\s]+$/;

       if(regex.test(lname) === false) {
            
            lnameFlag = false;
        
        } else {

        	lnameFlag = true;
        }  

}

function testRegNo(reg) {

	  let patt = /[^0-9]/; // true for error
      let res2 = patt.test(reg);

      if(res2) {

        regNoFlag = false;
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

function testPassOne(passw) {

 		let pattPass = /^[A-Za-z]\w{7,14}$/;
       	
       	if(passw.match(pattPass)) {

       		passOneFlag = true;

       	} else {

       		passOneFlag = false;
       	}

}


function teacherSignUpValidation() {

	let email = document.getElementById("email").value;
    let passw = document.getElementById("pass").value;
    let error = document.getElementById("showError");      
    let fname = document.getElementById("fname").value;
    let lname = document.getElementById("lname").value;
    let user = document.getElementById("user").value;

    testFirstName(fname);
    testLastName(lname);
    testEmail(email);
    testPassOne(passw);
    testUsername(user);

     if(username===false) {

    	error.innerHTML += "<li>The username contains illegal characters</li>";
    }

    if(fnameFlag===false) {

    	error.innerHTML += "<li>First name must contains only letters</li>";
    }

    if(lnameFlag===false){

    	//alert("Last Name Is Not Valid");
    	error.innerHTML += "<li>Last name must contains only letters</li>";
    }


    if(emailFlag===false) {

    	//alert("Email Is Not Valid");
    	error.innerHTML += "<li>The email address is not valid</li>";	
    }

     if(passOneFlag===false) {

    	//alert("Password is not valid");
    	error.innerHTML += "<li>The password is not valid</li>";
    }

   


     if(username===false || fnameFlag===false || lnameFlag===false || emailFlag===false || passOneFlag===false) {

        //alert("Please Enter Valid Data In The Input Fields");
        event.preventDefault();
        return false;  
                
    }


}

function signUpValidation() {


 	let email = document.getElementById("email").value;
    let passw = document.getElementById("pass").value;
    let fname = document.getElementById("fname").value;
    let lname = document.getElementById("lname").value;
    let reg = document.getElementById("stdreg").value;  
    let error = document.getElementById("showError");      
    let user = document.getElementById("user").value;

    testFirstName(fname);
    testLastName(lname);
    testEmail(email);
    testPassOne(passw);
    testUsername(user);
    testRegNo(reg);

    error.innerHTML = "";

    if(regNoFlag===false) {

        error.innerHTML += "<li>The registration no contains illegal characters</li>";        
    }

    if(username===false) {

    	error.innerHTML += "<li>The username contains illegal characters</li>";
    }

    if(fnameFlag===false) {

    	error.innerHTML += "<li>First name must contains only letters</li>";
    }

    if(lnameFlag===false){

    	//alert("Last Name Is Not Valid");
    	error.innerHTML += "<li>Last name must contains only letters</li>";
    }


    if(emailFlag===false) {

    	//alert("Email Is Not Valid");
    	error.innerHTML += "<li>The email address is not valid</li>";	
    }

     if(passOneFlag===false) {

    	//alert("Password is not valid");
    	error.innerHTML += "<li>The password is not valid</li>";
    }

   


     if(username===false || fnameFlag===false || lnameFlag===false || emailFlag===false || passOneFlag===false) {

        //alert("Please Enter Valid Data In The Input Fields");
        event.preventDefault();
        return false;  
                
    }


}

