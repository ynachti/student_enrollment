
// *********** Start of modifiable section ********** //

// signatureSaveURL - must be set to save serlet's URL 
//var signatureSaveURL = '{context}/SaveServlet" />';

// afterSaveRedirectURL - if you want to redirect to another 
// page after the signature has been save to the server, 
// enter a valid URL to redirect to other wise set it to blank ('') 
//var afterSaveRedirectURL = '{context}/{page}';

// imageSavePath - must be a fully qualified file path on 
// your server where you want the images to be saved.  
// The folder must exist on the server.
//var imageSavePath = "{path}/images/signs/";


var showTimeStamp = "true";  // set to true if you want the time stamp added to the signature
var signPadWidth = 500; // set to the width you would like the signature pad (pixels)
var signPadHeight = 170; // set to the height you would like the signature pad (pixels)

// You can add script here to run after the signature is save.
// ** NOTE: if the code has errors you may break the redirect. 
//function customFunction(signatureFile){
	//alert(signatureFile);
//}

// *********** End of modifiable section ********** //

var copyrightString = "Copyright � 2007 EZ-Signature, LLC - All Rights Reserved";
var signPad, signPadContext, sign;

var points = new Object();
var ind = 0;
var prev_x;
var prev_y;

//$( function() {
//	init();
//});

function init() {
	$('#saveSignatureButton').attr('disabled', 'disabled');
	signPad = document.getElementById('signaturePad');
	if (signPad && signPad.getContext) {
		signPadContext = signPad.getContext('2d');
	}

	if (!signPad || !signPadContext) {
		alert('Error creating signature pad.');
		return;
	}

	signPad.width = signPadWidth;
	signPad.height = signPadHeight;
	sign = new signCap();
	signPad.addEventListener('mousedown', eventSignPad, false);
	signPad.addEventListener('mousemove', eventSignPad, false);
	signPad.addEventListener('mouseup', eventSignPad, false);
}

function signCap() {
	var sign = this;
	this.draw = false;

	this.mousedown = function(event) {
		signPadContext.beginPath();
		signPadContext.moveTo(event._x, event._y);
		sign.draw = true;
		prev_x = event._x;
		prev_y = event._y;
//		savePoint(event);
	};

	this.mousemove = function(event) {
		if (sign.draw) {
			signPadContext.lineTo(event._x, event._y);
			signPadContext.StrokeThickness = 0.5;
			signPadContext.stroke();
			savePoint(event);
		}
	};

	this.mouseup = function(event) {
		if (sign.draw) {
			sign.mousemove(event);
			sign.draw = false;
		}
		prev_x = null;
		prev_y = null;
	};
}

function eventSignPad(event) {
	if (event.offsetX || event.offsetX == 0) {
		event._x = event.offsetX;
		event._y = event.offsetY;
	} else if (event.layerX || event.layerX == 0) {
		event._x = event.layerX;
		event._y = event.layerY;
	}
	
	var func = sign[event.type];
	if (func) {
		func(event);
	}
}

function savePoint(event) {
	if (prev_x != null){
		var aPoint = new Object();
		aPoint._ax = prev_x;
		aPoint._ay = prev_y;
		aPoint._bx = event._x;
		aPoint._by = event._y;
		points[ind++] = aPoint;
		prev_x = event._x;
		prev_y = event._y;
	}
	$('#saveSignatureButton').removeAttr('disabled');
}

function clearSignature() {
	signPad.width = signPad.width;
	points = new Object();
	ind = 0;
	$('#saveSignatureButton').attr('disabled', 'disabled');
}

function saveSignature() {
	if(!points[0]){
		alert("Please sign to continue.");
		return;
	}

	var signatureImage = signPad.toDataURL("image/png");	
	$.ajax( {
		url : signatureSaveURL,
		data : {
			'width' : signPad.width,
			'height' : (signPad.height + 30),
			'showTimeStamp' : showTimeStamp,
			'copyrightString' : copyrightString,
			'imageSavePath' : imageSavePath,
			'points' : points
		},
		type : 'POST',
		success : function(res) {
			var signatureFile = res;
			customFunction(signatureFile);
                        alert(afterSaveRedirectURL);
                        
			if (afterSaveRedirectURL && afterSaveRedirectURL != ''){
//				window.location = afterSaveRedirectURL + "&signatureFile=" + signatureFile;
			}
		}
	});
}

