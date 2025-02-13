import * as webix from "webix";

var menu_data = [
	{id: "tables", icon: "mdi mdi-table", value:"Справочники", data:[
		{ id: "users", value: "Пользователи"},
		{ id: "roles", value: "Роли"},
	]},
	{id: "logout", icon: "mdi mdi-logout", value:"Выйти"}
];

function addUser() {
  var formValues = $$("form1").getValues(); 
  formValues._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
  webix.ajax().post("/admin/users/add", formValues).then((data)=> {

      if(data.json().Status){
        webix.message("Пользовотель добавлен")
        
        $$("data").clearAll()
        $$("data").load("/admin/users")
      }
      else{
        webix.message("Пользователь не добавлен",'error')
      }
  }).catch(()=>{        
    webix.message("Пользователь не добавлен",'error')
  })
  ;
}

function removeUser() {
  var selected = $$("data").getSelectedItem();
  console.log(selected) 
  if (!selected) {
      webix.message("Выберите пользователя для удаления", "error");
  }

  webix.ajax().post("/admin/users/delete", { id: selected.id ,_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') }).then((data)=> {

      if(data.json().Status){
        webix.message("Пользовотель удален")

        $$("data").clearAll()
        $$("data").load("/admin/users")

      }else{
        webix.message("Пользователь не удален",'error')
      }
  }).catch(()=>{        
    webix.message("Пользователь не удален",'error')
  });
}

function updateUser() {
  var formValues = $$("form1").getValues(); 

  if (!formValues.id) {
      webix.message("Выберите пользователя для обновления", "error");
  }

  formValues.id = $$("data").getSelectedItem().id;
  formValues._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
  
  webix.ajax().post("/admin/users/update", formValues).then((data)=> {

      if(data.json().Status){
        webix.message("Пользовотель обновлен")


        $$("data").clearAll()
        $$("data").load("/admin/users")
      }
      else{
        webix.message("Пользователь не обновлен",'error')
      }
  }).catch(()=>{        
    webix.message("Пользователь не обновлен",'error')
  })
  ;}



var table = {
  view: "scrollview",
  scroll: "x",
  body: {
    rows: [
      {
      view:"dataview",
      id:"data",
      width:545,
      select:1,
      css:"users",
      type:{
        width: 261,
        height: 90,
        template:"<span style='display:none'>#id#</span><span class='webix_strong'>#email#</span><br><span class='webix_light'>#full_name#</span>"
      },
      on:{onAfterSelect:
        function(id){
          var item = this.getItem(id);
          console.log(item);
          $$("email").setValue(item.email);
          $$("full_name").setValue(item.full_name);
        }
      },
      url:"/admin/users",
      pager:"pagerA"
    },
    {
    view:"pager",
     id:"pagerA",
     size:40,
     group:8
    },  
    { 
      view:"form",
      width:600,
      id:"form1",
      elements:[    
        { view:"text",id:"full_name", name:"full_name",value:"",inputWidth:200,placeholder:"...ФИО"},
        {	view:"text",id:"email", name:"email", value:"",inputWidth:200,placeholder:"...Почта"},
        {	view:"text",id:"password", name:"password", value:"", inputWidth:200,placeholder:"...пароль"},
        {cols:[
          { view:"button", width: 100, value:"Добавить аккаунт", click:addUser}, 
          { view:"button", width: 160, value:"Удалить аккаунт", click:removeUser}, 
          { view:"button", width: 160, value:"Изменить аккаунт",click:updateUser}
        ]}
      ]
    }
  ]}}

webix.ready(function(){
    webix.ui({
      rows: [
        { view: "toolbar", padding:3, elements: [
          { view: "icon", icon: "mdi mdi-menu", click: function(){
             $$("$sidebar1").toggle();
           }
          },
          { view: "label", label: "Справочник"}
        ]
        },
        { cols:[
          {
            view: "sidebar",
            data: menu_data,
            on:{
              onAfterSelect: function(id){
                webix.message("Выбран: "+this.getItem(id).value)
                if(id == "logout"){
                    webix.ajax().get('/admin/logout').then((data)=>{
                      data = data.json();
                      if(data.Status){
                        window.location.href = '/admin/signin'
                      }
                    });
                }
                if(id == "users"){
                  webix.ajax().get('/admin/users').then((data)=>{
                    const users = data.json();
                    $$("users").parse(json);
                  })
                }
                $$("contentView").setValue(id);
              }
            }
          },
        {
            view: "multiview",
              id: "contentView",
              cells: [
                { id: "users", ...table},
                { id: "roles", template: "Roles Content" },
                { id: "logout", template: "Logout Content" },
              ]
        }
        ]}
      ]
    });
  });