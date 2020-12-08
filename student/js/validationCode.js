function complaintValidation() {

	 let title = document.getElementById("title").value;
   let error = document.getElementById("showError");

   error.innerHTML = "";

      let patt = /[~!#$%^&*()-+=,<.>?'";:]/;
      let res = patt.test(title);

      if(res) {

          error.innerHTML = "<li>The title contains illegal characters</li>";

          event.preventDefault();
          return false;
       }

}


function profileValidation() {

  let user = document.getElementById("user").value;
	let fname = document.getElementById("f").value;
	let lname = document.getElementById("l").value;
	let email = document.getElementById("ema").value;
	let pass1 = document.getElementById("con").value;
	let pass2 = document.getElementById("new").value;	
  let error = document.getElementById("showError");

    // username regex 
     var illegalChars = /\W/;
     let res1 = illegalChars.test(user); // true for errors

     // name regex
     let pattName = /^[a-zA-Z\s]+$/; // false for errors
     let resn1 = pattName.test(fname);
     let resn2 = pattName.test(lname); 
     
     // password regex            
     let pattPass = /^[A-Za-z]\w{7,14}$/; // false for errors
     let resp1 = pattPass.test(pass1);
     let resp2 = pattPass.test(pass2);

     error.innerHTML = "";

     if(res1) {
        
        error.innerHTML += "<li>The username contains illegal characters</li>";

     }

     if(resn1===false) {

        error.innerHTML += "<li>The first name contains illegal characters</li>";
     }

     if(resn2===false) {
      error.innerHTML += "<li>The last name contains illegal characters</li>";

     }  

     if(resp1===false) {
      error.innerHTML += "<li>The password is not valid</li>";

     }

     if(resn1===false || resn2===false || resp1===false ) {

     	event.preventDefault();
     	return false;

     }              

}