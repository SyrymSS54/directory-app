import * as webix from "webix";

webix.ui({
  container: "auth", 
  view: "form", 
  width: 400,
  elements: [
    { 
      view: "text", 
      label: "email", 
      name: "email", 
      labelWidth: 100 
    },
    { view: "text", 
      type: "password", 
      label: "Password", 
      name: "password", 
      labelWidth: 100 },
    { 
      view: "button", 
      value: "Login", 
      css: "webix_primary", 
      click: function () {
        var form = this.getFormView();
        if (form.validate()) {
          var values = form.getValues();
          values._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 

          const response = webix.ajax().post("/admin/signin", values)
          .then((data)=>{
            data = data.json()
            if(data.Status){
              window.location.href = '/admin'
            }
          })
          // window.location.href = '/admin'
        }
      } 
    }
  ],
  rules: {
    "email": webix.rules.isNotEmpty,
    "password": webix.rules.isNotEmpty
  }
});