class Spark
{
	constructor()
	{
		this.init();
	}
	init()
	{
		//this._car=new CarouselClass(this._w, this._h);
		//console.log(this);
		//init onload sequence
		//basicIntel();
		$("[data-toggle=popover]").popover({//lebo predtym nieje istota, ze element existuje
					html: true,
					content: function()
					{
						return $("#login-form").html();
					}
				});
		$("#login").popover();
		registerHandlers();
	}
}
