function hideDisplayInfo(row){
    var displayInfo = document.getElementById(row).style.display;
    if(displayInfo == 'block'){
        document.getElementById(row).style.display = 'none';
    }else{
        document.getElementById(row).style.display = 'block';
    }
}
function includeSubject(subject){
    var content = document.getElementById(subject);
    var addcontent ='<label>Naam</label><input type="text" name="subjectnaam" value="" ><br /><div id="new_subject" style="display:block"><label >Week nummer</label><input type="text" name="subjectweek" value=""><br /><label >Extra info</label><textarea name="subjectinfo" > </textarea><br /></div>';
    var div = document.createElement('div');
    div.className = 'row';
    div.innerHTML = addcontent;
document.getElementById(subject).appendChild(div);
}
function includeGroup(subject){
    var content = document.getElementById(subject);
    var row=99;
    var addcontent = '<h2 >Nieuwe Groep</h2><div style="display:block">';
    addcontent += '<label>Groepsnaam</label><input type="text" name="objectnaam'+row+'" value="">';
    addcontent +='<label>Naam</label><input type="text" name="subjectnaam" value="" ><br /><div id="new_subject" style="display:block"><label >Week nummer</label><input type="text" name="subjectweek" value=""><br /><label >Extra info</label><textarea name="subjectinfo" > </textarea><br /></div>';
    addcontent += '</div></section>';
    
    var div = document.createElement('section');
    div.className = 'formblock';
    div.innerHTML = addcontent;
document.getElementById(subject).appendChild(div);

}

