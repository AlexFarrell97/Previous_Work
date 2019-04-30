var url = "http://query.yahooapis.com/v1/public/yql";
var data = encodeURIComponent("select * from yahoo.finance.quotes where symbol in ('STAN.L')");

$.getJSON(url, 'q=' + data + "&format=json&diagnostics=true&env=http://datatables.org/alltables.env")
.done(function (data) {
	$("#stock").text("Bid Price: " + data.query.results.quote.LastTradePriceOnly);
});