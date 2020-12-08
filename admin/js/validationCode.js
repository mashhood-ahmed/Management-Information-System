function postValidation() {

	  let title = document.getElementById("title").value;
    let error = document.getElementById("showError");

      let patt = /[~!#$%^&*()-+=,<.>?'";:]/;
      let res = patt.test(title);

      error.innerHTML = "";

      if(res) {

           error.innerHTML = "<li>Title field contains illegal characters</li>"; 


          event.preventDefault();
          return false;
       }
}

function courseValidation() {


	 let title = document.getElementById("title").value;
	 let code = document.getElementById("code").value;
	 let credit = document.getElementById("credit").value;
   let error = document.getElementById("showError");
          
      let pattTitle = /[0123456789~!#$%^&*()-+=,<.>?'";:]/;
      let res1 = pattTitle.test(title);

      let pattCode = /[~!@#$%^&*()_+=<,>.?]/i;
      let res2 = pattCode.test(code);

      let pattCredit = /[^0-9]/;
      let res3 = pattCredit.test(credit); 

      error.innerHTML = "";

      if(res1) {
        error.innerHTML += "<li>The course title is not valid</li>";
      }

      if(res2) {
        error.innerHTML += "<li>The course code is not valid</li>";
      }

      if(res3) {

        error.innerHTML += "<li>The course credit hour is not valid</li>";
      }


      if(res1 || res2 || res3) {

      	//alert("Please Enter Valid Data In The Input Fields");
      	event.preventDefault();
      	return false;

      }
}

function profileValidation() {

	let user = document.getElementById("user").value;
	let fname = document.getElementById("fname").value;
	let lname = document.getElementById("lname").value;
	let email = document.getElementById("ema").value;
	let pass1 = document.getElementById("conf").value;
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

     if(res1 || resn1===false || resn2===false || resp1===false) {

     	event.preventDefault();
     	return false;

     }              



}

