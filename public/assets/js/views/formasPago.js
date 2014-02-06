Solatino.Views.FormaPago = Backbone.View.extend({
	events:{
		"change .formapago": "formaPago",
		"input  .monto"    : "monto"
	},
	initialize:function(){
		this.template = _.template($("#formaPagoTemplate").html());
	},
	render:function(){
		var data = this.model.toJSON(),
			html = this.template(data);			
		this.$el.html(html);
	},
	formaPago:function(){
		this.formaPago 	       = parseInt(document.getElementById("formaPago"+this.model.get("numero")).value);
		var numforma	       = this.model.get("numero"),
			data		   	   = this.model.toJSON(),			
			elemento 	   	   = $("#formaPago"+numforma).closest("div"),			
			templatePago   	   = _.template($("#pagoNumerado").html()),
			templaComision     = _.template($("#tcComisionAbiertaNumerado").html()),
			htmlPago 	       = templatePago(data),
			htmlComision       = templaComision(data);
		
		if (this.formaPago>=1 && this.formaPago<=5 || this.formaPago==9) {
			if(elemento.find("section").length<2)
				elemento.append(htmlPago);
			if(elemento.find("section").length==3)
				elemento.find("section")[1].remove();			
		}

		if(this.formaPago==6 || this.formaPago==8){
			if(elemento.find("section").length==2){
				elemento.find("section")[1].remove()
			}
			if(elemento.find("section").length<2){				
				elemento.append(htmlComision);
				elemento.append(htmlPago);
			}
		}
	},
	monto:function(){
		var numforma = parseInt(this.model.get("numero")),
			monto    = $("#monto"+(numforma-1)).val(),
			comision = $("#comision"+(numforma-1)),
			total    = $("#toalSolatinoPago"+(numforma-1));

		switch(parseInt(this.formaPago)){
			case 1:
				comision.val(monto*.12); break;
			case 2: ;
			case 3: ;
			case 9:
				comision.val(monto*.15); break;
			case 4:
				comision.val(monto*.16); break;
			case 5:
			case 6: return;
			case 7:
				comision.val(0); break;
			case 8: 
				comision.val(monto*.10); break;
		}
		total.val(monto-comision.val());
	}
});