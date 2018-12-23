function selectblock(IdName){
    
    var idBlockName = IdName+"info";
    var startModalId = "#"+idBlockName;

    var infoLocation = document.getElementById(idBlockName);
    if(infoLocation){
        //Modal block info is reeds aanwezig
        $(startModalId).modal();
    }else{
        //Modal block info niet gevonden en word opgevraagd bij de server
	var name = "displayblock";
	var request = IdName;
	data = "namerequest="+ name+"&request="+ request;
	getInfo(data, idBlockName,name);
    }

}
function selectprojext(projectName){

    var url = '/module/project.php';
	var name = "selectprojectform";
	var request = projectName;
        var content='';
	data = "namerequest="+ name+"&request="+ projectName;
    posttextData(url, data)
     .then(function(result){
         $('form').replaceWith(result);
        
      });


}

function getInfo(data,idBlockName,name){
    var url = '/module/project.php';
    posttextData(url, data)
     .then(function(result){
        if(name =="displayblock"){
            var addcontent = '<div class="modal" id="'+idBlockName+'">';
            addcontent += ' <div class="modal-dialog"><div class="modal-content">'+result+' </div></div></div>';
            $('section').append(addcontent);
            console.log($("#"+idBlockName));
            $("#"+idBlockName).modal();
        }
        if(name =="addproject" || name =="addhome" || name =="changeproject"){
            $('section').replaceWith(result);
        }
     });
}
function posttextData(url, data) {

    var result= fetch(url, {
    method: 'post',
    body: data,
    cache: 'no-cache', 
    credentials: 'include', 
    headers: {
      'user-agent': 'Mozilla/4.0 MDN Example',
      'Accept': 'application/text',
      "Content-type": "application/x-www-form-urlencoded"
    },
   
    mode: 'cors', 
    redirect: 'follow', 
    referrer: 'no-referrer'
  })
	.then(response => response.text())

	.catch(function(err) {
	console.log('Fetch Error :-S', err);
	});
  
return result;
}
function addproject(){
	var name = "addproject";
	var request = "addproject";
        var content='';
	data = "namerequest="+ name+"&request="+ request;
	getInfo(data, content, name);
}
function addhome(){
	var name = "addhome";
	var request = "addhome";
        var content='';
	data = "namerequest="+ name+"&request="+ request;
	getInfo(data, content, name);
}
function changeproject(){
	var name = "changeproject";
	var request = "changeproject";
        var content='';
	data = "namerequest="+ name+"&request="+ request;
	getInfo(data, content, name);
}