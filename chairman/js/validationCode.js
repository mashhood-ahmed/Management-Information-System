function marksValidation() {

			let f1 = (document.getElementById("f1").value).trim();
			let f2 = (document.getElementById("f2").value).trim();
			let f3 = (document.getElementById("f3").value).trim();
			let f4 = (document.getElementById("f4").value).trim();
			let f5 = (document.getElementById("f5").value).trim();
			let f6 = (document.getElementById("f6").value).trim();
			let f7 = (document.getElementById("f7").value).trim();
			let f8 = (document.getElementById("f8").value).trim();
			let f9 = (document.getElementById("f9").value).trim();
			let f10 = (document.getElementById("f10").value).trim() ;
			let f11 = (document.getElementById("f11").value).trim() ;
			let f12 = (document.getElementById("f12").value).trim() ;
			let f13 = (document.getElementById("f13").value).trim() ;
			let f14 = (document.getElementById("f14").value).trim() ;
			let f15 = (document.getElementById("f15").value).trim() ;
			let f16 = (document.getElementById("f16").value).trim() ;
            
            let patt = /^[0-9]+([,.][0-9]+)?$/g;
            let r1 = patt.test(f1);
            let r2 = patt.test(f2);
            let r3 = patt.test(f3);
            let r4 = patt.test(f4);
            let r5 = patt.test(f5);
            let r6 = patt.test(f6);
            let r7 = patt.test(f7);
            let r8 = patt.test(f8);
            let r9 = patt.test(f9);
            let r10 = patt.test(f10);
            let r11 = patt.test(f11);
            let r12 = patt.test(f12);
            let r13 = patt.test(f13);
            let r14 = patt.test(f14);
            let r15 = patt.test(f15);
            let r16 = patt.test(f16);


			if(r1===false || r2===false || r3===false || r4===false || r5===false || r6===false || r7===false || r8===false || r9===false || r10===false || r11===false || r12===false || r13===false || r14===false || r15===false || r16===false ) {

                document.getElementById("showError").innerHTML = "<li>illegal characters not allowed you can only input numbers or numbers with decimal</li>";
				event.preventDefault();
				return false;
			}            

}

function profileValidation() {

	let fname = document.getElementById("fname").value;
	let lname = document.getElementById("lname").value;
	let email = document.getElementById("ema").value;
	let pass1 = document.getElementById("pass").value;
	let pass2 = document.getElementById("cpass").value;	
    let error = document.getElementById("showError");
    let user = document.getElementById("user").value;

     // username regex 
     var illegalChars = /\W/;
     let res1 = illegalChars.test(user); // true for errors

     // name regex
     let pattName = /^[a-zA-Z\s]+$/; // false for errors
     let resn1 = pattName.test(fname);
     let resn2 = pattName.test(lname); 
     
     // password regex  
     if(pass1 != "") {          
     let pattPass = /^[A-Za-z]\w{7,14}$/; // false for errors
     let resp1 = pattPass.test(pass1);
    } else {
        resp1 = true;
    }

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

function UpdatemarksValidation() {

   let v1 = (document.getElementById("q1").value).trim();
   let v2 =   (document.getElementById("q2").value).trim();
   let v3 = (document.getElementById("q3").value).trim() ;
   let v4 = (document.getElementById("q4").value).trim()  ;
   let v5 = (document.getElementById("q5").value).trim()  ;
   let v6 = (document.getElementById("q6").value).trim()  ;
   let v7 = (document.getElementById("a1").value).trim()  ;
   let v8 = (document.getElementById("a2").value).trim()  ;
   let v9 = (document.getElementById("a3").value).trim()  ;
   let v10 = (document.getElementById("a4").value).trim()  ;
   let v11 = (document.getElementById("a5").value).trim()  ;
   let v12 = (document.getElementById("a6").value).trim()  ;
   let v13 = (document.getElementById("part").value).trim()  ;
   let v14 = (document.getElementById("pres").value).trim()  ;
   let v15 =  (document.getElementById("mid").value).trim() ;
   let v16 = (document.getElementById("final").value).trim()  ;

   
    let patt = /^[0-9]+([,.][0-9]+)?$/g;
    
            let r1 = patt.test(v1);
            let r2 = patt.test(v2);
            let r3 = patt.test(v3);
            let r4 = patt.test(v4);
            let r5 = patt.test(v5);
            let r6 = patt.test(v6);
            let r7 = patt.test(v7);
            let r8 = patt.test(v8);
            let r9 = patt.test(v9);
            let r10 = patt.test(v10);
            let r11 = patt.test(v11);
            let r12 = patt.test(v12);
            let r13 = patt.test(v13);
            let r14 = patt.test(v14);
            let r15 = patt.test(v15);
            let r16 = patt.test(v16);

            console.log(r1);
            console.log(r2);
            console.log(r3);
            console.log(r4);
            console.log(r5);
            console.log(r6);
            console.log(r7);
            console.log(r8);
            console.log(r9);
            console.log(r10);
            console.log(r11);
            console.log(r12);
            console.log(r13);
            console.log(r14);
            console.log(r15);
            console.log(r16);


            event.preventDefault();
            return false;

            if(r1===false || r2===false || r3===false || r4===false || r5===false || r6===false || r7===false || r8===false || r9===false || r10===false || r11===false || r12===false || r13===false || r14===false || r15===false || r16===false ) {

                document.getElementById("showError").innerHTML = "<li>illegal characters not allowed you can only input numbers or numbers with decimal</li>";
                event.preventDefault();
                return false;
            }                   
}
