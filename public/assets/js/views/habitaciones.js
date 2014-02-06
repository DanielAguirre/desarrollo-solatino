Solatino.Views.Habitaciones = Backbone.View.extend({
	events:{
		"change .niñostemplate": "edades",
		"change .adultostemplate": "edades"
	},
	initialize: function($el){
		this.template = _.template($("#personasTemplate").html());
		this.tamañoHabitaciones={1:"Sencilla",2:"Doble", 3:"Triple",4:"Cuadruple",5:"Quintuple"}
	},
	render: function(){
		var data = this.model.toJSON();
		var html = this.template(data);
		this.$el.html(html);
	},
	edades:function(){
		var habitacion = this.model.get("numero");
		var adultos = parseInt($("#adultos"+habitacion).val());
		var niños = parseInt($("#niños"+habitacion).val());	
		if((adultos+niños)>5){
			alert("No puede haber mas de 5 Personas en una Habitacion")
			$("#niños"+habitacion).val(0);
			$("#adultos"+habitacion).val(1);
			$(".edades #hab"+habitacion).remove();
			$("#tipoHabitacion1").text(this.tamañoHabitaciones[1]);
			return
		}

		tamañoHabitacion=this.tamañoHabitaciones[adultos+niños];
		$("#tipoHabitacion"+habitacion).text(tamañoHabitacion);

		if(niños>0){
				$(".edades #hab"+habitacion).remove();
				$(".edades").append("<section id=hab"+habitacion+"><span> Habitacion "+habitacion+"</span></section>");
				for(var i = 0;i<niños;i++){
					var modelo = new Backbone.Model({habitacion:habitacion,numero:i});
					var template = _.template($("#edadesTemplate").html());
					var data = modelo.toJSON();
					var html = template(data);
					$(".edades #hab"+habitacion).append(html);
				}
			}
	}
})