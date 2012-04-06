function tabmenu(i){
		selectTabMenuA(i);
	}
	function selectTabMenuA(i){
		switch(i){
			case 1:
			document.getElementById("tabmen1").style.display="block";
			document.getElementById("tabmen2").style.display="none";
			document.getElementById("tabmen3").style.display="none";
			break;
			case 2:
			document.getElementById("tabmen1").style.display="none";
			document.getElementById("tabmen2").style.display="block";
			document.getElementById("tabmen3").style.display="none";
			break;
			case 3:
			document.getElementById("tabmen1").style.display="none";
			document.getElementById("tabmen2").style.display="none";
			document.getElementById("tabmen3").style.display="block";
			break;
		}
	}
	
