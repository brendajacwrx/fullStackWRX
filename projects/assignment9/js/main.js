"use strict";

let notes = {}

notes.init = function(){
	Util.addLis(Util.getEl('#addNote')[0], 'click', notes.addNote);
	Util.addLis(Util.getEl('#getNotes')[0], 'click', notes.displayNotes);
}

notes.addNote = function(){
	let data = {}
	if(Util.getEl('#entryDate')[0].value === ""){
		Util.getEl('#errorMsg')[0].innerHTML = "You must enter a date and time.";
		return;
	}
	if(Util.getEl('#note')[0].value === ""){
		Util.getEl('#errorMsg')[0].innerHTML = "You have not entered a note. Please enter.";
		return;
	}
	data.entryDate = Util.getEl('#entryDate')[0].value;
	data.note = Util.getEl('#note')[0].value;
	data = JSON.stringify(data);
	console.log(data);
	Util.sendRequest('php/addNote.php', function(res){
		let json;

		json = JSON.parse(res.responseText);

		if(json.masterstatus == 'error'){
			Util.getEl('#errorMsg')[0].innerHTML = json.msg;
		}else{
			Util.getEl('#errorMsg')[0].innerHTML = "Success adding note!";
			Util.getEl('#note')[0].value = null;
			Util.getEl('#entryDate')[0].value = null;
		}
		
	}, data);
}

notes.displayNotes = function(){
	let data = {}
	if(Util.getEl('#beginTime')[0].value === ""){
		Util.getEl('#errorMsg')[0].innerHTML = "You must enter a begin date.";
		return;
	}
	if(Util.getEl('#endTime')[0].value === ""){
		Util.getEl('#errorMsg')[0].innerHTML = "You must enter a end date.";
		return;
	}
	data.beginTime = Util.getEl('#beginTime')[0].value;
	data.endTime = Util.getEl('#endTime')[0].value;
	data = JSON.stringify(data);
	console.log(data);

	Util.sendRequest('php/displayNotes.php', function(res){
		let json;
		json = JSON.parse(res.responseText);
		console.log(json);
		if(json.masterstatus == 'error'){
			Util.getEl('#errorMsg')[0].innerHTML = json.msg;
		}
		else {
			console.log(json.notes);
			Util.getEl('#notes')[0].innerHTML = json.notes;
		}
	}, data);
}

notes.init();