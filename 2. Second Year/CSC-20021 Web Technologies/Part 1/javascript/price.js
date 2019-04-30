function price(currency, sign) {
	var price = 50;
	if (currency == "GBP") {
		price = 50;
		price = price = price.toFixed(2);
		document.getElementById("price1").innerHTML = sign + price + " (" + currency + ")";
	} else {
		$(document).ready(function(){
			$.get("http://www.teach.cs.keele.ac.uk/extra_scripts/proxyj.php?path=http://api.fixer.io/latest?base=GBP", function(data){
				var index = (data.indexOf(currency))+5;
				var sub = data.substring(index, data.length);
				var char = sub.charAt(0);
				var exchange = "";
				var isNum = isNaN(char);
				var n = 0;
				while (isNum == false || char == ".") {
					exchange = exchange + char;
					n++;
					char = sub.charAt(n);
					isNum = isNaN(char);
				}
				price = price * parseFloat(exchange);
				price = price = price.toFixed(2);
				document.getElementById("price1").innerHTML = sign + price + " (" + currency + ")";
			});
		});
	}
}