function validate(pass1, pass2, pos, id)
{ 

	if(pass1 != pass2)
	{
		document.getElementById(id).value="";
		document.getElementById(pos).innerHTML = "password do not match !!!";
    }
	else
         document.getElementById(pos).innerHTML = "";		
}


function IsValid(pass, pos, id)
{

    var len = pass.length,i;

    var flag1=0, flag2=0, flag3=0,x,flag0=0;

    if(len>=8)
    flag0=1;

    for(i=0; i<len; i++)
    {
         x = pass.charCodeAt(i);

    	if((x>=65 && x<=90) || (x>=97 && x<=122))
    		flag1=1;
    	else if(x>=48 && x<=57)
    		flag2=1;
    	else 
    		flag3=1;
    }

    if(flag1==1 && flag2==1 && flag3==1 && flag0==1)
    	document.getElementById(pos).innerHTML = "";
    else
    {
    	document.getElementById(id).value="";
    	document.getElementById(pos).innerHTML = "Your password does not match the required standard !!!";

    }

}



function check(login)
{
        
        if(login == "Select")
        {
            document.getElementById("pwd").value="";
        document.getElementById("yes").innerHTML = "This field is required !!!";
        }
    else
    {
        document.getElementById("yes").innerHTML = "";
    }
}




function Required(submit)
{
        
        if(submit == "Select")
        {
            document.getElementById("mail").value="";
        document.getElementById("no").innerHTML = "This field is required !!!";
        }
    else
    {
        document.getElementById("no").innerHTML = "";
    }
}

