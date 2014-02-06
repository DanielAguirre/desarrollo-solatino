Solatino.Views.App = Backbone.View.extend({
	events:{
		"focus #destino"        : "getDestinos",
		"input #destino"        : "showDestinos",
		"input #hotel"          : "showHotel",
		"input #plan"			: "getPlan",
		"keyup #cuartos"        : "cuartos",
		"change .niños"         : "edades",
		"change .adultos"       : "edades",
		"change #fecha_Salida"  : "fechaSalida",
		"change #fecha_Ingreso" : "fechaIngreso",
		"change #formaPago"     : "formaPago",
		"click #FP"             : "addFormaPago",		
		"input #monto"			: "monto",
		"focus #agencias"       : "getAgencias",
		"click #tarifas"		: "tarifas",
		"click #cerrarModal"	: "cerrarTarifas",
		"input #agencias"       : "showAgencias",
		"click #agregarAgencia" : "agregarAgencia",
		"click #agregarAgente"  : "agregarAgente",
		"dblclick table"			: "pruebaTable",
		"submit form"           : "submit"
	},
	initialize: function ($el){
		this.$el = $el;
		this.contador=0;
		this.tamañoHabitaciones={1:"Sencilla",2:"Doble", 3:"Triple",4:"Cuadruple",5:"Quintuple"}
		this.meses={1:31,2:28,3:31,4:30,5:31,6:30,7:31,8:31,9:30,10:31,11:30,12:30};
		window.collections.bloqueo = new Solatino.Collections.Bloqueo();
    },
    addFormaPago: function(){    	
    	var modelo = new Backbone.Model({numero:this.contador}),
			formaPago = new Solatino.Views.FormaPago({model:modelo});
			formaPago.render();
			formaPago.$el.appendTo(".formas");
			$("#formaPagoOculta").val(this.contador);
			this.contador++
		if(this.contador==6)
    		document.getElementById("FP").disabled=true;

    },
    agregarAgencia:function(){
    	$(".agencia").append($("#formAgencia").html());
    	document.getElementById("agregarAgencia").disabled=true;
    },
    agregarAgente:function(){
		$(".agente").append($("#formAgente").html());
		document.getElementById("agregarAgente").disabled=true;
    },
    cerrarTarifas:function(){
		el = document.getElementById("overlay");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
    },
	cuartos:function(){
		var cuartos = parseInt(document.getElementById("cuartos").value) || 0;
		var secciones =$(".edades section");
		$(".personas div").hide();
		for (var i =1 ; i < cuartos; i++){
			var modelo = new Backbone.Model({numero:i+1});
			var habitaciones = new Solatino.Views.Habitaciones({model:modelo});
			habitaciones.render();
			habitaciones.$el.appendTo(".personas");
		}
		for(var i = cuartos; i<secciones.length;i++){
			if(i==0)
				$("#niños1").val(0)
			secciones[i].remove();

		}
	}, 
	edades:function(){
		var niños=parseInt($("#niños1").val());
		var adultos =parseInt($("#adultos1").val());

		if($("#cuartos").val()==0)	return

		if(niños==0) 
			$(".edades #hab1").remove();
		
		if((adultos+niños)>5){
			alert("No puede haber mas de 5 Personas en una Habitacion")
			$("#niños1").val(0);
			$("#adultos1").val(1);
			$(".edades #hab1").remove();
			$("#tipoHabitacion1").text(this.tamañoHabitaciones[1]);
			return
		}		
		tamañoHabitacion=this.tamañoHabitaciones[adultos+niños];
		$("#tipoHabitacion1").text(tamañoHabitacion);
		
		if(niños>0){
			if(!$(".edades strong").html())
				$(".edades strong").html("Edades");
			$(".edades #hab1").remove();
			var habitacion="<section id='hab1'><span>Habitacion 1 <span></section>";
			$(".edades").append(habitacion);
			for(var i = 0 ; i<niños;i++){
				var modelo = new Backbone.Model({numero:i});
				var template = _.template($("#edadesTemplate").html());
				var data = modelo.toJSON();
				var html = template(data);
				$(".edades #hab1").append(html);
			}
		}
	},
	fechaIngreso:function(){
		var fecha = new Date();
		var fechaIngreso =  $("#fecha_Ingreso").val().split("-");
		if(fecha.getMonth()+1 == parseInt(fechaIngreso[1]))
			if(fecha.getDate()>parseInt(fechaIngreso[2])){
				alert("EL dia de Ingreso no puede ser menor al dia actual");
				$("#fecha_Ingreso").val("");
			}
	},
	fechaSalida:function(){
		var fechaSalida = $("#fecha_Salida").val().split("-");
		var fechaIngreso =  $("#fecha_Ingreso").val().split("-");
		if(fechaSalida[0] >=fechaIngreso[0]){
			if( fechaIngreso[1]==fechaSalida[1] ){
				if(fechaIngreso[2]<=fechaSalida[2] )
					$("#noches").val(parseInt(fechaSalida[2])-parseInt(fechaIngreso[2]));
				else{
					alert("El dia de Salida no puede ser menor al de Ingreso");
					$("#fechaSalida").val("");
				}

			}
			if( fechaSalida[1]>fechaIngreso[1] ||(fechaSalida[1]<fechaIngreso[1] && fechaSalida[0] > fechaIngreso[0] ) ){
				var diasMes = this.meses[parseInt(fechaIngreso[1])];
				var nochesMesIngreso=diasMes-parseInt(fechaIngreso[2]);
				
				$("#noches").val(nochesMesIngreso+parseInt(fechaSalida[2]));
			}
			if( fechaSalida[1]<fechaIngreso[1] &&  fechaSalida[0] == fechaIngreso[0] ){
				alert("EL mes de Ingreso no puede ser mayor al de Salida");
				$("#fechaSalida").val("");
			}
		}
		else{
			alert("EL año de Ingreso no puede ser mayor al de Salida")
			$("#fecha_Salida").val("");
		}
	},
	formaPago:function(){
		this.formaPago = $("#formaPago").val(),
			elemento = $("#formaPago").closest("div");
		if(this.formaPago>=1 && this.formaPago<=5 || this.formaPago==9){
			if(elemento.find("section").length<1)
				$(".formapago1").append($("#pago").html())
			if(elemento.find("section").length>1)
				elemento.find("section")[1].remove();
		}		
		if(this.formaPago==6 || this.formaPago==8){
			if(elemento.find("section").length==1)
				elemento.find("section")[0].remove();
			if(elemento.find("section").length<1){
				$(".formapago1").append($("#tcComisionAbierta").html());
				$(".formapago1").append($("#pago").html());
			}
		}
		if(this.formaPago==5 || this.formaPago==6)
			console.log("pendiente");
		this.monto();
	},
	getAgencias:function(){
    	$("#listAgencias").find("option").remove();
    	window.collections.agencias = new Solatino.Collections.Agencia();
    	window.collections.agencias.fetch({
    		success:function(respuesta){
    			for(var i in respuesta.models)
    				listaTemplate("#listAgencias",respuesta.models[i].get("nombre"),respuesta.models[i].get("id_agencia"));
    		}
    	});
    },
    getDestinos:function(){
    	$("#listdestinos").find("option").remove();
    	window.collections.destino = new Solatino.Collections.Destino();
    	window.collections.destino.fetch({
    		success:function(respuesta){
    			for (var i in respuesta.models){
    				if(respuesta.models[i].get("nombre")!=" ")
    					listaTemplate("#listdestinos",respuesta.models[i].get("nombre"),respuesta.models[i].get("id_destino"));
    			}
    				
 		   		}
    	});
    },
    getPlan:function(){
    	var plan = $("#plan").val().toUpperCase();
    	for(var i in window.collections.plan.models){
    		if(window.collections.plan.models[i].get("nombre").toUpperCase()==plan)
    			this.id_plan = window.collections.plan.models[i].get("id_plan")
    	}    	
    },
   	monto:function(){   		
   		var monto = $("#monto").val(),
   			comision = $("#comision");
   		switch(parseInt(this.formaPago)) {
   			case 1:    					
   				comision.val(monto*.12);
   				 break;
   			case 2: ;
   			case 3: ;
   			case 9: 
   				comision.val(monto*.15); break;
   			case 4:
   				comision.val(monto*.16); break ;
   			case 5:
   			case 6: return 	
   			case 7:	
   				comision.val(0); break ;
   			case 8: comision.val(monto*.10); break;
   		}   		
   		$("#totalSolatinoPago").val(monto-comision.val());
   	},
    showAgencias:function(){
    	var agencia = $("#agencias").val().toUpperCase();
    	$("#plan").val("");
    	window.collections.contactos = new Solatino.Collections.Contactos_Agencia(); 
    	for(var i in window.collections.agencias.models){
    		if(window.collections.agencias.models[i].get("nombre").toUpperCase()==agencia){
    			window.collections.contactos
    								.fetch({data:{id:window.collections.agencias.models[i].get("id_agencia")}})
    								.done(function(respuesta){
    									for(var j in respuesta)
    										listaTemplate("#solicitada",respuesta[j].id_contacto,respuesta[j].nombre);
    										});
    			}	
    	}
    },
   
    showDestinos:function(){
    	var destino= $("#destino").val().toUpperCase();
    	$("#hotel").val("");
    	$("#plan").val("")
    	window.collections.hotel = new Solatino.Collections.Hotel();
    	for(var i in window.collections.destino.models)
    		if(window.collections.destino.models[i].get("nombre").toUpperCase()==destino){
    			this.id_destino = window.collections.destino.models[i].get("id_destino");
    			window.collections.hotel
    								.fetch({data:{id:this.id_destino}})
    								.done(function(respuesta){
    									$("#listhoteles").find("option").remove();
    									for(var j in respuesta)
    										listaTemplate("#listhoteles",respuesta[j].nombre ,respuesta[j].id_hotel);
    									})
    		}
    },
    showHotel:function(){
		var hotel= $("#hotel").val().toUpperCase();
		window.collections.plan = new Solatino.Collections.Plan();
		for(var i in window.collections.hotel.models)
			if(window.collections.hotel.models[i].get("nombre").toUpperCase()==hotel){
				this.id_hotel=parseInt(window.collections.hotel.models[i].get("id_hotel"));
				window.collections.plan
						.fetch({data:{id:this.id_hotel}})
						.done(function(respuesta){
							$("#listPlan").find("option").remove();							
							for(var i in respuesta)
								listaTemplate("#listPlan",respuesta[i].nombre,respuesta[i].id_plan);
						});
			}
		window.collections.bloqueo.fetch({data:{id:this.id_hotel}});
		for(var i in window.collections.bloqueo.models)
			if(window.collections.bloqueo.models[i].get("id_hotel")==this.id_hotel && window.collections.bloqueo.models[i].get("id_destino")==this.id_destino){
				console.log("entra");
				console.log(window.collections.bloqueo.models[i].get("tlimiteint"));
				listaTemplate("#bloqueo",window.collections.bloqueo.models[i].get("entrada"),window.collections.bloqueo.models[i].get("nombre")+" - "+window.collections.bloqueo.models[i].get("numhabitaciones"));
			}

	},
	submit:function(e){		
		var destino  	  	= $("#destino"),
			hotel   	  	= $("#hotel"),
			plan    	  	= $("#plan"),
			agencia 	  	= $("#agencias"),
			destinoOculto 	= $("#destinoOculto"),
			hotelOculto   	= $("#hotelOculto"),
			planOculto    	= $("#planOculto"),
			agenciasOculto 	= $("#agenciasOculto");

			for(var i in window.collections.destino.models)
				if(window.collections.destino.models[i].get("nombre").toUpperCase() == destino.val().toUpperCase())
					destinoOculto.val(window.collections.destino.models[i].get("id_destino"));

			for(var i in window.collections.hotel.models)
				if(window.collections.hotel.models[i].get("nombre").toUpperCase()==hotel.val().toUpperCase())
					hotelOculto.val(window.collections.hotel.models[i].get("id_hotel"));

			for(var i in window.collections.plan.models)
				if(window.collections.plan.models[i].get("nombre").toUpperCase()==plan.val().toUpperCase())
					planOculto.val(window.collections.plan.models[i].get("id_plan"));

			for(var i in window.collections.agencias.models)
				if(window.collections.agencias.models[i].get("nombre").toUpperCase()==agencia.val().toUpperCase())
					agenciasOculto.val(window.collections.agencias.models[i].get("id_agencia"));		
	},
	tarifas:function(){	
		console.log(this.id_plan);
		window.collections.tarifas = new Solatino .Collections.Agencia();		
		window.collections.tarifas
							.fetch({data:{
										id_hotel:this.id_hotel,
										id_destino:this.id_destino,
										id_plan : this.id_plan
							}})
							.done(function(respuesta){
								el = document.getElementById("overlay");
								el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
								console.log(respuesta);
								for(var i in respuesta){
									var template = _.template($("#tablaTarifa").html());
									var data = respuesta[i];
									var html = template(data);
									$("#overlay div table").append(html);
								}
									console.log(respuesta[i])
							});
		
	},
	pruebaTable:function(){
		console.log("prueba");
	},
});

function listaTemplate(elemento, id, nombre){
	template = '<option value="'+id+'">'+nombre+'</option>';
	$(elemento).append(template);
}