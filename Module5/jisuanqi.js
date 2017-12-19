                            var answer = function(){
                                var output = document.getElementById("result");
                                var result = 0;
                                var checkmethod = "add";
                                var firstnum=document.getElementById("firstnumber").value;
                                var secondnum=document.getElementById("secondnumber").value;
                                var operators = document.getElementsByClassName('method');
                                for (var i = 0; i < operators.length; i++) {
                                    if(operators[i].checked === true){
                                    checkmethod = operators[i].value;}
                                }
                                
                                switch(checkmethod){
                                case "add":
                                    result = parseFloat(firstnum) + parseFloat(secondnum);
                                    break;
                                case "minus":
                                    result = parseFloat(firstnum) - parseFloat(secondnum);
                                    break;
                                case "multiple":
                                    result = parseFloat(firstnum) * parseFloat(secondnum);
                                    break;
                                case "devide":
                                    if(secondnum!=="0"){result = parseFloat(firstnum) / parseFloat(secondnum);break;}
                                    else{result = "no result";
                                    break;}
                                }
                                output.innerHTML = result;
                            
                            };
                //document.getElementById("firstnumber").addEventListener("change", answer, false);
                //document.getElementById("secondnumber").addEventListener("change", answer, false);
                //document.getElementByname("method").addEventListener("change", answer, false);
                document.getElementById("secondnumber").addEventListener("change", answer, false);
                document.getElementById("firstnumber").addEventListener("change", answer, false);
                var operators = document.getElementsByClassName('method');
                for (var i = 0; i < operators.length; i++) {
                    operators[i].addEventListener('click', answer, false);
                }